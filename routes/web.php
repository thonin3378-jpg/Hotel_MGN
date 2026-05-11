<?php

// use App\Http\Controllers\BackEnd\ClientBooking\bookingDetailController;
// use App\Http\Controllers\BackEnd\ClientBooking\bookingListController;
// use App\Http\Controllers\BackEnd\ClientBooking\updateBookingController;

use App\Http\Controllers\BackEnd\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\BackEnd\customerController;
// use App\Http\Controllers\BackEnd\Customers\addCustomerController;
// use App\Http\Controllers\BackEnd\Customers\listCustomerController;
// use App\Http\Controllers\BackEnd\Customers\updateCustomerController;
// use App\Http\Controllers\BackEnd\Stuffs\addStuffController;
use App\Http\Controllers\BackEnd\dashBoardController;
use App\Http\Controllers\BackEnd\foodCategoryController;
use App\Http\Controllers\BackEnd\foodController;
use App\Http\Controllers\BackEnd\hotelController;
use App\Http\Controllers\BackEnd\hotelImageController;
use App\Http\Controllers\BackEnd\RomeTypeController;
use App\Http\Controllers\BackEnd\RoomBackEndController;
use App\Http\Controllers\BackEnd\roomImageController;
use App\Http\Controllers\BackEnd\roomTypeController;
// use App\Http\Controllers\BackEnd\Hotels\addHotelController;
// use App\Http\Controllers\BackEnd\Hotels\listHotelController;
// use App\Http\Controllers\BackEnd\Hotels\updateHotelController;
// use App\Http\Controllers\BackEnd\Rooms\addRoomController;
// use App\Http\Controllers\BackEnd\Rooms\listRoomController;
// use App\Http\Controllers\BackEnd\Rooms\updateRoomController;
use App\Http\Controllers\BackEnd\serviceBackendController;
// use App\Http\Controllers\BackEnd\serviceController as BackEndServiceController;
// use App\Http\Controllers\BackEnd\Services\addServiceController;
// use App\Http\Controllers\BackEnd\Services\listServiceController;
// use App\Http\Controllers\BackEnd\Services\updateServiceController;
use App\Http\Controllers\BackEnd\staffsController;
// use App\Http\Controllers\BackEnd\Stuffs\editStuffController;
// use App\Http\Controllers\BackEnd\Stuffs\listfController;
// use App\Http\Controllers\BackEnd\Stuffs\updateStuffController;
use App\Http\Controllers\BackEnd\userController;
// use App\Http\Controllers\BackEnd\Users\addUserController;
// use App\Http\Controllers\BackEnd\Users\editUserController;
// use App\Http\Controllers\BackEnd\Users\updateUserController;
// use App\Http\Controllers\BackEnd\Users\viewUserController;
use App\Http\Controllers\FrontEnd\AboutController;
use App\Http\Controllers\FrontEnd\Auth\AuthController;
use App\Http\Controllers\FrontEnd\bookingController;
use App\Http\Controllers\FrontEnd\bookingInformationController;
use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\PageBookingController;
use App\Http\Controllers\FrontEnd\PageOurTeamController;
use App\Http\Controllers\FrontEnd\PageTestimonialController;
use App\Http\Controllers\FrontEnd\PaymentMethonController;
use App\Http\Controllers\FrontEnd\recieptController;
use App\Http\Controllers\FrontEnd\RoomsController;
use App\Http\Controllers\FrontEnd\ServiceController;
use App\Http\Controllers\FrontEnd\Auth\AuthController as FrontAuthController;
use App\Http\Controllers\BackEnd\Auth\AuthController as BackAuthController;
use App\Http\Controllers\BackEnd\bookingListController;
use Illuminate\Support\Facades\Route;


// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=[Start FrontEnd]=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

Route::middleware('guest')->group(function () {

    Route::get('FrontendLogin', [FrontAuthController::class, 'FrontendLogin'])->name('FrontendLogin');
    Route::post('FrontendLogin', [FrontAuthController::class, 'FrontendLoginAction'])->name('FrontendLoginAction.action');

    Route::get('Frontendlogout', [FrontAuthController::class, 'Frontendlogout'])->name('Frontendlogout');

    Route::get('Frontendregister', [FrontAuthController::class, 'Frontendregister'])->name('Frontendregister');
    Route::post('Frontendregister', [FrontAuthController::class, 'FrontendregisterSave'])->name('Frontendregister.save');

});

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/about',[AboutController::class,'index'])->name('about.index');
Route::get('/service',[ServiceController::class,'index'])->name('service.index');
Route::get('/roomss',[RoomsController::class,'index'])->name('roomss.index');
Route::get('/Pagebooking',[PageBookingController::class,'index'])->name('Pagebooking.index');
Route::get('/ourTeam',[PageOurTeamController::class,'index'])->name('ourTeam.index');
Route::get('/testimonial',[PageTestimonialController::class,'index'])->name('testimonial.index');
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');
Route::get('/booking',[bookingController::class,'index'])->name('booking.index');
Route::get('/bookingInfor',[bookingInformationController::class,'index'])->name('bookingInfor.index');
Route::get('/paymentMethod',[PaymentMethonController::class,'index'])->name('paymentMethod.index');
Route::get('/Receipt',[recieptController::class,'index'])->name('Receipt.index');

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=[End FrontEnd]=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=[Start BackEnd]=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=



Route::controller(AuthAuthController::class)->group(function(){
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->name('logout');
    // Route::get('logout', 'logout')->middleware('auth')->name('logout');

     Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
}); 

// Route::middleware('auth')->group(function () {
//     Route::controller(dashBoardController::class)->group(function (){
//     Route::get('/dashboard','index')->name('dashboard.index');
//     });
//     Route::resource('dashboard',dashBoardController::class);
// // ----------------------------------------------------------------------------
// });

Route::middleware(['auth', 'role:Admin,Leader'])->group(function () {

    Route::controller(dashBoardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });

    Route::resource('dashboard', dashBoardController::class);

    Route::resource('staffs', staffsController::class);
    Route::resource('customers', customerController::class);
    Route::resource('users', userController::class);
    Route::resource('services', serviceBackendController::class);
    Route::resource('hotels', hotelController::class);
    Route::resource('hotelImages', hotelImageController::class);
    Route::resource('RoomTypes', roomTypeController::class);
    Route::resource('rooms', RoomBackEndController::class);
    Route::resource('roomImages', roomImageController::class);
    Route::resource('foods', foodController::class);
    Route::resource('foodCategory', foodCategoryController::class);
    Route::resource('bookingList', bookingListController::class);
    
});
    
    Route::resource('bookings', bookingController::class);
    Route::resource('bookingsReceipt', recieptController::class);

// //--------------[ Stuffs ]--------------
// Route::controller(staffsController::class)->group(function(){
//      Route::get('staffs','index')->name('staffs.index');
// });
// Route::resource('staffs',staffsController::class);

// //--------------[ Customer ]--------------
// Route::resource('customers',customerController::class);

// //--------------[ Users ]--------------
// Route::resource('users',userController::class);

// //--------------[ Services ]--------------
// Route::resource('services',serviceBackendController::class);

// //--------------[ Home and Hotels ]--------------
// Route::resource('hotels',hotelController::class);

// //--------------[  Hotels Image ]--------------
// Route::resource('hotelImages',hotelImageController::class);

// //--------------[ Rooms Type ]--------------
// Route::resource('RoomTypes',roomTypeController::class);

// //--------------[ Rooms ]--------------
// Route::resource('rooms',RoomBackEndController::class);

// //--------------[ Rooms Image ]--------------
// Route::resource('roomImages',roomImageController::class);

// //--------------[ Foods Image ]--------------
// Route::resource('foods',foodController::class);

// //--------------[ Foods Image ]--------------
// Route::resource('foodCategory',foodCategoryController::class);



//--------------[ booking  ]--------------

