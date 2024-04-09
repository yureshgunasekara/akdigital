<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AiChatsController;
use App\Http\Controllers\AiCodeController;
use App\Http\Controllers\AiImagesController;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Gateways\MollieController;
use App\Http\Controllers\Gateways\PaypalController;
use App\Http\Controllers\Gateways\PaystackController;
use App\Http\Controllers\Gateways\RazorpayController;
use App\Http\Controllers\Gateways\StripeController;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\InstallerDBController;
use App\Http\Controllers\IntroController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\PaymentSettingsController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SpeechTextController;
use App\Http\Controllers\TemplatesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VersionController;

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

$installed = Storage::disk('public')->exists('installed');
Route::get('/', function (Request $request) {
    $installed = Storage::disk('public')->exists('installed');

    if ($installed === true) {
        return app('App\Http\Controllers\HomeController')->Home($request);
    }

    return redirect('/setup');
});


if ($installed === true) {
    require __DIR__ . '/auth.php';

    // Global access routes
    Route::get('/', [IntroController::class, 'index']);
    Route::get('/app/{page}', [CustomPageController::class, 'page_view'])->name('custom-page.view');


    // Admin and users access routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('/templates')->middleware('openai_checker')->group(function () {
            Route::get('/', [TemplatesController::class, 'index'])->name('templates');
            Route::post('/content', [OpenAIController::class, 'template_content'])->name('template-content');
            Route::get('/content/{id}', [TemplatesController::class, 'create'])->name('content-create');
            Route::post('/content/store', [TemplatesController::class, 'store'])->name('content-store');
            Route::post('/content/search', [TemplatesController::class, 'search'])->name('content-search');
        });

        Route::prefix('/ai-images')->middleware('openai_checker')->group(function () {
            Route::get('/', [AiImagesController::class, 'index'])->name('ai-images');
            Route::post('/', [OpenAIController::class, 'ai_images'])->name('ai-images');
        });

        Route::prefix('/ai-chats')->middleware('openai_checker')->group(function () {
            Route::get('/', [AiChatsController::class, 'index'])->name('ai-chats');
            Route::post('/', [OpenAIController::class, 'ai_chats'])->name('ai-chats');
            Route::get('/chats', [AiChatsController::class, 'chats'])->name('chats.get');
            Route::post('/chat/create', [AiChatsController::class, 'chat_create'])->name('chat.create');
            Route::put('/chat/update/{id}', [AiChatsController::class, 'chat_update'])->name('chat.update');
            Route::get('/bot/{id}', [AiChatsController::class, 'ai_bot'])->name('ai-chats.bot');
            Route::get('/bot/messages/{botId}/{chatId}', [AiChatsController::class, 'chat_messages'])->name('chat.messages');
            Route::get('/chat/search', [AiChatsController::class, 'search'])->name('chat.search');
        });

        Route::prefix('/ai-code')->middleware('openai_checker')->group(function () {
            Route::get('/', [AiCodeController::class, 'index'])->name('');
            Route::post('/', [OpenAIController::class, 'ai_code'])->name('ai-code');
            Route::post('/save', [AiCodeController::class, 'save_code'])->name('code-save');
            Route::put('/update', [AiCodeController::class, 'ai_code'])->name('code-update');
            Route::get('/saved', [AiCodeController::class, 'ai_code'])->name('saved-codes');
        });

        Route::prefix('/speech-to-text')->middleware('openai_checker')->group(function () {
            Route::get('/', [SpeechTextController::class, 'speech_to_text'])->name('speech-to-text');
            Route::post('/', [OpenAIController::class, 'speech_to_text'])->name('speech-to-text');
            Route::post('/save', [SpeechTextController::class, 'text_save'])->name('text-save');
        });

        Route::prefix('/text-to-speech')->middleware('openai_checker')->group(function () {
            Route::get('/', [SpeechTextController::class, 'text_to_speech'])->name('text-to-speech');
            Route::post('/', [OpenAIController::class, 'text_to_speech'])->name('text-to-speech-save');
        });

        //---------- Saved Documents routes start ----------//
        Route::prefix('/saved-documents')->group(function () {
            Route::prefix('/template-contents')->group(function () {
                Route::get('/', [DocumentController::class, 'index'])->name('template-contents');
                Route::get('/{id}', [DocumentController::class, 'show']);
                Route::put('/{id}', [DocumentController::class, 'update'])->name('template-content-update');
                Route::delete('/{id}', [DocumentController::class, 'delete'])->name('template-content-delete');
                Route::get('/content/search', [DocumentController::class, 'search'])->name('template-contents.search');
                Route::get('/content/export', [DocumentController::class, 'export'])->name('template-contents.export');
            });
            Route::prefix('/generated-images')->group(function () {
                Route::get('/', [AiImagesController::class, 'show']);
                Route::delete('/{id}', [AiImagesController::class, 'delete'])->name('generated-images-delete');
                Route::get('/images/search', [AiImagesController::class, 'search'])->name('generated-images.search');
                Route::get('/images/export', [AiImagesController::class, 'export'])->name('generated-images.export');
            });
            Route::prefix('/generated-codes')->group(function () {
                Route::get('/', [AiCodeController::class, 'show'])->name('generated-codes');
                Route::get('/{id}', [AiCodeController::class, 'view'])->name('generated-code-view');
                Route::delete('/{id}', [AiCodeController::class, 'delete'])->name('generated-codes-delete');
                Route::get('/codes/search', [AiCodeController::class, 'search'])->name('generated-codes.search');
                Route::get('/codes/export', [AiCodeController::class, 'export'])->name('generated-codes.export');
            });
            Route::prefix('/speech-to-text')->group(function () {
                Route::get('/', [SpeechTextController::class, 'show_text'])->name('speech-to-text');
                Route::get('/{id}', [SpeechTextController::class, 'view_text'])->name('speech-to-text-view');
                Route::put('/{id}', [SpeechTextController::class, 'update_text'])->name('speech-to-text-update');
                Route::delete('/{id}', [SpeechTextController::class, 'delete_text'])->name('speech-to-text-delete');
                Route::get('/text/search', [SpeechTextController::class, 'search_text'])->name('speech-to-text.search');
                Route::get('/text/export', [SpeechTextController::class, 'export_text'])->name('speech-to-text.export');
            });
            Route::prefix('/text-to-speeches')->group(function () {
                Route::get('/', [SpeechTextController::class, 'show_speeches'])->name('text-to-speech');
                Route::delete('/{id}', [SpeechTextController::class, 'delete_speech'])->name('text-to-speech-delete');
                Route::get('/speeches/search', [SpeechTextController::class, 'search_speech'])->name('text-to-speech.search');
                Route::get('/speeches/export', [SpeechTextController::class, 'export_speech'])->name('text-to-speech.export');
            });
        });
        //---------- Saved Documents routes end ------------//

        //---------- Support Requests routes start ----------//
        Route::prefix('/support-request')->group(function () {
            Route::get('/', [SupportController::class, 'index'])->name('support-request');
            Route::get('/create', [SupportController::class, 'create'])->name('support-request.create');
            Route::post('/store', [SupportController::class, 'store'])->name('support-request.store');
            Route::delete('/delete/{id}', [SupportController::class, 'delete'])->name('support-request.delete');
            Route::get('/conversation/{id}', [SupportController::class, 'conversation'])->name('support-request.conversation');
            Route::post('/conversation/replay', [SupportController::class, 'replay'])->name('support-request.replay');
            Route::get('/supports/search', [SupportController::class, 'search'])->name('support-request.search');
            Route::get('/supports/export', [SupportController::class, 'export'])->name('support-request.export');
        });
        //---------- Support Requests routes end ------------//

        //---------- Profile routes start ----------//
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        //---------- Profile routes end ----------//

        //---------- Settings routes start ----------//
        Route::get('/settings/profile', [ProfileController::class, 'profile'])->name('settings.profile');
        Route::post('/settings/profile', [ProfileController::class, 'profile_update'])->name('settings.profile.update');
        Route::get('/settings/account', [ProfileController::class, 'account'])->name('settings.account');
        //---------- Settings routes end ----------//

        //---------- Update plan routes start ----------//
        Route::get('/current-plan', [SubscriptionPlanController::class, 'index'])->name('plans.current');
        Route::get('/select-plan', [SubscriptionPlanController::class, 'select'])->name('plans.select');
        Route::get('/plans/{id}', [SubscriptionPlanController::class, 'selected'])->name('plans.selected');

        Route::get('/plans/{stripeId}/stripe/checkout/{planId}', [SubscriptionPlanController::class, 'stripeCheckout'])->name('plans.stripe.checkout');
        Route::post('/plans/stripe/process-subscription', [SubscriptionPlanController::class, 'stripeProcessSubscription'])->name('plans.stripe.processSubscription');

        Route::get('/plans/{razorpayId}/razorpay/checkout/{planId}', [SubscriptionPlanController::class, 'razorpayCheckout'])->name('plans.razorpay.checkout');
        Route::post('/plan/razorpay/save-subscription', [SubscriptionPlanController::class, 'saveRazorpaySubscription'])->name('plan.razorpay.subscription.save');
        Route::post('/plan/razorpay/subscription-activation', [SubscriptionPlanController::class, 'activeSubscriptionPlan'])->name('plan.razorpay.subscription.active');

        Route::get('/plan/{paddleId}/paddle/checkout/{planId}', [SubscriptionPlanController::class, 'paddleCheckout'])->name('plan.paddle.checkout');
        Route::post('/plan/paddle/save-subscription', [SubscriptionPlanController::class, 'savePaddleSubscription'])->name('plan.paddle.subscription.save');
        //---------- Update plan routes end ----------//


        // Paypal routes start
        Route::post('/paypal/payment', [PaypalController::class, 'payment'])->name('paypal.payment');
        Route::get('/paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
        Route::get('/paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

        // Paypal routes start
        Route::post('/stripe/payment', [StripeController::class, 'payment'])->name('stripe.payment');
        Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
        Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

        // Razorpay routes start
        Route::get('/razorpay/form', [RazorpayController::class, 'show_form'])->name('razorpay.form');
        Route::post('/razorpay/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');

        // mollie routes start
        Route::post('/mollie/payment', [MollieController::class, 'payment'])->name('mollie.payment');
        Route::get('/mollie/success', [MollieController::class, 'success'])->name('mollie.success');

        // paystack routes start
        Route::get('/paystack/redirect', [PaystackController::class, 'paystack_redirect'])->name('paystack.redirect');
        Route::get('/paystack/callback', [PaystackController::class, 'verify_transaction'])->name('paystack.callback');
    });


    // Only admin access routes
    //---------- Admin access routes start ----------//
    Route::prefix('/admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin.dashboard');

        //---------- Testimonials routes start ----------//
        Route::prefix('/testimonials')->group(function () {
            Route::get('/', [TestimonialController::class, 'index'])->name('testimonials');
            Route::get('/create', [TestimonialController::class, 'create'])->name('testimonial.create');
            Route::post('/store', [TestimonialController::class, 'store'])->name('testimonial.store');
            Route::get('/get/{id}', [TestimonialController::class, 'get'])->name('testimonial.get');
            Route::post('/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
            Route::delete('/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonial.delete');
        });
        //---------- Testimonials routes end ----------//


        //---------- Settings routes start ----------//
        Route::prefix('/settings')->group(function () {
            Route::get('/auth', [SettingsController::class, 'auth'])->name('settings.auth');
            Route::patch('/auth/google', [SettingsController::class, 'auth_google'])->name('settings.auth-google');

            Route::get('/global', [SettingsController::class, 'global'])->name('settings.global');
            Route::post('/global/update', [SettingsController::class, 'global_update'])->name('settings.global-update');
            Route::post('/global/add-social', [SettingsController::class, 'add_social'])->name('settings.add-social');
            Route::post('/global/update-social/{id}', [SettingsController::class, 'update_social'])->name('settings.update-social');
            Route::delete('/global/delete-social/{id}', [SettingsController::class, 'delete_social'])->name('settings.delete-social');

            Route::get('/openai', [SettingsController::class, 'openai'])->name('settings.openai');
            Route::patch('/openai/update', [SettingsController::class, 'openai_update'])->name('settings.openai-update');
            Route::post('/openai/model', [SettingsController::class, 'model'])->name('settings.openai-model');

            Route::patch('/aws-setup', [SettingsController::class, 'aws_setup'])->name('settings.aws');

            Route::get('/smtp', [SettingsController::class, 'smtp'])->name('settings.smtp');
            Route::put('/smtp/update', [SettingsController::class, 'smtp_update'])->name('settings.smtp-update');

            Route::get('/payment', [PaymentSettingsController::class, 'index']);
            Route::prefix('/payment')->group(function () {
                Route::patch('/stripe', [PaymentSettingsController::class, 'stripe_update'])->name('settings.stripe');
                Route::patch('/razorpay', [PaymentSettingsController::class, 'razorpay_update'])->name('settings.razorpay');
                Route::patch('/paypal', [PaymentSettingsController::class, 'paypal_update'])->name('settings.paypal');
                Route::patch('/mollie', [PaymentSettingsController::class, 'mollie_update'])->name('settings.mollie');
                Route::patch('/paystack', [PaymentSettingsController::class, 'paystack_update'])->name('settings.paystack');
            });
        });
        //---------- Settings routes end ----------//


        //---------- App Control routes start ----------//
        Route::get('/app-control', [SettingsController::class, 'appControl']);
        //---------- App Control routes start ----------//


        //---------- Pricing routes start ----------//
        Route::prefix('/pricing-management')->group(function () {
            Route::get('/', [PricingController::class, 'index'])->name('plans');
            Route::get('/create', [PricingController::class, 'create'])->name('plans.create');
            Route::post('/store', [PricingController::class, 'store'])->name('plans.store');
            Route::patch('/update/{planId}', [PricingController::class, 'update'])->name('plans.update');
        });
        //---------- Pricing routes end ----------//


        //---------- Subscription routes start ----------//
        Route::prefix('/finance-management')->group(function () {
            Route::get('/transactions', [SubscriptionPlanController::class, 'transaction']);
            Route::get('/transactions/search', [SubscriptionPlanController::class, 'search_transaction'])->name('transaction.search');
            Route::get('/transactions/export', [SubscriptionPlanController::class, 'export_transaction'])->name('transaction.export');

            Route::get('/subscriptions', [SubscriptionPlanController::class, 'subscription']);
            Route::get('/subscriptions/search', [SubscriptionPlanController::class, 'search_subscription'])->name('subscription.search');
            Route::get('/subscriptions/export', [SubscriptionPlanController::class, 'export_subscription'])->name('subscription.export');
        });
        //---------- Subscription routes end ----------//


        //---------- Support requests routes start ----------//
        Route::prefix('/support-requests')->group(function () {
            Route::get('/', [SupportController::class, 'index'])->name('support-request');
            Route::get('/create', [SupportController::class, 'create'])->name('support-request.create');
            Route::get('/conversation/{id}', [SupportController::class, 'conversation'])->name('support-request.conversation');
        });
        //---------- Support requests routes end ------------//


        //---------- Templates management routes start ----------//
        Route::prefix('/templates-management')->group(function () {
            Route::get('/', [TemplatesController::class, 'show'])->name('templates.admin');
            Route::get('/{id}', [TemplatesController::class, 'edit'])->name('templates.edit');
            Route::patch('/{id}', [TemplatesController::class, 'update'])->name('templates.update');
            Route::get('/templates/search', [TemplatesController::class, 'search'])->name('templates.search');
        });
        //---------- Templates management routes end ----------//


        //---------- User management routes start ----------//
        Route::prefix('/user-management')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('users.admin');
            Route::get('/{id}', [UsersController::class, 'edit'])->name('users.edit');
            Route::post('/{id}', [UsersController::class, 'update'])->name('users.update');
            Route::get('/profile/{id}', [UsersController::class, 'profile'])->name('users.profile');
            Route::get('/users/search', [UsersController::class, 'search'])->name('users.search');
        });
        //---------- User management routes end ----------//


        //---------- Custom page create routes start ----------//
        Route::prefix('/page-management')->group(function () {
            Route::get('/', [CustomPageController::class, 'index'])->name('custom-page');
            Route::get('/create', [CustomPageController::class, 'create'])->name('custom-page.create');
            Route::post('/store', [CustomPageController::class, 'store'])->name('custom-page.store');
            Route::get('/update/{id}', [CustomPageController::class, 'update'])->name('custom-page.update');
            Route::put('/save/{id}', [CustomPageController::class, 'save'])->name('custom-page.save');
            Route::delete('/delete/{id}', [CustomPageController::class, 'delete'])->name('custom-page.delete');
        });
        //---------- Custom page create routes end ----------//
    });


    Route::middleware('admin')->group(function () {
        Route::get('/customize', [IntroController::class, 'customize']);
        Route::prefix('/inro-section')->middleware('admin')->group(function () {
            Route::put('/update/{id}', [IntroController::class, 'section']);
            Route::put('/child/update/{id}', [IntroController::class, 'child_section']);
            Route::put('/child/link/update', [IntroController::class, 'section_link']);
        });

        // Version Update for only admin
        Route::get('/version/check', [VersionController::class, 'checkVersion']);
        Route::get('/version/current', [VersionController::class, 'getCurrentVersion']);
        Route::get('/version/update', [VersionController::class, 'updateVersion']);
    });
    //---------- Admin access routes end ----------//
} else {
    Route::prefix('/setup')->group(function () {
        Route::get('/', [InstallerController::class, 'checkServer'])->name('setup');

        Route::get('/step-1', [InstallerController::class, 'viewStep1'])->name('view.step1');
        Route::post('/step-1', [InstallerController::class, 'setupStep1'])->name('setup.step1');

        Route::get('/step-2', [InstallerController::class, 'viewStep2'])->name('view.step2');
        Route::post('/step-2', [InstallerController::class, 'setupStep2'])->name('setup.step2');

        Route::get('/step-3', [InstallerController::class, 'viewStep3'])->name('view.step3');
        Route::post('/step-3', [InstallerController::class, 'setupStep3'])->name('setup.step3');

        Route::get('/install', [InstallerController::class, 'installView']);
        Route::post('/install', [InstallerController::class, 'installVersion']);

        Route::post('/check-database', [InstallerDBController::class, 'databaseChecker']);
        Route::get('/generate-app-key', [InstallerController::class, 'generateAppKey']);
    });
    Route::get('/{url?}', [InstallerController::class, 'backToSetup'])->where('url', '^(?!setup).*$');
}
