<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Qa;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Slide;
use App\Models\Conversation;
use App\Mail\VideoCall;
use App\Models\Analytic;
use App\Models\Category;
use App\Mail\ClassPassed;
use App\Models\UserAnswer;
use App\Exports\UsersExport;
use App\Models\SlideContent;
use Illuminate\Http\Request;
use App\Models\SlideProgress;
use PhpOffice\PhpWord\IOFactory;
use App\Classes\Twilio\TwilioVideo;
use App\Classes\Twilio\TwilioConversation;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\Element\TextRun;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(\Auth::user()->id);
        return view('classroom.dashboard')->with('user', $user);
    }

    public function myCerts()
    {
        $classResults = [];

        foreach (auth()->user()->categories as $userCat) {
            $userProgress = SlideProgress::where('category_id', $userCat->id)->where('user_id', auth()->user()->id)->get();

            if (count($userProgress) >= count($userCat->subcategories->where('active', 'Y'))) {

                // dd($userProgress->pluck('result', 'id'));
                $result = [];
                foreach ($userProgress as $key => $uP) {
                    if(@$uP->slide->active !== 'Y' || @$uP->slide->subcategory->active !== 'Y' || @$uP->slide->subcategory->category->active !== 'Y'){
                        array_push($result, "P");
                        continue;
                    }
                    if ($uP->result) {
                        if ($uP->result == "P") {
                            array_push($result, "P");
                        } else {
                            array_push($result, "F");
                        }
                    } else {
                        $result = null;
                        break;
                    }
                }

                if ($result) {

                    if (str_contains(implode(',', $result), "P") && !str_contains(implode(',', $result), "F")) {
                        array_push($classResults, array(
                            'id' => $userCat->id,
                            'title'     => $userCat->title,
                            'result'    => 'Pass',
                        ));
                    } elseif (str_contains(implode(',', $result), "F")) {

                        array_push($classResults, array(
                            'id' => $userCat->id,
                            'title'     => $userCat->title,
                            'result'    => 'Fail',
                        ));
                    }
                }
            }
        }
        return view('classroom.myCerts')->with('classResults', $classResults);
    }

    public function buyClass()
    {
        $categories = Category::where('active', 'Y')->get();
        return view('classroom.buyClasses', compact('categories'));
    }

    public function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $category       = Category::find($request->id);
            $oldCart        = Session::has('cart') ? Session::get('cart') : null;
            $cart           = new Cart($oldCart);
            $alreadyInCart = false;
            if ($cart->getContents()) {
                $alreadyInCart = in_Array($request->id, $cart->getContents());
            }
            if ($alreadyInCart && $request->remove) {
                $cart->removeCategory($category);
            } elseif (!$alreadyInCart) {
                $cart->addCategory($category);
            }
            Session::put('cart', $cart);
            return response()->json(['cartQty' =>  $cart->getTotalQty(), 'getTotalPrice' => $cart->getTotalPrice()]);
        } else {
            return response()->json(['error' =>  "Error!"]);
        }
    }

    public function myCart()
    {
        $cart           = Session::get('cart');
        $categories = Category::whereIn('id', $cart->getContents())->where('active', 'Y')->get();
        return view('classroom.myCart', compact('categories'));
    }

    public function slideShow(Request $request,$cat, $subcat, $slideIndex)
    {
        $user         = User::find(auth()->user()->id);
        $slide        = Slide::where('subcategory_id', $subcat)->first();

        $face_verified_slides = Session::has('face_verified_slides') ? Session::get('face_verified_slides') : [];


        //If slide doesn't exist
        if (!$slide) {
            return "The slide is work in progress!!";
        }

        //Get requested slide content
        $slideContent = SlideContent::where('slide_id', $slide->id)
            ->where('slide_index', $slideIndex)
            ->firstOrFail();

        //Previous slide index
        if ($slideIndex != 1) {
            $prevSlideIndex = (int)$slideIndex - 1;
        } else {
            $prevSlideIndex = $slideIndex;
        }

        //Get pervious slide slide content
        $prevSlideContent = SlideContent::where('slide_id', $slide->id)
            ->where('slide_index', $prevSlideIndex)
            ->firstOrFail();

        //Get current slide progress
        $slideProgress = SlideProgress::where('user_id', $user->id)
            ->where('slide_id', $slide->id)->first();

        //Get all slide Q&A, if exist
        $qas = Qa::where('subcategory_id', $slide->subcategory_id)->get();

        //Set cool down true by default
        $coolDown = true;

        //If user slide progress not found then create one
        if (!$slideProgress) {
            if ($slideIndex == 1) {
                SlideProgress::create([
                    'category_id'   => $slide->category_id,
                    'slide_id'      => $slide->id,
                    'user_id'       => $user->id,
                    'progress'      => $slideIndex,
                ]);
            } else {
                return back();
            }
        } else {
            //If progress found, then update it
            if ($slideProgress->progress >= $slide->total_slide) {
                //If Lesson already completed
                if ($slideProgress->result !== "F") {
                    //Update result if not already
                    $slideProgress->result = "P";
                    $slideProgress->save();
                    $coolDown   = false;
                } else {
                    //Else send to the last slide
                    $slideIndex = $slide->total_slide;
                    if (!session()->has('wrongAnswers') && !session()->has('noAnswers')) {
                        session()->flash('message', "All answers are correct!<br>");
                    }
                }
            } else {
                //If Lesson not complete
                if ($slideProgress->reset) {
                    $coolDownComplete = true;
                } else {
                    // Slide progress update time
                    $datetime           = date($slideProgress->updated_at);
                    // Convert datetime to Unix timestamp
                    $timestamp          = strtotime($datetime);
                    // Add slideProgress sec counter
                    $time               = $timestamp + $prevSlideContent->cool_down;
                    // Time Diff after last slide. For Checking if cool down time complete
                    $coolDownComplete   = $time < Carbon::now()->timestamp;
                }
                $coolDownComplete = true;
                if ($slideIndex == 1) {
                    //Continue to last completed slide
                    $slideIndex     = $slideProgress->progress;
                    $slideContent   = SlideContent::where('slide_id', $slide->id)
                        ->where('slide_index', $slideIndex)
                        ->firstOrFail();
                    if ($coolDownComplete) {
                        $coolDown = false;
                    }
                } else {
                    //If continuing to next slide, update progress
                    if ($slideProgress->progress == $slideIndex - 1) {
                        if (!$slideContent->qa) {
                            if (
                                $coolDownComplete  ||
                                $prevSlideContent->qa ||
                                $slideProgress->progress == ($slide->total_slide - 1)
                            ) {
                                $slideProgress->progress = $slideIndex;
                                if ($slideProgress->result == "") {
                                    $slideProgress->result = "P";
                                }
                                $slideProgress->save();
                                $this->sendEmailNotificationForClassPassing($slideProgress, $slide);
                            }
                        }
                    } else if ($slideProgress->progress == $slideIndex) {
                        //If reloading a slide page
                        if ($coolDownComplete) {
                            $coolDown = false;
                        }
                    } else if (
                        $slideProgress->progress > $slideIndex ||
                        $slideProgress->progress >= $slideContent->slide->total_slide
                    ) {
                        //Don't show cool down counter if already complete the slide
                        $coolDown = false;
                    } else {
                        return back();
                    }
                }
            }
            if (@$slideProgress->reset) {
                $coolDown = false;
            }
        }
        $coolDown = false;
		 $conv_id = $request->session()->get('conv_id', '');
        $conversation = Conversation::with(['userone','usertwo','messages.sender'])->where('uuid',$conv_id)->where('status','Y')->get()->first();
        if($conversation){
             return view('classroom.slide')
            ->with('slide', $slide)
            ->with('slideIndex', $slideIndex)
            ->with('qas', $qas)
            ->with('coolDown', $coolDown)
            ->with('data', $conversation)
            ->with('slideContent', $slideContent);
        }

        // Check slide index
        switch ($slideIndex) {
            case (1):
                if (!@$face_verified_slides[$slide->id]) {
                    $face_verify_slide = ['slide_id' => $slide->id, 'slideIndex' => $slideIndex];
                    Session::put('face_verify_slide', $face_verify_slide);
                    app('redirect')->setIntendedUrl($_SERVER['REQUEST_URI']);
                    return view('user.faceVerification');
                }
                break;
            case $slide->total_slide:
                if (!@$face_verified_slides[$slide->id] || $face_verified_slides[$slide->id] <= ($slideIndex - 1)) {
                    $face_verify_slide = ['slide_id' => $slide->id, 'slideIndex' => $slideIndex];
                    Session::put('face_verify_slide', $face_verify_slide);
                    app('redirect')->setIntendedUrl($_SERVER['REQUEST_URI']);
                    return view('user.faceVerification');
                }
                break;
        }
        return view('classroom.slide')
            ->with('slide', $slide)
            ->with('slideIndex', $slideIndex)
            ->with('qas', $qas)
            ->with('coolDown', $coolDown)
            ->with('data', 'N')
            ->with('slideContent', $slideContent);
    }

    public function slideQa(Request $request, $slideContentId)
    {
        $slideContent   = SlideContent::find($slideContentId);
        $user           = User::find(auth()->user()->id);
        $slideProgress  = SlideProgress::where('user_id', $user->id)
            ->where('slide_id', $slideContent->slide->id)->first();
        $wrongAnswers = [];
        $noAnswers = [];
        if ($slideProgress->progress < $slideContent->slide->total_slide) {
            //lesson not completed only then process, else just froward to next slide
            $result         = "";
            foreach (explode(',', $slideContent->qa_id) as $qa_id) {
                $qa         = Qa::find($qa_id);
                if (@$qa) {
                    $answer     = preg_split("/\,/", $qa->answer);

                    if (@$request[$qa_id]) {
                        if (!UserAnswer::where('user_id', auth()->user()->id)->where('qa_id', $qa_id)->first()) {
                            //Save user answers if haven't already
                            $user_ans = UserAnswer::create([
                                'user_id'      => auth()->user()->id,
                                'qa_id'        => $qa_id,
                                'answers'      => implode(',', $request[$qa_id]),
                            ]);
                        }


                        //Check All the answers
                        if ($answer == $request[$qa_id]) {
                            if ($result !== "F") {
                                $result   = "P";
                            }
                        } else {
                            $result   = "F";

                            array_push($wrongAnswers, $qa_id);
                        }
                    } else {
                        //if no answer given then result will be fail
                        $result       = "F";
                        array_push($noAnswers, $qa_id);
                    }
                }
            }

            if (@$slideProgress->result !== "F") {
                //If haven't already got "F" for the whole lesson, only then update result
                // $slideProgress->result   = @$result;
            }
            //Update progress to only current slide
            $slideProgress->result   = 'P';
            $slideProgress->progress = $slideContent->slide_index;
            $slideProgress->save();

            $this->sendEmailNotificationForClassPassing($slideProgress);
        }
        // dd($wrongAnswers);
        if ($slideContent->slide->total_slide == $slideContent->slide_index && @$result == 'P') {
            //If last slide then show lesson passed or failed
            return back()->with("message", "All answers are correct!<br>");
        } else {
            //Else continue to next slide
            $answers = $request->toArray();
            return back()
                ->with('answers', $answers)
                ->with('wrongAnswers', $wrongAnswers)
                ->with('noAnswers', $noAnswers);
        }
    }

    public function restartLesson(Request $request)
    {
        $id = $request->slide_progress_id;
        if ($id) {
            $slideProgress = SlideProgress::find($id);

            //Delete previously saved user answer for this slide
            if (
                $qa_ids = SlideContent::where('slide_id', $slideProgress->slide_id)
                ->whereNotNull('qa_id')
                ->get()
                ->pluck('qa_id')
            ) {
                $user_id = auth()->user()->id;
                foreach ($qa_ids as $qa_id) {
                    foreach (explode(',', $qa_id) as $id) {
                        UserAnswer::where('user_id', $user_id)->where('qa_id', $id)->delete();
                    }
                }
            }

            //Reset slide progress
            if ($slideProgress->result !== "P") {
                $slideProgress->result      = null;
                $slideProgress->progress    = 1;
                $slideProgress->reset       = '1';
                $slideProgress->save();
            }
        }

        if (session()->has('message')) {
            session()->forget('message');
        }
        return redirect('/slideShow/' . $slideProgress->slide->category_id . '/' . $slideProgress->slide->subcategory_id . '/1');
    }

    public function certGen($catid)
    {
        $category         = Category::find($catid);
        $endDate          = SlideProgress::where("user_id", auth()->user()->id)
            ->where('category_id', $catid)
            ->orderBy('updated_at', 'desc')
            ->first()->updated_at;
        $startDate        = SlideProgress::where("user_id", auth()->user()->id)
            ->where('category_id', $catid)
            ->orderBy('created_at')
            ->first()->created_at;
        $endDate          = date_format($endDate, "F, d Y");
        $startDate        = date_format($startDate, "F, d Y");
        $name             = auth()->user()->fname . ' ' . auth()->user()->lname;
        return view('classroom.certificate.Cert', compact(['name', 'startDate', 'endDate', 'category']));
    }

    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    public function agreement(Request $request)
    {
        $slideProgress = SlideProgress::where('user_id', auth()->user()->id)
            ->where('slide_id', $request->slide_id)->first();
        $agreement = [
            'name' => $request->name,
            'date' => $request->date,
        ];
        $slideProgress->agreement = $agreement;
        $slideProgress->save();
        return back();
    }

    private function getPassedUserClasses(array $id)
    {
        $classResults = [];
        $categories = $id  ? auth()->user()->categories->whereIn('id', $id) : auth()->user()->categories;
        foreach ($categories as $userCat) {
            $userProgress = SlideProgress::where('category_id', $userCat->id)->where('user_id', auth()->user()->id)->get();

            if (count($userProgress) >= count($userCat->subcategories->where('active', 'Y'))) {

                $result = [];
                foreach ($userProgress as $uP) {
                    if ($uP->result) {
                        if ($uP->result == "P") {
                            array_push($result, "P");
                        } else {
                            array_push($result, "F");
                        }
                    } else {
                        $result = null;
                        break;
                    }
                }

                if ($result) {

                    if (str_contains(implode(',', $result), "P") && !str_contains(implode(',', $result), "F")) {
                        array_push($classResults, array(
                            'id'        => $userCat->id,
                            'title'     => $userCat->title,
                            'result'    => 'Pass',
                        ));
                    } elseif (str_contains(implode(',', $result), "F")) {
                        array_push($classResults, array(
                            'id'        => $userCat->id,
                            'title'     => $userCat->title,
                            'result'    => 'Fail',
                        ));
                    }
                }
            }
        }
        return $classResults;
    }

    private function sendEmailNotificationForClassPassing($slideProgress)
    {
        $category = Category::find($slideProgress->category_id);
        $slide = $slideProgress;
        if ($slideProgress->progress >= $slide->total_slide) {
            $category_passed =  $this->getPassedUserClasses([$category->id]);
            if (@$category_passed[0]['result'] == "Pass") {
                Mail::to(auth()->user()->email)->send(new ClassPassed($category, auth()->user()));
            }
        }
    }

    public function liveVideoCall(Request $request)
    {
        try {
            $accessTokenExpire = (60 * 60 * 1);
            // !TODO: if (!session()->has('accessToken')) {
            if (
                (!session()->has('accessToken') || !session()->has('videoRoom')) ||
                session()->get('accessTokenExpire') <= time() ||
                (@$request->room_name && session()->get('videoRoom') != request('room_name'))
            ) {
                if (auth()->user()->role == 'U') {  // if user is student
                    $room_name = auth()->user()->email;
                    \Mail::to('support@kdetechnology.com')->send(new VideoCall(collect([
                        'user' => auth()->user(),
                        'videoCallUrl' => url('/live-video-call?room_name=' . $room_name)
                    ])));
                } else {  // if user is admin
                    $room_name = request()->room_name;
                }
                $twilioVideo = new TwilioVideo();
                $accessToken = $twilioVideo->generateAccessToken($room_name, $accessTokenExpire);
                session()->put('accessToken', $accessToken);
                session()->put('accessTokenExpire', time() + $accessTokenExpire);
                session()->put('videoRoom', $room_name);
            }
            return view('classroom.liveVideoCall');
        } catch (\Exception $e) {
            return view('classroom.liveVideoCall')->withErrors(['Sorry, there is an error in the video call. Please try again later.']);
        }
    }
	
	public function liveConversation(Request $request)
    {
		
        try {
            $accessTokenExpire = (60 * 60 * 1);
			$conversation_name = 'Test';
            // !TODO: if (!session()->has('accessToken')) {
            if (
                (!session()->has('accessToken') || !session()->has('videoRoom')) ||
                session()->get('accessTokenExpire') <= time() ||
                (@$request->room_name && session()->get('videoRoom') != request('room_name'))
            ) {
				
            //   if (auth()->user()->role == 'U') {  // if user is student
              //      $room_name = auth()->user()->email;
              //      \Mail::to('support@kdetechnology.com')->send(new VideoCall(collect([
              //          'user' => auth()->user(),
              //          'conversationURL' => url('/conversation-live?conversation_name=' . $conversation_name)
              //      ])));
             //   } else {  // if user is admin
              //      $room_name = request()->room_name;
             //   }
				
                $twilioConversation = new TwilioConversation();
				
                $createConvers= $twilioConversation->sendMessage();
				
				
                session()->put('accessToken', $accessToken);
                session()->put('accessTokenExpire', time() + $accessTokenExpire);
                session()->put('videoRoom', $conversation_name);
            }
			
            return view('classroom.liveConversation');
        } catch (\Exception $e) {
            return view('classroom.liveConversation')->withErrors(['Sorry, there is an error in the video call. Please try again later.']);
        }
    }
	 public function getAdminChat(Request $request){
        $conv_id = $request->conv_id;
        $conversation = Conversation::with(['userone','usertwo','messages.sender'])->where('uuid',$conv_id)->where('status','Y')->get()->first();
        if($conversation){
            return view('classroom.chat',['data' => $conversation]);
        }
        return 'Chat Expired';
    }


    public function endChat(Request $request){
        $request->session()->forget('conv_id');
        $conv_id = $request->conv_id;
        $conversation = Conversation::where('uuid',$conv_id)->where('status','Y')->get()->first();
        if($conversation){
            $con_change = Conversation::find($conversation->id);
            $con_change->status = "N";
            $con_change->save();
        }

        return redirect()->back();
    }
}
