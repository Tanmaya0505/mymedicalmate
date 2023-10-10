<?php
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReferalManagementController;
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

Route::get('download', function () {
   $url = 'https://www.te.com/commerce/DocumentDelivery/DDEController?Action=srchrtrv&DocNm=5223955&DocType=Customer+Drawing&DocLang=English';

   // Create a stream
   $opts = [
       "http" => [
           "method" => "GET",
           "header" => "Host: www.te.com\r\n"
               . "User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:71.0) Gecko/20100101 Firefox/71.0\r\n"
               . "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n"
               . "Accept-Language: en-US,en;q=0.5\r\n"
               . "Accept-Encoding: gzip, deflate, br\r\n"
       ],
   ];

   $context = stream_context_create($opts);
   $data = file_get_contents($url, false, $context);

   \Storage::disk('public')->put('filename.pdf', $data);

   return 'OK';
});
// Clear route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return 'Routes cache cleared';
});

// Clear config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});

Route::get('server', 'ServerController@server');
Route::get('/','frontend\HomeController@home');
Route::get('login','frontend\HomeController@login');
Route::get('forgot-password','frontend\HomeController@forgotPassword');
Route::get('sign-up','frontend\HomeController@signUp');
Route::get('login-register','frontend\HomeController@loginRegister');
Route::get('medical-mate','frontend\HomeController@listingMedicalMate');
Route::post('medical-mate', 'frontend\HomeController@filterMedicalmate');
Route::get('medical-mate/{id}','frontend\HomeController@detailsMedicalMate');
Route::get('book-medical-mate/{type}/{id}','frontend\HomeController@bookMedicalMate');
Route::get('demo-page','frontend\HomeController@demoPage');
Route::get('upload-prescription','frontend\HomeController@uploadPrescription')->middleware('CheckCustomerLogin');
Route::post('upload-prescription','frontend\HomeController@submitUploadPrescription')->middleware('CheckCustomerLogin');

Route::get('invoice-order-download/{id}','PDFController@index');
Route::get('direct-booking/serial','frontend\BookingController@bookMedicalMateSerial');



Route::get('direct-booking/full-service','frontend\BookingController@bookMedicalMateFullService');
Route::post('medihelp/book-assistant-serial', 'frontend\BookingController@bookAssistant');
Route::get('direct-booking/search-medmate/{id}','frontend\BookingController@bookMedicalMateSearchMedmate');
Route::get('direct-booking/step-1/{id}','frontend\BookingController@bookingSummeryDirectstepTwo');
Route::get('direct-booking/step-2/{id}','frontend\BookingController@bookingSummeryDirectstepTwo');
Route::get('direct-booking/step-3/{id}','frontend\BookingController@bookingSummeryDirectstepThree');


//
Route::get('search-vendor/{prescriptionId}','frontend\UserController@prescriptionSearch');
Route::post('medmate-send-request/{prescriptionId}','frontend\UserController@prescriptionSend');
Route::get('patient-details','frontend\UserController@patientDetails');

//    
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

Route::post('sendotp', 'frontend\HomeController@sendOtp');
Route::post('verifyotp', 'frontend\HomeController@verifyOtp');

Route::post('medihelp/check-availability-assistant', 'frontend\AssistantAjaxController@checkAvailabilityAssistant');
Route::post('medihelp/booking-summery-direct', 'frontend\BookingController@bookingSummeryDirect');
Route::post('medihelp/booking-summery', 'frontend\AssistantAjaxController@bookingSummery');
Route::post('medihelp/assistant-booking-otp', 'frontend\AssistantAjaxController@assistantBookingOtp');
Route::post('medihelp/book-assistant', 'frontend\AssistantAjaxController@bookAssistant');
Route::post('medihelp/update-transaction', 'frontend\AssistantAjaxController@updateTransaction');
Route::get('medihelp/booking-success/{bookingId}', 'frontend\AssistantAjaxController@bookingSuccess');

Route::get('doctor/list','frontend\HomeController@Doctorlist');
Route::get('hospital/list','frontend\HomeController@Hospitallist');
Route::get('nurses/list','frontend\HomeController@Nurseslist');
Route::get('clinics/list','frontend\HomeController@Clinicslist');
Route::get('pharmas/list','frontend\HomeController@Pharmaslist');
Route::get('exams/list','frontend\HomeController@Examslist');
Route::get('diseases/list','frontend\HomeController@Diseaseslist');
Route::get('doctor/detail/{name}','frontend\HomeController@DoctorDetail');
Route::get('hospital/detail/{name}','frontend\HomeController@HospitalDetail');
Route::get('nurses/detail/{name}','frontend\HomeController@NursesDetail');
Route::get('clinics/detail/{name}','frontend\HomeController@ClinicsDetail');
Route::get('pharmas/detail/{name}','frontend\HomeController@PharmasDetail');
Route::get('exams/detail/{name}','frontend\HomeController@ExamsDetail');
Route::get('diseases/detail/{name}','frontend\HomeController@DiseasesDetail');
Route::get('achievement/{type}/{name}','frontend\HomeController@AchievementDetail');
Route::get('video/list','frontend\HomeController@Videolist');
//comment
Route::post('detail/comments','frontend\HomeController@Comments');
//rating
Route::post('doctor/detail/rating','frontend\RatingController@store');
Route::post('doctor/detail/questionanswarUpdate','frontend\HomeController@QuestionAnswarUpdate');
Route::post('doctor/detail/doctorVeryfiyOtp','frontend\HomeController@doctorVeryfiyOtp');

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
//Route::get('auto-cancel-request', 'cronjob\ForwardCronJobController@autoCancelRequest');
Route::get('auto-cancel-request', 'cronjob\BookingTimeOutController@BookingTimeOut');
Route::get('auto-cancel-afterbookingdate', 'cronjob\BookingTimeOutController@BookingAfterDate');
Route::get('auto-reminder-vendor-settlement', 'cronjob\BookingTimeOutController@SendReminderToVendor');

// payment url

// payment
Route::get('booking/serial/payment/{id}','frontend\BookingController@bookMedicalMateSerialPayment');
Route::any('booking/serial/payment-callback/{id}','frontend\BookingController@bookMedicalMateSerialPaymentCallback');



Route::any('razorpay', 'PaymentController@razorpay')->name('razorpay');
Route::post('razorpaypayment', 'PaymentController@payment')->name('payment');

Route::get('paymentdueadmin', 'PaymentController@paymentdueadmin');
Route::any('afterpaymentdueadmin', 'PaymentController@afterpaymentdueadmin');


//User Dashboard routes
Route::group(['prefix' => 'user', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\UserController@myaccount');
    Route::get('my-profile','frontend\UserController@userProfile');
    Route::post('user-profile','frontend\UserController@updateUserProfile');
    Route::get('bookings','frontend\UserController@bookings');
    Route::get('bookings/{bookingId}','frontend\UserController@bookingsDetails');
    Route::post('booking-info','frontend\UserController@bookingInfo');
    Route::post('cancel-booking','frontend\UserController@cancelBooking');
    Route::post('cancel-prescription','frontend\UserController@cancelPrescription');
    Route::post('verify-booking-complete','frontend\UserController@verifybookingComplete');
    Route::post('booking-complete','frontend\UserController@bookingComplete');
    Route::post('add-review','frontend\UserController@addReview');
    
    Route::get('prescription','frontend\UserController@prescription');
    Route::get('prescription/{prescriptionId}','frontend\UserController@prescriptionDetails');
    Route::get('medmate-bookings-listing/{bookingId}','frontend\BookingController@medmatelist');
    Route::post('user-send-request/{prescriptionId}','frontend\BookingController@prescriptionSend');
    Route::post('confirm-message-booking','frontend\AssistantController@ConfirmMessageBooking');

    Route::get('notifications','NotificationController@usernotification');
    Route::get('coin-transfer','frontend\UserController@Cointransfer');
    Route::any('convert-coin-transfer','frontend\UserController@AddCointransfer');
    Route::any('mycoupons','frontend\UserController@mycoupons');
    Route::any('myreferals','frontend\UserController@myreferals');

    //upload prescription
    Route::get('uploadprescription/{prescriptionId}','frontend\UserController@uploadprescriptionDetails');

    Route::get('download-invoice/{orderId}', 'frontend\UserController@downloadInvoice');
    Route::get('download-uploadprescription-invoice/{orderId}', 'frontend\UserController@downloadInvoice');
    Route::get('payment/{orderId}', 'frontend\UserController@payment');
    Route::get('order-payment/{orderId}', 'frontend\UserController@bookingpayment');


    Route::get('add-ads','frontend\UserController@addalltypeads');
    Route::post('postall_ads','frontend\UserController@postalltypeads');

    Route::get('bookings1','frontend\UserController@bookingsOne');
    Route::get('bookings2','frontend\UserController@bookingsTwo');
    Route::post('startservice-booking','frontend\AssistantController@startServiceBooking');
    Route::post('poststartservice-booking','frontend\AssistantController@otpVerifyBooking');
    Route::any('payment-prescription','frontend\AssistantController@paymentPrescription');
    Route::any('status-change/{status}/{vendorId}/{orderId}','frontend\AssistantController@statusChange');
});
//Assistant Dashboard routes
Route::group(['prefix' => 'assistant', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\AssistantController@myaccount');
    Route::get('my-profile','frontend\AssistantController@userProfile');
    Route::post('add-referance','frontend\AssistantController@addReferance');
    Route::get('remove-referance/{id}','frontend\AssistantController@removeReferance');
    Route::post('user-profile','frontend\AssistantController@updateUserProfile');
    Route::post('online-status','frontend\AssistantController@onlineStatus');
    Route::get('bookings','frontend\AssistantController@bookings');
    Route::get('bookings/{bookingId}','frontend\AssistantController@bookingsDetails');
    Route::post('accept-booking','frontend\AssistantController@acceptBooking');
    Route::post('accept-request-booking','frontend\BookingController@acceptRequestBooking');
    Route::post('decline-request-booking','frontend\BookingController@declineRequestBooking');
    Route::post('forward-booking','frontend\AssistantController@forwardBooking');
    Route::post('on-busy','frontend\AssistantController@onBusy');
    Route::get('upload-prescription/{id?}','frontend\UserController@Uploadprescription');
    Route::post('upload-prescription','frontend\UserController@submitUploadPrescription');
    Route::get('prescription','frontend\UserController@prescription');
    Route::get('prescription/{prescriptionId}','frontend\AssistantController@prescriptionDetails');
    Route::get('booking-request','frontend\BookingController@bookingRequest');
    Route::get('medmate-search/{prescriptionId}','frontend\UserController@prescriptionSearch');
    Route::post('medmate-send-request/{prescriptionId}','frontend\UserController@prescriptionSend');
    Route::get('new-booking','frontend\UserController@newBooking');
    Route::post('postnew-booking','frontend\UserController@postnewBooking');
    Route::post('startservice-booking','frontend\AssistantController@startServiceBooking');
    Route::post('poststartservice-booking','frontend\AssistantController@otpVerifyBooking');
    Route::post('extend-time-booking','frontend\AssistantController@extendTimeBooking');
    Route::get('commision','frontend\AssistantController@commision');
    Route::get('coupon','frontend\AssistantController@coupon');
    Route::post('payment-request-admin','frontend\AssistantController@PaymentRequestAdmin');
    Route::get('serial-payment','frontend\AssistantController@serialBooking');
    Route::get('fullbook-payment','frontend\AssistantController@fullBooking');

    Route::get('notifications','NotificationController@assistantnotification');
    

    Route::post('verify-booking-complete','frontend\UserController@verifybookingComplete');
    Route::post('booking-complete','frontend\UserController@bookingComplete');
    Route::post('service-complete','frontend\UserController@serviceComplete');
    Route::get('delivery-booking/{orderId}','frontend\AssistantController@deliveryBooking');
    Route::get('booking-success/{bookingId}', 'frontend\AssistantController@bookingSuccess');
    Route::post('add-review','frontend\AssistantController@addReview');
    Route::post('cancel-booking','frontend\AssistantController@cancelBooking');
    Route::any('status-change/{status}/{vendorId}/{orderId}','frontend\AssistantController@statusChange');
    Route::get('create-invoice/{orderId}', 'frontend\AssistantController@createInvoice');
    Route::get('download-invoice/{orderId}', 'frontend\AssistantController@downloadInvoice');
    Route::post('cancel-prescription','frontend\AssistantController@cancelPrescription');
    Route::any('payment-prescription','frontend\AssistantController@paymentPrescription');
});
//Doctor Dashboard routes
Route::group(['prefix' => 'doctor', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\DoctorController@myaccount');
    Route::get('my-profile','frontend\DoctorController@userProfile');
    Route::post('user-profile','frontend\DoctorController@updateUserProfile');
    Route::get('notifications','NotificationController@doctornotification');
});
//Vendor Dashboard routes
Route::group(['prefix' => 'vendor', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\VendorController@myaccount');
    Route::get('my-profile','frontend\VendorController@userProfile');
    Route::post('user-profile','frontend\VendorController@updateUserProfile');

    Route::get('notifications','NotificationController@vendornotification');
    //coupon
    Route::get('coupon','frontend\VendorController@coupon');
    //Prescription
    Route::get('prescription','frontend\VendorController@prescription');
    Route::get('prescription/{prescriptionId}','frontend\VendorController@prescriptionDetails');
    Route::get('create-invoice/{orderId}', 'frontend\VendorController@createInvoice');
    Route::get('download-invoice/{orderId}', 'frontend\VendorController@downloadInvoice');
    Route::post('add-medicine', 'frontend\VendorController@AddMedicine');
    Route::get('delete-medicine/{id}', 'frontend\VendorController@DeleteMedicine');
    Route::post('update-medicine/{id}', 'frontend\VendorController@UpdateMedicine');
    Route::any('status-change/{status}/{vendorId}/{orderId}','frontend\VendorController@statusChange');
    Route::get('send-invoice/{status}/{orderId}','frontend\VendorController@statusChangePrescription');
    Route::get('deliveryboy-search/{prescriptionId}','frontend\VendorController@deliveryboySearch');
    Route::post('deliveryboy-send-request/{prescriptionId}','frontend\VendorController@deliveryboyrequestSend');
});
//Deliveryboy Dashboard routes
Route::group(['prefix' => 'delivery-boy', 'middleware' => 'CheckCustomerLogin'], function() {
    Route::get('dashboard','frontend\DeliveryboyController@myaccount');
    Route::get('my-profile','frontend\DeliveryboyController@userProfile');
    Route::post('user-profile','frontend\DeliveryboyController@updateUserProfile');
    Route::get('delivery-booking/{orderId}','frontend\DeliveryboyController@deliveryBooking');

    Route::get('notifications','NotificationController@deliveryboynotification');

    Route::get('bookings','frontend\DeliveryboyController@bookings');
    Route::get('bookings/{bookingId}','frontend\DeliveryboyController@bookingsDetails');
    Route::post('accept-booking','frontend\DeliveryboyController@acceptBooking');
    
    
    
    Route::post('accept-request-booking','frontend\DeliveryboyController@acceptRequestBooking');
    Route::post('decline-request-booking','frontend\DeliveryboyController@declineRequestBooking');
    Route::post('forward-booking','frontend\DeliveryboyController@forwardBooking');
    Route::post('on-busy','frontend\DeliveryboyController@onBusy');

    Route::get('commision','frontend\DeliveryboyController@commision');
    Route::post('payment-request-admin','frontend\DeliveryboyController@PaymentRequestAdmin');
    
});
//prefix('cms-admin')->
Route::group(['prefix' => 'cms-admin'],function() {

    Route::group(['middleware' => ['RolePermission','auth']],function() {

        Route::get('/referal-management', 'ReferalManagementController@index');
        Route::get('/commision-management', 'ReferalManagementController@CommisionManagement');
        Route::get('/get-userlist', 'CustomerController@getUserList');
        
        Route::get('/account-settings','PageController@accountSettingPage');
        Route::post('/update-general-info','PageController@updateGeneralInfo');
        Route::post('/change-password', 'PageController@changePassword');
        Route::post('/update-user-config', 'PageController@updateUserConfig');
        Route::post('/update-assistant-config', 'PageController@updateAssistantConfig');
        Route::post('/update-doctor-config', 'PageController@updateDoctorConfig');
        Route::post('/update-admin-config', 'PageController@updateAdminConfig');
        Route::post('/update-vendor-config', 'PageController@updateVendorConfig');
        Route::post('add-referance','frontend\AssistantController@addReferance');
    
        //Route::get('/','DashboardController@dashboardEcommerce');
        Route::get('/dashboard-ecommerce','DashboardController@dashboardEcommerce');
        Route::get('/dashboard-analytics','DashboardController@dashboardAnalytics');
        Route::get('/customer-listing','CustomerController@customerListing');
        Route::get('/customer-listing/{id}/view','CustomerController@customerView');
        Route::post('/customer-listing','CustomerController@updateCustomer');
        Route::get('/customer-listing/{type}','CustomerController@customerListingType');
        
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

        //All type users
        Route::any('alltype-user/{type}','AlltypeuserController@alltypeusers');
        Route::get('alltype-user/{type}/add','AlltypeuserController@addalltypeusers');
        Route::post('postalltype-user/{type}','AlltypeuserController@postalltypeusers');
        Route::post('/alltype-user/{type}/doctorVeryfiyOtp','AlltypeuserController@doctorVeryfiyOtp');
        Route::post('/alltype-user/{type}/DoctorSubmitOtp','AlltypeuserController@DoctorSubmitOtp');
        Route::post('/alltype-user/alltypeuserlog/{type}','AlltypeuserController@alltypeuserlog');
        Route::get('/alltype-user/{type}/{id}','AlltypeuserController@AdminDoctorview');

        Route::get('alltype-ads','AlltypeuserController@alltypeads');
        Route::get('alltype-ads/{id}','AlltypeuserController@alltypeadstatus');
        //Route::post('postall_ads','AlltypeuserController@postalltypeads');
        Route::get('alltype-user/{type}/edit/{id}','AlltypeuserController@editalltypeusers');
        Route::get('alltype-user/{type}/delete/{id}','AlltypeuserController@deletealltypeusers');
        Route::get('alltype-user/diseaseslist/{id}','AlltypeuserController@deletealltypeusersdiseases');
        
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

        Route::get('/sub-admin', 'SubadminController@index');
        Route::get('/sub-admin/add', 'SubadminController@add');
        Route::any('/sub-admin/store', 'SubadminController@store');
        Route::get('/sub-admin/edit/{id}', 'SubadminController@edit');
        Route::get('/sub-admin/delete/{id}', 'SubadminController@delete');


        // acess controller
        Route::get('/access-control', 'AccessController@index');
        Route::get('/access-control/{roles}', 'AccessController@roles');
        Route::get('/ecommerce', 'AccessController@home')->middleware('role:Admin');

        Route::get('/roles', 'AccessController@rolelists');
        Route::get('/permissions', 'AccessController@permissionlists');
        Route::get('/role-permissions', 'AccessController@RolesPermissions');
        Route::get('/rolepermission-selected/{id}', 'AccessController@RolesPermissionsSelected');
        Route::post('/role-permissions-store', 'AccessController@RolesPermissionsSetup');
        Route::get('/staff-workingtime', 'AccessController@staffWorkingTime');
        Route::get('/staff-workingtime/{id}', 'AccessController@staffWorkingTimeView');
        Route::get('/bonus-list', 'BonusController@index');
        Route::any('/add-bonus', 'BonusController@store');
        Route::get('/coupon-list', 'CouponController@index');
        Route::get('/add-coupon', 'CouponController@add');
        Route::post('/coupon-list/store', 'CouponController@store');
        Route::post('/coupon-list/couponcodegen', 'CouponController@couponcodegen');
        Route::get('/coupon-list/edit/{id}', 'CouponController@edit');
        Route::get('/coupon-list/delete/{id}', 'CouponController@delete');
        //questionanswat
        Route::get('/question-answar','QuestionAnswarController@index');
        Route::get('/question-answar/edit/{id}','QuestionAnswarController@edit');
        Route::get('add-question-answar','QuestionAnswarController@show');
        Route::post('/question-answar/store', 'QuestionAnswarController@store');
        Route::get('/question-answar/delete/{id}','QuestionAnswarController@destroy');
        
    });

    Auth::routes();
    // dashboard Routes
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    // dashboard Routes
    Route::get('/','AuthenticationController@loginPage');
    Route::get('/dashboard','DashboardController@dashboard');

});
