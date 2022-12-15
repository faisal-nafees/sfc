<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use PayPalHttp\HttpException;
use App\Http\Requests\StoreOrder;
use App\Models\Category;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('classroom.paymentStatus');
    }

    public function paypal(Request $request)
    {
        if (Session::has('cart') && !empty(Session::get('cart'))) {
            $cart           = Session::get('cart');
            // Creating an environment
            $clientId       = env('PAYPAL_CLIENT_ID');
            $clientSecret   = env('PAYPAL_SECRET_ID');
          

            // $environment    = new SandboxEnvironment($clientId, $clientSecret);
            $environment    = new ProductionEnvironment($clientId, $clientSecret);
            $client         = new PayPalHttpClient($environment);
            $pendingOrder   = Order::where('user_id', auth()->user()->id)
                ->where('status', 'P')->first();

            if ($pendingOrder) {
                $pendingOrder->status   = 'F';
                $pendingOrder->save();
            }
            $categories           = Category::whereIn('id', $cart->getContents())->where('active', 'Y')->get();
            $totalPrice           = $categories->sum('price');

            $order                = new Order;
            $order->user_id       = auth()->user()->id;
            $order->ref_id        = "REF" . auth()->user()->id . time();
            $order->category_ids  = implode(',', $cart->getContents());
            $order->amount        = $totalPrice;
            $order->status        = 'P';
            $order->save();

            $request        = new OrdersCreateRequest();
            $request->prefer('return=representation');
            $request->body  = [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "reference_id" => $order->ref_id,
                    "amount" => [
                        "value" => $totalPrice,
                        "currency_code" => "USD"
                    ]
                ]],
                "application_context" => [
                    "cancel_url" => route('cancel.paypal'),
                    "return_url" => route('process.paypal')
                ]
            ];

            try {
                // Call API with your client and get a response for your call
                $response   = $client->execute($request);
                if ($response->statusCode == 201) {
                    $order->token   = $response->result->id;
                    $order->save();

                    return redirect($response->result->links['1']->href);
                } else {
                    return redirect('paymentStatus')->withErrors(['Something went wrong! Please try again.']);
                }
            } catch (HttpException $ex) {
                echo "<div style='text-align:center; width:100vw;' >";
                echo "<h1>Error Code: " . $ex->statusCode . "</h1><br>";
                echo $ex->getMessage();
                echo "</div>";
            }
        } else {
            return redirect('paymentStatus')->withErrors(['Invalid Activity!']);
        }
    }

    public function returnPaypal(Request $request)
    {
        $clientId       = env('PAYPAL_CLIENT_ID');
        $clientSecret   = env('PAYPAL_SECRET_ID');

        // $environment    = new SandboxEnvironment($clientId, $clientSecret);
        $environment    = new ProductionEnvironment($clientId, $clientSecret);
        $client         = new PayPalHttpClient($environment);
        $orderCapture   = new OrdersCaptureRequest($request->token);
        $orderCapture->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($orderCapture);
            // dd($response);
            if ($response->statusCode == 201) {
                $order          = Order::where('user_id', auth()->user()->id)
                    ->where('status', 'P')->first();
                if (
                    $order &&
                    $order->token   == $response->result->id &&
                    $order->ref_id  == $response->result->purchase_units[0]->reference_id &&
                    $order->amount  == $response->result->purchase_units[0]->amount->value
                ) {
                    $order->status          = 'C';
                    $order->pp_full_name    = $response->result->payer->name->given_name . ' ' . $response->result->payer->name->surname;
                    $order->pp_email        = $response->result->payer->email_address;
                    $order->pp_payer_id     = $response->result->payer->payer_id;
                    $order->pp_debug_id     = $response->headers["Paypal-Debug-Id"];
                    $order->save();

                    $user                   = User::find(auth()->user()->id);
                    $user->categories()->attach(explode(',', $order->category_ids), ['created_at' => now(), 'updated_at' => now()]);

                    session()->forget('cart');
                    return redirect('paymentStatus')->with('success', 'Payment Successful');
                }
            }
            return redirect('paymentStatus')->withErrors(['Payment Failed!']);
        } catch (HttpException $ex) {
            return redirect('paymentStatus')->withErrors([$ex->statusCode . ' ' . $ex->getMessage()]);
        }
    }

    public function cancelPaypal()
    {
        return redirect('paymentStatus')->with('canceled', 'Payment Canceled');
    }
}
