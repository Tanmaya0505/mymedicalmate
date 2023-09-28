<?php
use App\Http\Controllers\LanguageController;
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
Route::get('server', 'ServerController@server');
Route::get('/','frontend\HomeController@home');
Route::get('login','frontend\HomeController@login');
Route::get('forgot-password','frontend\HomeController@forgotPassword');
Route::get('sign-up','frontend\HomeController@signUp');
Route::get('login-register','frontend\HomeController@loginRegister');
Route::get('medical-mate','frontend\HomeController@listingMedicalMate');
Route::post('medical-mate', 'frontend\HomeController@filterMedicalmate');
Route::get('medical-mate/{id}','frontend\HomeController@detailsMedicalMate');
Route::get('book-medical-mate/{id}','frontend\HomeController@bookMedicalMate');
Route::get('demo-page','frontend\HomeController@demoPage');
Route::get('upload-prescription','frontend\HomeController@uploadPrescription')->middleware('CheckCustomerLogin');
Route::post('upload-prescription','frontend\HomeController@submitUploadPrescription')->middleware('CheckCustomerLogin');
Route::get('listing-doctor','frontend\HomeController@listingDoctor');
Route::get('details-doctors','frontend\HomeController@detailsDoctors');
Route::get('profile-doctor','frontend\HomeController@profileDoctor');
Route::get('consult-doctor','frontend\HomeController@consultDoctor');

Route::post('/sign-up', 'frontend\HomeController@signupUser');
Route::get('email-verify/{email}/{token}', 'frontend\HomeController@emailVerify');
Route::post('/login', 'frontend\LoginController@login');
Route::get('/user-type', 'frontend\LoginController@userType');
Route::post('confirm-account', 'frontend\LoginController@confirmAccount');
Route::get('logout', 'frontend\HomeController@logoout');

Route::post('check-availability-assistant', 'frontend\AssistantAjaxController@checkAvailabilityAssistant');
Route::post('booking-summery', 'frontend\AssistantAjaxController@bookingSummery');
Route::post('assistant-booking-otp', 'frontend\AssistantAjaxController@assistantBookingOtp');
Route::post('book-assistant', 'frontend\AssistantAjaxController@bookAssistant');
Route::post('update-transaction', 'frontend\AssistantAjaxController@updateTransaction');
Route::get('booking-success/{bookingId}', 'frontend\AssistantAjaxController@bookingSuccess');

//Pages
Route::get('about', 'frontend\PageController@about');
Route::get('terms', 'frontend\PageController@terms');
Route::get('privacy-policy', 'frontend\PageController@privacyPolicy');
Route::get('return-policy','frontend\PageController@returnPolicy');
Route::get('disclaimer','frontend\PageController@disclaimer');
Route::get('contact','frontend\PageController@contact');

//Ajax
Route::post('search-districts', 'frontend\AjaxController@searchDistricts');
Route::post('submit-suggetion', 'frontend\AjaxController@submitSuggetion');
//CronJon
Route::get('auto-forward-request', 'cronjob\ForwardCronJobController@autoForwardRequest');
Route::get('auto-cancel-request', 'cronjob\ForwardCronJobController@autoCancelRequest');
//User Dashboard routes
Route::group(['prefix' => 'user', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\UserController@myaccount');
    Route::get('my-profile','frontend\UserController@userProfile');
    Route::post('user-profile','frontend\UserController@updateUserProfile');
    Route::get('bookings','frontend\UserController@bookings');
    Route::get('bookings/{bookingId}','frontend\UserController@bookingsDetails');
    Route::post('booking-info','frontend\UserController@bookingInfo');
    Route::post('cancel-booking','frontend\UserController@cancelBooking');
    Route::post('booking-complete','frontend\UserController@bookingComplete');
    Route::post('add-review','frontend\UserController@addReview');
    
    Route::get('prescription','frontend\UserController@prescription');
    Route::get('prescription/{prescriptionId}','frontend\UserController@prescriptionDetails');

    Route::get('bookings1','frontend\UserController@bookingsOne');
    Route::get('bookings2','frontend\UserController@bookingsTwo');
});
//Assistant Dashboard routes
Route::group(['prefix' => 'assistant', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\AssistantController@myaccount');
    Route::get('my-profile','frontend\AssistantController@userProfile');
    Route::post('user-profile','frontend\AssistantController@updateUserProfile');
    Route::post('online-status','frontend\AssistantController@onlineStatus');
    Route::get('bookings','frontend\AssistantController@bookings');
    Route::get('bookings/{bookingId}','frontend\AssistantController@bookingsDetails');
    Route::post('accept-booking','frontend\AssistantController@acceptBooking');
    Route::post('forward-booking','frontend\AssistantController@forwardBooking');
    Route::post('on-busy','frontend\AssistantController@onBusy');
});
//Doctor Dashboard routes
Route::group(['prefix' => 'doctor', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\DoctorController@myaccount');
    Route::get('my-profile','frontend\DoctorController@userProfile');
    Route::post('user-profile','frontend\DoctorController@updateUserProfile');
});
//Vendor Dashboard routes
Route::group(['prefix' => 'vendor', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\VendorController@myaccount');
    Route::get('my-profile','frontend\VendorController@userProfile');
    Route::post('user-profile','frontend\VendorController@updateUserProfile');
    
    //Prescription
    Route::get('prescription','frontend\VendorController@prescription');
    Route::get('prescription/{prescriptionId}','frontend\VendorController@prescriptionDetails');
    Route::get('create-invoice/{orderId}', 'frontend\VendorController@createInvoice');
});

Route::prefix('cms-admin')->group(function() {
    // dashboard Routes
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    // dashboard Routes
    Route::get('/','AuthenticationController@loginPage');
    Route::get('/dashboard','DashboardController@dashboard');
    Route::get('/account-settings','PageController@accountSettingPage');
    Route::post('/update-general-info','PageController@updateGeneralInfo');
    Route::post('/change-password', 'PageController@changePassword');
    Route::post('/update-user-config', 'PageController@updateUserConfig');
    Route::post('/update-assistant-config', 'PageController@updateAssistantConfig');
    Route::post('/update-doctor-config', 'PageController@updateDoctorConfig');
    Route::post('/update-admin-config', 'PageController@updateAdminConfig');
    Route::post('/update-vendor-config', 'PageController@updateVendorConfig');
    
    //Route::get('/','DashboardController@dashboardEcommerce');
    Route::get('/dashboard-ecommerce','DashboardController@dashboardEcommerce');
    Route::get('/dashboard-analytics','DashboardController@dashboardAnalytics');
    Route::get('/customer-listing','CustomerController@customerListing');
    Route::get('/customer-listing/{id}/view','CustomerController@customerView');
    Route::post('/customer-listing','CustomerController@updateCustomer');
    
    //Booking
    Route::get('bookings','BookingController@bookings');
    Route::get('bookings/{bookingId}','BookingController@bookingDetails');
    Route::post('find-service-area','BookingController@findServiceArea');
    Route::post('find-assistant','BookingController@findAssistant');
    Route::post('assign-assistant','BookingController@assignAssistant');
    Route::post('cancel-booking','BookingController@cancelBooking');
    
    //Prescription
    Route::get('prescription','PrescriptionController@prescription');
    Route::get('prescription/{prescriptionId}','PrescriptionController@prescriptionDetails');
    Route::post('find-vendor','PrescriptionController@findVendor');
    Route::post('assign-vendor', 'PrescriptionController@assignVendor');
    
    //Suggetions
    Route::get('suggetions','SuggetionsController@suggetions');
    
    //Application Routes
    Route::get('/app-email','ApplicationController@emailApplication');
    Route::get('/app-chat','ApplicationController@chatApplication');
    Route::get('/app-todo','ApplicationController@todoApplication');
    Route::get('/app-calendar','ApplicationController@calendarApplication');
    Route::get('/app-kanban','ApplicationController@kanbanApplication');
    Route::get('/app-invoice-view','ApplicationController@invoiceApplication');
    Route::get('/app-invoice-list','ApplicationController@invoiceListApplication');
    Route::get('/app-invoice-edit','ApplicationController@invoiceEditApplication');
    Route::get('/app-invoice-add','ApplicationController@invoiceAddApplication');
    Route::get('/app-file-manager','ApplicationController@fileManagerApplication');

    // Content Page Routes
    Route::get('/content-grid','ContentController@gridContent');
    Route::get('/content-typography','ContentController@typographyContent');
    Route::get('/content-text-utilities','ContentController@textUtilitiesContent');
    Route::get('/content-syntax-highlighter','ContentController@contentSyntaxHighlighter');
    Route::get('/content-helper-classes','ContentController@contentHelperClasses');
    Route::get('/colors','ContentController@colorContent');
    // icons
    Route::get('/icons-livicons','IconsController@liveIcons');
    Route::get('/icons-boxicons','IconsController@boxIcons');
    // card
    Route::get('/card-basic','CardController@basicCard');
    Route::get('/card-actions','CardController@actionCard');
    Route::get('/widgets','CardController@widgets');
    // component route
    Route::get('/component-alerts','ComponentController@alertComponenet');
    Route::get('/component-buttons-basic','ComponentController@buttonComponenet');
    Route::get('/component-breadcrumbs','ComponentController@breadcrumbsComponenet');
    Route::get('/component-carousel','ComponentController@carouselComponenet');
    Route::get('/component-collapse','ComponentController@collapseComponenet');
    Route::get('/component-dropdowns','ComponentController@dropdownComponenet');
    Route::get('/component-list-group','ComponentController@listGroupComponenet');
    Route::get('/component-modals','ComponentController@modalComponenet');
    Route::get('/component-pagination','ComponentController@paginationComponenet');
    Route::get('/component-navbar','ComponentController@navbarComponenet');
    Route::get('/component-tabs-component','ComponentController@tabsComponenet');
    Route::get('/component-pills-component','ComponentController@pillComponenet');
    Route::get('/component-tooltips','ComponentController@tooltipsComponenet');
    Route::get('/component-popovers','ComponentController@popoversComponenet');
    Route::get('/component-badges','ComponentController@badgesComponenet');
    Route::get('/component-pill-badges','ComponentController@pillBadgesComponenet');
    Route::get('/component-progress','ComponentController@progressComponenet');
    Route::get('/component-media-objects','ComponentController@mediaObjectComponenet');
    Route::get('/component-spinner','ComponentController@spinnerComponenet');
    Route::get('/component-bs-toast','ComponentController@toastsComponenet');
    // extra component
    Route::get('/ex-component-avatar','ExComponentController@avatarComponent');
    Route::get('/ex-component-chips','ExComponentController@chipsComponent');
    Route::get('/ex-component-divider','ExComponentController@dividerComponent');
    // form elements
    Route::get('/form-inputs','FormController@inputForm');
    Route::get('/form-input-groups','FormController@inputGroupForm');
    Route::get('/form-number-input','FormController@numberInputForm');
    Route::get('/form-select','FormController@selectForm');
    Route::get('/form-radio','FormController@radioForm');
    Route::get('/form-checkbox','FormController@checkboxForm');
    Route::get('/form-switch','FormController@switchForm');
    Route::get('/form-textarea','FormController@textareaForm');
    Route::get('/form-quill-editor','FormController@quillEditorForm');
    Route::get('/form-file-uploader','FormController@fileUploaderForm');
    Route::get('/form-date-time-picker','FormController@datePickerForm');
    Route::get('/form-layout','FormController@formLayout');
    Route::get('/form-wizard','FormController@formWizard');
    Route::get('/form-validation','FormController@formValidation');
    Route::get('/form-repeater','FormController@formRepeater');
    // table route
    Route::get('/table','TableController@basicTable');
    Route::get('/extended','TableController@extendedTable');
    // page Route
    Route::get('/page-user-profile','PageController@userProfilePage');
    Route::get('/page-faq','PageController@faqPage');
    Route::get('/page-knowledge-base','PageController@knowledgeBasePage');
    Route::get('/page-knowledge-base/categories','PageController@knowledgeCatPage');
    Route::get('/page-knowledge-base/categories/question','PageController@knowledgeQuestionPage');
    Route::get('/page-search','PageController@searchPage');
    Route::get('/page-account-settings','PageController@accountSettingPage');
    // User Route
    Route::get('/page-users-list','UsersController@listUser');
    Route::get('/page-users-view','UsersController@viewUser');
    Route::get('/page-users-edit','UsersController@editUser');
    // Authentication  Route
    Route::get('/auth-login','AuthenticationController@loginPage');
    Route::get('/auth-register','AuthenticationController@registerPage');
    Route::get('/auth-forgot-password','AuthenticationController@forgetPasswordPage');
    Route::get('/auth-reset-password','AuthenticationController@resetPasswordPage');
    Route::get('/auth-lock-screen','AuthenticationController@authLockPage');
    // Miscellaneous
    Route::get('/page-coming-soon','MiscellaneousController@comingSoonPage');
    Route::get('/error-404','MiscellaneousController@error404Page');
    Route::get('/error-500','MiscellaneousController@error500Page');
    Route::get('/page-not-authorized','MiscellaneousController@notAuthPage');
    Route::get('/page-maintenance','MiscellaneousController@maintenancePage');
    // Charts Route
    Route::get('/chart-apex','ChartController@apexChart');
    Route::get('/chart-chartjs','ChartController@chartJs');
    Route::get('/chart-chartist','ChartController@chartist');
    Route::get('/maps-google','ChartController@googleMap');
    // extension route
    Route::get('/ext-component-sweet-alerts','ExtensionsController@sweetAlert');
    Route::get('/ext-component-toastr','ExtensionsController@toastr');
    Route::get('/ext-component-noui-slider','ExtensionsController@noUiSlider');
    Route::get('/ext-component-drag-drop','ExtensionsController@dragComponent');
    Route::get('/ext-component-tour','ExtensionsController@tourComponent');
    Route::get('/ext-component-swiper','ExtensionsController@swiperComponent');
    Route::get('/ext-component-treeview','ExtensionsController@treeviewComponent');
    Route::get('/ext-component-block-ui','ExtensionsController@blockUIComponent');
    Route::get('/ext-component-media-player','ExtensionsController@mediaComponent');
    Route::get('/ext-component-miscellaneous','ExtensionsController@miscellaneous');
    Route::get('/ext-component-i18n','ExtensionsController@i18n');
    // locale Route
    Route::get('lang/{locale}',[LanguageController::class,'swap']);

    // acess controller
    Route::get('/access-control', 'AccessController@index');
    Route::get('/access-control/{roles}', 'AccessController@roles');
    Route::get('/ecommerce', 'AccessController@home')->middleware('role:Admin');

    Auth::routes();

});
