<?php

use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GatewayController;
use App\Http\Controllers\Admin\ImageGalleryController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\ModeratorController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NewsSubscriptionLetterController;
use App\Http\Controllers\Admin\NewsTagController;
use App\Http\Controllers\Admin\NoticeCategoryController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\PassingYearController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\SubscriptionEmailTemplateController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Website\WebsiteSettingController;
use App\Http\Controllers\Admin\VersionUpdateController;
use App\Http\Controllers\Admin\AddonUpdateController;
use App\Http\Controllers\addon\saas\admin\OrderController;
use App\Http\Controllers\addon\saas\admin\SubscriptionController;
use App\Http\Controllers\addon\saas\admin\CustomDomainRequestController;
use Illuminate\Support\Facades\Route;

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

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Event Route Start
Route::group(['prefix' => 'event', 'as' => 'event.', 'middleware' => ['can:Manage Event']], function () {
    Route::get('/category', [EventCategoryController::class, 'index'])->name('category.index');
    Route::post('/store', [EventCategoryController::class, 'store'])->name('category.store');
    Route::get('/info/{id}', [EventCategoryController::class, 'info'])->name('category.info');
    Route::post('/update/{id}', [EventCategoryController::class, 'update'])->name('category.update');
    Route::post('/delete/{id}', [EventCategoryController::class, 'delete'])->name('category.delete');
    Route::get('/pending', [EventController::class, 'pending'])->name('pending.index');
});
// Event Route End

// Membership Route Start
Route::group(['prefix' => 'membership', 'as' => 'membership.', 'middleware' => ['can:Manage Membership']], function () {
    Route::get('index', [MembershipController::class, 'index'])->name('index');
    Route::post('store', [MembershipController::class, 'store'])->name('store');
    Route::get('edit/{slug}', [MembershipController::class, 'edit'])->name('edit');
    Route::post('update/{slug}', [MembershipController::class, 'update'])->name('update');
    Route::post('delete/{id}', [MembershipController::class, 'delete'])->name('delete');
    Route::get('list', [MembershipController::class, 'list'])->name('list');
});
// Membership Route End

// JobPost Route Start
Route::group(['prefix' => 'job-post', 'as' => 'jobPost.', 'middleware' => ['can:Manage Job Post']], function () {
    Route::get('/pending-job-post', [JobPostController::class, 'pendingJobPost'])->name('pending-job-post');
    Route::get('info/{slug}', [JobPostController::class, 'info'])->name('info');
    Route::post('update/{slug}', [JobPostController::class, 'update'])->name('update');
    Route::post('delete/{slug}', [JobPostController::class, 'delete'])->name('delete');
});
// JobPost Route End

// Stories route start
Route::group(['prefix' => 'stories', 'as' => 'stories.', 'middleware' => ['can:Manage Story']], function () {
    Route::get('pending', [StoryController::class, 'pending'])->name('pending');
});
// Stories route end

// Manage role Route Start
Route::group(['prefix' => 'roles', 'as' => 'roles.', 'middleware' => ['can:Manage Moderator']], function () {
    Route::get('/', [RolePermissionController::class, 'index'])->name('index');
    Route::post('store', [RolePermissionController::class, 'store'])->name('store');
    Route::get('edit/{id}', [RolePermissionController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [RolePermissionController::class, 'update'])->name('update');
    Route::post('destroy/{id}', [RolePermissionController::class, 'destroy'])->name('destroy');
});
// Manage role Route end

// Manage moderator Route Start
Route::group(['prefix' => 'moderators', 'as' => 'moderators.', 'middleware' => ['can:Manage Moderator']], function () {
    Route::get('/', [ModeratorController::class, 'index'])->name('index');
    Route::post('store', [ModeratorController::class, 'store'])->name('store');
    Route::get('edit/{id}', [ModeratorController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [ModeratorController::class, 'update'])->name('update');
    Route::post('delete/{id}', [ModeratorController::class, 'delete'])->name('delete');
});
// Manage moderator Route End

// Manage Alumni Route Start
Route::group(['prefix' => 'alumni', 'as' => 'alumni.', 'middleware' => ['can:Manage Alumni']], function () {
    Route::get('list-search-with-filter', [AlumniController::class, 'alumniListWithAdvanceFilter'])->name('list-search-with-filter');
    Route::get('alumni-profile-edit/{id}', [AlumniController::class, 'alumniProfileData'])->name('profile-edit');
    Route::post('alumni-institution-store', [AlumniController::class, 'storeAlumniInstitution'])->name('institution-store');
    Route::post('alumni-profile-update', [AlumniController::class, 'updateAlumniProfile'])->name('profile-update');
    Route::get('list-pending-alumni-with-filter', [AlumniController::class, 'alumniPendingListWithAdvanceFilter'])->name('list-pending-alumni-with-filter');
    Route::post('change-alumni-status', [AlumniController::class, 'alumniChangeStatus'])->name('change-alumni-status');
});
// Manage Alumni Route End

Route::get('script-'.now()->format('Ymd'), [VersionUpdateController::class, 'pathFile'])->name('script-file');
Route::post('script-file', [VersionUpdateController::class, 'downloadPathFile'])->name('load-script-file');
Route::post('store-script-file', [VersionUpdateController::class, 'storePathFile'])->name('store-script-file');

Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
    Route::group(['middleware' => []], function () {
        Route::get('application-settings', [SettingController::class, 'applicationSetting'])->middleware('can:Manage Application Setting')->name('application-settings');
        Route::get('configuration-settings', [SettingController::class, 'configurationSetting'])->middleware('can:Manage Application Setting')->name('configuration-settings');
        Route::get('configuration-settings/configure', [SettingController::class, 'configurationSettingConfigure'])->middleware('can:Manage Application Setting')->name('configuration-settings.configure');
        Route::get('configuration-settings/help', [SettingController::class, 'configurationSettingHelp'])->middleware('can:Manage Application Setting')->name('configuration-settings.help');
        Route::post('application-settings-update', [SettingController::class, 'applicationSettingUpdate'])->middleware('can:Manage Application Setting')->name('application-settings.update');
        Route::post('configuration-settings-update', [SettingController::class, 'configurationSettingUpdate'])->middleware('can:Manage Application Setting')->name('configuration-settings.update');
        Route::post('application-env-update', [SettingController::class, 'saveSetting'])->middleware('can:Manage Application Setting')->name('settings_env.update');
        Route::get('logo-settings', [SettingController::class, 'logoSettings'])->middleware('can:Manage Application Setting')->name('logo-settings');
        Route::get('color-settings', [SettingController::class, 'colorSettings'])->middleware('can:Manage Application Setting')->name('color-settings');
        Route::get('registration-form-settings', [SettingController::class, 'registrationFormSetting'])->middleware('can:Manage Application Setting')->name('registration-form-settings');
        Route::post('registration-form-settings', [SettingController::class, 'registrationFormSettingStore'])->middleware('can:Manage Application Setting')->name('registration-form-setting-store');

        //website settings
        Route::group(['prefix' => 'website-settings', 'as' => 'website-settings.', 'middleware' => ['can:Manage Website Settings']], function () {
            Route::get('/', [WebsiteSettingController::class, 'commonSetting'])->name('index');
            Route::get('banner-setting', [WebsiteSettingController::class, 'bannerSetting'])->name('banner.setting');
            Route::get('why-you-should-join-us', [WebsiteSettingController::class, 'whyYouShouldJoinUs'])->name('why-you-should-join-us');
            Route::get('about-us', [WebsiteSettingController::class, 'aboutUs'])->name('about-us');
            Route::get('privacy-policy', [WebsiteSettingController::class, 'privacyPolicy'])->name('privacy-policy');
            Route::get('cookie-policy', [WebsiteSettingController::class, 'cookiePolicy'])->name('cookie-policy');
            Route::get('terms-condition', [WebsiteSettingController::class, 'termsCondition'])->name('terms-condition');
            Route::get('refund-policy', [WebsiteSettingController::class, 'refundPolicy'])->name('refund-policy');
            Route::get('contact-us', [WebsiteSettingController::class, 'contactUs'])->name('contact-us');

            Route::group(['prefix' => 'image-galleries', 'as' => 'image_galleries.'], function () {
                Route::get('', [ImageGalleryController::class, 'index'])->name('index');
                Route::post('', [ImageGalleryController::class, 'store'])->name('store');
                Route::get('edit/{id}', [ImageGalleryController::class, 'edit'])->name('edit');
                Route::patch('update/{id}', [ImageGalleryController::class, 'update'])->name('update');
                Route::post('delete/{id}', [ImageGalleryController::class, 'delete'])->name('delete');
            });
        });

        Route::group(['prefix' => 'currency', 'as' => 'currencies.', 'middleware' => ['can:Manage Application Setting']], function () {
            Route::get('', [CurrencyController::class, 'index'])->name('index');
            Route::post('currency', [CurrencyController::class, 'store'])->name('store');
            Route::get('edit/{id}', [CurrencyController::class, 'edit'])->name('edit');
            Route::patch('update/{id}', [CurrencyController::class, 'update'])->name('update');
            Route::post('delete/{id}', [CurrencyController::class, 'delete'])->name('delete');
        });

        Route::get('storage-settings', [SettingController::class, 'storageSetting'])->middleware('can:Manage Application Setting')->name('storage.index');
        Route::post('storage-settings', [SettingController::class, 'storageSettingsUpdate'])->middleware('can:Manage Application Setting')->name('storage.update');
        Route::get('google-recaptcha-settings', [SettingController::class, 'googleRecaptchaSetting'])->middleware('can:Manage Application Setting')->name('google-recaptcha');
        Route::get('google-analytics-settings', [SettingController::class, 'googleAnalyticsSetting'])->middleware('can:Manage Application Setting')->name('google.analytics');
    });

    Route::get('mail-configuration', [SettingController::class, 'mailConfiguration'])->name('mail-configuration');
    Route::post('mail-configuration', [SettingController::class, 'mailConfiguration'])->name('mail-configuration');
    Route::post('mail-test', [SettingController::class, 'mailTest'])->name('mail.test');

    Route::get('sms-configuration', [SettingController::class, 'smsConfiguration'])->name('sms-configuration');
    Route::post('sms-configuration', [SettingController::class, 'smsConfigurationStore'])->name('sms-configuration');
    Route::post('sms-test', [SettingController::class, 'smsTest'])->name('sms.test');


    //Start:: Maintenance Mode
    Route::get('maintenance-mode-changes', [SettingController::class, 'maintenanceMode'])->name('maintenance');
    Route::post('maintenance-mode-changes', [SettingController::class, 'maintenanceModeChange'])->name('maintenance.change')->middleware('isDemo');
    //End:: Maintenance Mode

    Route::get('cache-settings', [SettingController::class, 'cacheSettings'])->name('cache-settings');
    Route::get('cache-update/{id}', [SettingController::class, 'cacheUpdate'])->name('cache-update');
    Route::get('storage-link', [SettingController::class, 'storageLink'])->name('storage.link');
    Route::get('security-settings', [SettingController::class, 'securitySettings'])->name('security.settings');

    Route::group(['prefix' => 'gateway', 'as' => 'gateway.', 'middleware' => ['can:Manage Application Setting']], function () {
        Route::get('/', [GatewayController::class, 'index'])->name('index');
        Route::post('store', [GatewayController::class, 'store'])->name('store')->middleware('isDemo');
        Route::get('get-info', [GatewayController::class, 'getInfo'])->name('get.info');
        Route::get('get-currency-by-gateway', [GatewayController::class, 'getCurrencyByGateway'])->name('get.currency');
        Route::get('syncs', [GatewayController::class, 'syncs'])->name('syncs');
    });

    //Features Settings
    Route::get('cookie-settings', [SettingController::class, 'cookieSetting'])->name('cookie-settings');
    Route::post('cookie-settings-update', [SettingController::class, 'cookieSettingUpdated'])->name('cookie.settings.update');
    Route::get('live-chat-settings', [SettingController::class, 'liveChatSettings'])->name('live.chat.settings');

    //common setting update
    Route::post('common-settings-update', [SettingController::class, 'commonSettingUpdate'])->name('common.settings.update')->middleware('isDemo');

    Route::get('email-template', [EmailTemplateController::class, 'emailTemplate'])->name('email-template');
    Route::get('email-edit', [EmailTemplateController::class, 'emailTempEdit'])->name('email-edit');
    Route::get('email-edit/{id}', [EmailTemplateController::class, 'emailTempEdit'])->name('email-edit');
    Route::post('email-temp-update/{id}', [EmailTemplateController::class, 'emailTempUpdate'])->name('email-temp-update');

    Route::group(['prefix' => 'batch', 'as' => 'batches.', 'middleware' => ['can:Manage Application Setting']], function () {
        Route::get('', [BatchController::class, 'index'])->name('index');
        Route::post('batch', [BatchController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BatchController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [BatchController::class, 'update'])->name('update');
        Route::post('delete/{id}', [BatchController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'department', 'as' => 'departments.', 'middleware' => ['can:Manage Application Setting']], function () {
        Route::get('', [DepartmentController::class, 'index'])->name('index');
        Route::post('department', [DepartmentController::class, 'store'])->name('store');
        Route::get('edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [DepartmentController::class, 'update'])->name('update');
        Route::post('delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'passing-years', 'as' => 'passing_years.', 'middleware' => ['can:Manage Application Setting']], function () {
        Route::get('', [PassingYearController::class, 'index'])->name('index');
        Route::post('passing-years', [PassingYearController::class, 'store'])->name('store');
        Route::get('edit/{id}', [PassingYearController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [PassingYearController::class, 'update'])->name('update');
        Route::post('delete/{id}', [PassingYearController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'language', 'as' => 'languages.', 'middleware' => ['can:Manage Application Setting']], function () {
        Route::get('/', [LanguageController::class, 'index'])->name('index');
        Route::post('store', [LanguageController::class, 'store'])->name('store');
        Route::get('edit/{id}/{iso_code?}', [LanguageController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [LanguageController::class, 'update'])->name('update');
        Route::get('translate/{id}', [LanguageController::class, 'translateLanguage'])->name('translate');
        Route::post('update-translate/{id}', [LanguageController::class, 'updateTranslate'])->name('update.translate');
        Route::post('delete/{id}', [LanguageController::class, 'delete'])->name('delete');
        Route::post('update-language/{id}', [LanguageController::class, 'updateLanguage'])->name('update-language');
        Route::get('translate/{id}/{iso_code?}', [LanguageController::class, 'translateLanguage'])->name('translate');
        Route::get('update-translate/{id}', [LanguageController::class, 'updateTranslate'])->name('update.translate');
        Route::post('import', [LanguageController::class, 'import'])->name('import')->middleware('isDemo');
    });
});

// News Subscription Letter email
Route::group(['prefix' => 'news-subscription-letter-email', 'as' => 'news-subscription-letter-email.', 'middleware' => ['can:Manage Newsletter']], function () {
    Route::get('/', [NewsSubscriptionLetterController::class, 'list'])->name('list');
    Route::post('store', [NewsSubscriptionLetterController::class, 'store'])->name('store');
    Route::get('edit/{id}', [NewsSubscriptionLetterController::class, 'edit'])->name('edit');
    Route::POST('update/{id}', [NewsSubscriptionLetterController::class, 'update'])->name('update');
    Route::post('delete/{id}', [NewsSubscriptionLetterController::class, 'delete'])->name('delete');
});

// Email Template Subscription
Route::group(['prefix' => 'subscription-email-template', 'as' => 'subscription-email-template.', 'middleware' => ['can:Manage Newsletter']], function () {
    Route::get('/', [SubscriptionEmailTemplateController::class, 'list'])->name('list');
    Route::post('store', [SubscriptionEmailTemplateController::class, 'store'])->name('store');
    Route::get('edit/{id}', [SubscriptionEmailTemplateController::class, 'edit'])->name('edit');
    Route::get('view/{id}', [SubscriptionEmailTemplateController::class, 'view'])->name('view');
    Route::post('update/{id}', [SubscriptionEmailTemplateController::class, 'update'])->name('update');
    Route::post('delete/{id}', [SubscriptionEmailTemplateController::class, 'delete'])->name('delete');;
    Route::post('preview-test-mail/{id}', [SubscriptionEmailTemplateController::class, 'preViewTestMail'])->name('preview-test-mail');
    Route::get('send-mail-list', [SubscriptionEmailTemplateController::class, 'sendMailList'])->name('send-mail-list');
    Route::post('send-mail', [SubscriptionEmailTemplateController::class, 'sendMail'])->name('send-mail');
    Route::post('individual-subscription-search', [SubscriptionEmailTemplateController::class, 'individualSubscriptionSearch'])->name('individual-subscription-search');
    Route::post('individual-alumni-search', [SubscriptionEmailTemplateController::class, 'individualAlumniSearch'])->name('individual-alumni-search');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('/', [ProfileController::class, 'myProfile'])->name('index');
    Route::get('change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [ProfileController::class, 'changePasswordUpdate'])->name('change-password.update')->middleware('isDemo');
    Route::post('update', [ProfileController::class, 'update'])->name('update')->middleware('isDemo');
});

//news setting
Route::group(['prefix' => 'news', 'as' => 'news.', 'middleware' => ['can:Manage News']], function () {
    Route::group(['prefix' => 'tags', 'as' => 'tags.'], function () {
        Route::get('list', [NewsTagController::class, 'index'])->name('index');
        Route::post('store', [NewsTagController::class, 'store'])->name('store');
        Route::get('info/{id}', [NewsTagController::class, 'info'])->name('info');
        Route::post('update/{id}', [NewsTagController::class, 'update'])->name('update');
        Route::post('delete/{id}', [NewsTagController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('list', [NewsCategoryController::class, 'index'])->name('index');
        Route::post('store', [NewsCategoryController::class, 'store'])->name('store');
        Route::get('info/{id}', [NewsCategoryController::class, 'info'])->name('info');
        Route::post('update/{id}', [NewsCategoryController::class, 'update'])->name('update');
        Route::post('delete/{id}', [NewsCategoryController::class, 'delete'])->name('delete');
    });

    Route::get('list', [NewsController::class, 'index'])->name('index');
    Route::post('store', [NewsController::class, 'store'])->name('store');
    Route::get('info/{id}', [NewsController::class, 'info'])->name('info');
    Route::post('update/{id}', [NewsController::class, 'update'])->name('update');
    Route::post('delete/{id}', [NewsController::class, 'delete'])->name('delete');
});

//transactions
Route::group(['prefix' => 'transactions', 'as' => 'transactions.', 'middleware' => ['can:Manage Transaction']], function () {
    Route::get('pending-list', [TransactionController::class, 'pendingTransaction'])->name('pending.list');
    Route::get('all-transactions', [TransactionController::class, 'allTransaction'])->name('all.list');
    Route::get('event-transaction', [TransactionController::class, 'eventTransaction'])->name('event.list');
    Route::get('membership-transaction', [TransactionController::class, 'membershipTransaction'])->name('membership.list');
    Route::post('change-transaction-status', [TransactionController::class, 'transactionChangeStatus'])->name('change-status');
});


//notice setting
Route::group(['prefix' => 'notices', 'as' => 'notices.', 'middleware' => ['can:Manage Notice']], function () {

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('list', [NoticeCategoryController::class, 'index'])->name('index');
        Route::post('store', [NoticeCategoryController::class, 'store'])->name('store');
        Route::get('info/{id}', [NoticeCategoryController::class, 'info'])->name('info');
        Route::post('update/{id}', [NoticeCategoryController::class, 'update'])->name('update');
        Route::post('delete/{id}', [NoticeCategoryController::class, 'delete'])->name('delete');
    });

    Route::get('list', [NoticeController::class, 'index'])->name('index');
    Route::post('store', [NoticeController::class, 'store'])->name('store');
    Route::get('info/{id}', [NoticeController::class, 'info'])->name('info');
    Route::post('update/{id}', [NoticeController::class, 'update'])->name('update');
    Route::post('delete/{id}', [NoticeController::class, 'delete'])->name('delete');
});

if (!isAddonInstalled('ALUSAAS')) {
// version update
    Route::get('version-update', [VersionUpdateController::class, 'versionFileUpdate'])->name('version-update');
    Route::post('version-update', [VersionUpdateController::class, 'versionFileUpdateStore'])->name('version-update-store');
    Route::get('version-update-execute', [VersionUpdateController::class, 'versionUpdateExecute'])->name('version-update-execute');
    Route::get('version-delete', [VersionUpdateController::class, 'versionFileUpdateDelete'])->name('version-delete');

    Route::group(['prefix' => 'addon', 'as' => 'addon.'], function () {
        Route::get('details/{code}', [AddonUpdateController::class, 'addonDetails'])->name('details')->withoutMiddleware(['addon']);
        Route::post('store', [AddonUpdateController::class, 'addonFileStore'])->name('store')->withoutMiddleware(['addon']);
        Route::post('execute', [AddonUpdateController::class, 'addonFileExecute'])->name('execute')->withoutMiddleware(['addon']);
        Route::get('delete/{code}', [AddonUpdateController::class, 'addonFileDelete'])->name('delete')->withoutMiddleware(['addon']);
    });
} else {
    //subscription
    Route::group(['prefix' => 'subscription', 'as' => 'subscription.', 'middleware' => ['can:Manage Subscription']], function () {
        Route::get('/', [SubscriptionController::class, 'index'])->name('index');
        Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('pay', [OrderController::class, 'pay'])->name('pay');
        Route::get('get-currency-by-gateway', [OrderController::class, 'getCurrencyByGateway'])->name('get.currency');
        Route::get('checkout/success', [OrderController::class, 'checkoutSuccess'])->name('checkout.success');
        Route::get('get-package', [SubscriptionController::class, 'getPackage'])->name('get.package');
        Route::post('cancel', [SubscriptionController::class, 'cancel'])->name('cancel');
        Route::get('transaction-list', [SubscriptionController::class, 'transactionList'])->name('transaction.list');
    });

    //custom domain
    Route::group(['prefix' => 'custom-domain', 'as' => 'custom_domain.', 'middleware' => ['can:Manage Custom Domain']], function () {
        Route::get('/', [CustomDomainRequestController::class, 'index'])->name('index');
        Route::post('store', [CustomDomainRequestController::class, 'store'])->name('store');
        Route::get('info/{id}', [CustomDomainRequestController::class, 'info'])->name('info');
        Route::POST('update/{id}', [CustomDomainRequestController::class, 'update'])->name('update');
    });
}

