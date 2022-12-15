<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactUsFormController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\FaceVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/stream', 'stream');

Route::get('/clear-cache', function () {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('view:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    return 'FINISHED';
});
Route::get('/facePerson', [FaceVerificationController::class, 'facePerson']);
/* Sitemap Route*/
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

Route::post('/getTempPath', [FaceVerificationController::class, 'getTempPath']);
Route::post('/verify-head-pose', [FaceVerificationController::class, 'verifyHeadPose']);
Route::post('/verify-face-verified', [FaceVerificationController::class, 'verifieFaceVerified']);
// Analytics
Route::get('/analyticLivePing', [AnalyticController::class, 'analyticLivePing'])->name('analyticLivePing');
Route::get('/analyticStop', [AnalyticController::class, 'analyticStop'])->name('analyticStop');

//Chat Routes
Route::get('/conversation', [UserController::class, 'getAdminChat']);
Route::get('/end-chat', [UserController::class, 'endChat']);
//
Route::middleware(['analytics'])->group(
    function () {
        /* -------------------------------------------------------------------------- */
        /*                                 User Routes                                */
        /* -------------------------------------------------------------------------- */
        /* ------------------------------- Front Pages ------------------------------ */
        Route::view('/', 'home');
        Route::view('/About', 'about');
        Route::view('/Miner-New-Experienced-Annual', 'miner');
        Route::view('/Other-Training', 'otherTraining');
        Route::view('/passwordreset', 'auth.forgetpass');
        Route::view('/drilling_blasting_explosives', 'drilling');
        Route::get('/home', function () {
            return redirect('/Dashboard');
        });
        Route::get('/dashboard', function () {
            return redirect('/Dashboard');
        });
        /* -------------------------------------------------------------------------- */

        /* ---------------------------------- Auth ---------------------------------- */
        Route::post('/register', [RegisterController::class, 'register']);
        Route::post('/resend-activation-email', [RegisterController::class, 'resendActivationEmail'])->name('register.resendActivationEmail');;
        Route::post('passwordreset', [ForgetController::class, 'forgetpass']);
        Route::post('resetpass', [ForgetController::class, 'resetpass']);
        Route::get('forgetpass/{token}', [ForgetController::class, 'showforgetPass']);
        Route::post('send-activate-acc-email', [AdminController::class, 'sendPasswordResetToken']);
        Route::get('password-reset/{token}', [AdminController::class, 'showPasswordResetForm']);
        Route::post('password-reset', [AdminController::class, 'resetPassword']);
        Route::post('account-activate', [RegisterController::class, 'activateAccount']);
        /* -------------------------------------------------------------------------- */

        /* --------------------------------- Other -------------------------------- */
        // Contant Us Form
        Route::get('/contact', [ContactUsFormController::class, 'createForm']);
        Route::post('/contact', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');
        //CAPTCHA
        Route::post('/captcha-validation', [RegisterController::class, 'captchaFormValidate']);
        Route::get('/reload-captcha', [RegisterController::class, 'reloadCaptcha']);
        // Route::get('/live-video-call', [UserController::class, 'liveVideoCall'])->middleware('auth');
        Route::get('/live-conversation', [UserController::class, 'liveConversation'])->middleware('auth');
        /* -------------------------------------------------------------------------- */

        Route::middleware(['auth', 'verified'])->group(function () {
            //Customer Section

            Route::get('/Dashboard', [UserController::class, 'index']);
            Route::post('/restart_lesson', [UserController::class, 'restartLesson']);
            Route::get('/slideShow/{cat}/{subcat}/{slideIndex}', [UserController::class, 'slideShow'])->middleware(['slide']);
            Route::post('/slide/qa/{slideContentId}', [UserController::class, 'slideQa']);
            Route::get('/my_certificates', [UserController::class, 'myCerts']);
            Route::get('/buy_class', [UserController::class, 'buyClass']);
            Route::get('/add_to_cart', [UserController::class, 'addToCart']);
            Route::get('/my_cart', [UserController::class, 'myCart']);
            Route::get('/certificate/{catid}', [UserController::class, 'certGen']);
            Route::post('/agreement', [UserController::class, 'agreement']);

            //Orders
            Route::post('paypal', [OrderController::class, 'paypal'])->name('checkout.paypal');
            Route::get('returnPaypal', [OrderController::class, 'returnPaypal'])->name('process.paypal');
            Route::get('cancelPaypal', [OrderController::class, 'cancelPaypal'])->name('cancel.paypal');
            Route::resource('/paymentStatus', OrderController::class);

            Route::post('/face-verify', [FaceVerificationController::class, 'faceMatch']);
        });
        /* -------------------------------------------------------------------------- */



        /* -------------------------------------------------------------------------- */
        /*                                Admin Routes                                */
        /* -------------------------------------------------------------------------- */
        Route::group(['as' => 'admin.', 'middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
            Route::view('home', 'home')->name('home');
            Route::get('/dashboard', [AdminController::class, 'index']);
            Route::get('/searchuser', [AdminController::class, 'search'])->name('searchuser');
            Route::get('/Add-New-Client', [AdminController::class, 'createNewClient']);
            Route::post('/Add-New-Client', [AdminController::class, 'storeNewClient']);
            Route::get('/Clients', [AdminController::class, 'clients']);
            Route::get('/Manage-Client-Accounts', [AdminController::class, 'manageClientAcc']);
            Route::post('/removeClient/{id}', [AdminController::class, 'removeClient']);
            Route::post('/editClient', [AdminController::class, 'editClient'])->name('editClient');
            Route::post('/updateClient', [AdminController::class, 'updateClient']);
            Route::post('/changeStatus/{id}/{status}', [AdminController::class, 'changeStatus']);
            Route::get('users/export', 'App\Http\Controllers\UserController@export');

            //Category
            Route::get('category', [AdminController::class, 'category']);
            Route::get('category/create', [AdminController::class, 'categoryCreate']);
            Route::post('category/store', [AdminController::class, 'categoryStore']);
            Route::get('category/edit/{id}', [AdminController::class, 'categoryEdit']);
            Route::put('category/update/{id}', [AdminController::class, 'categoryUpdate']);
            Route::delete('category/destroy/{id}', [AdminController::class, 'categoryDestroy']);
            Route::post('category/copy/{id}', [AdminController::class, 'categoryCopy']);
            Route::get('category/copy/{id}', [AdminController::class, 'categoryCopy']);
            //Subcategory
            Route::get('subcategory/cat', [AdminController::class, 'subcategoryCat']);
            Route::get('subcategory/index/{id}', [AdminController::class, 'subcategory']);
            Route::get('subcategory/create', [AdminController::class, 'subcategoryCreate']);
            Route::post('subcategory/store', [AdminController::class, 'subcategoryStore']);
            Route::get('subcategory/edit/{id}', [AdminController::class, 'subcategoryEdit']);
            Route::put('subcategory/update/{id}', [AdminController::class, 'subCategoryUpdate']);
            Route::delete('subcategory/destroy/{id}', [AdminController::class, 'subCategoryDestroy']);
            //Q&A
            Route::get('qas/cat', [AdminController::class, 'qaCat']);
            Route::get('qas/subcategory/{id}', [AdminController::class, 'qaSubcat']);
            Route::get('qas/index/{id}', [AdminController::class, 'qa']);
            Route::get('qas/create', [AdminController::class, 'qaCreate']);
            Route::post('qas/store', [AdminController::class, 'qaStore']);
            Route::get('qas/edit/{id}', [AdminController::class, 'qaEdit']);
            Route::put('qas/update/{id}', [AdminController::class, 'qaUpdate']);
            Route::delete('qas/destroy/{id}', [AdminController::class, 'qaDestroy']);
            //Slides
            Route::get('slides/cat', [AdminController::class, 'slideCat']);
            Route::get('slides/subcategory/{id}', [AdminController::class, 'slideSubcat']);
            Route::get('slides/index/{id}', [AdminController::class, 'slide']);
            Route::get('slides/getqas', [AdminController::class, 'getqas']);
            Route::get('slides/create', [AdminController::class, 'slideCreate']);
            Route::post('slides/store', [AdminController::class, 'slideStore']);
            Route::get('slides/edit/{id}', [AdminController::class, 'slideEdit']);
            Route::get('slides/slideOrder/{id}', [AdminController::class, 'slideOrder']);
            Route::post('slides/update/{id}', [AdminController::class, 'slideUpdate']);
            Route::post('slides/update-slide-content/{slideID}/{contentIndex}', [AdminController::class, 'slideContentUpdate']);
            Route::post('slides/update-details/{slideID}', [AdminController::class, 'slideUpdateDetails']);
            Route::post('slides/slideOrderUpdate/{id}', [AdminController::class, 'slideOrderUpdate']);
            Route::get('slides/destroy/{id}', [AdminController::class, 'slideDestroy']);
            Route::post('slides/copy/{id}', [AdminController::class, 'slidesCopy']);
            Route::get('slides/copy/{id}', [AdminController::class, 'slidesCopy']);



            //addAdmin
            Route::get('/Add-New-Admin', [AdminController::class, 'createNewAdmin']);
            Route::post('/Add-New-Admin', [AdminController::class, 'createAdmin']);

            //Reset Progress
            Route::get('/reset_progress', [AdminController::class, 'resetProgressIndex']);
            Route::post('/reset_progress', [AdminController::class, 'resetProgress']);

            //User Answers
            Route::get('/user_answers', [AdminController::class, 'user_answers_show']);
            Route::post('/user_answers', [AdminController::class, 'user_answers']);

            // Agreements
            Route::get('/agreements', [AdminController::class, 'allAgreements']);
            Route::post('/agreements', [AdminController::class, 'userAgreements']);

            // Analytics
            Route::get('/analytics/{user_id?}', [AnalyticController::class, 'index']);
            Route::get('/analytics-group-by/{type}/{user_id?}', [AnalyticController::class, 'groupBy']);
        });
        /* -------------------------------------------------------------------------- */
    }
);

/* ------------------------------- Face Verify ------------------------------ */
Route::post('/getTempPath', [FaceVerificationController::class, 'getTempPath']);
Route::post('/verify-head-pose', [FaceVerificationController::class, 'verifyHeadPose']);
Route::post('/match-faces', [FaceVerificationController::class, 'matchFaces']);
/* -------------------------------------------------------------------------- */