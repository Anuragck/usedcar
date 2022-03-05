<?php

use App\Http\Controllers\admins\AdminPagesController;
use App\Http\Controllers\admins\BookingListController;
use App\Http\Controllers\admins\BrandController;
use App\Http\Controllers\admins\DeliveryListController;
use App\Http\Controllers\admins\EnquiryController;
use App\Http\Controllers\admins\ImagesController;
use App\Http\Controllers\admins\ModelController;
use App\Http\Controllers\admins\PurchaseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\superadmin\SuperAdminController;
use App\Http\Controllers\users\UserPagesController;
use App\Http\Controllers\admins\ExpenseCategoryController;
use App\Http\Controllers\admins\ExpenseController;
use App\Http\Controllers\admins\PaymentController;
use App\Http\Controllers\admins\ReadyVehiclesController;
use App\Http\Controllers\admins\SaleController;
use App\Http\Controllers\admins\VehicleListController;
use App\Http\Controllers\admins\DashboardController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\users\IndexPageController;
use App\Http\Controllers\users\VehiclePageController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [UserPagesController::class, 'index'])->name('index');
Route::get('/about', [UserPagesController::class, 'about'])->name('about');
Route::get('/allCarsPage', [UserPagesController::class, 'allCarsPage'])->name('allCarsPage');
Route::get('/contact', [UserPagesController::class, 'contact'])->name('contact');





//Index-page-cars-get
Route::get('/index-page-vehicles', [IndexPageController::class, 'getFeaturedCars']);

//single-car-view
Route::get('/singleCarView/{id}', [VehiclePageController::class, 'singleVehicle']);

//add-enquiry
Route::post('/singleCarView/add-enquiry', [EnquiryController::class, 'addEnquiry']);

//all-cars
//single-car-view
Route::get('/all-cars', [VehiclePageController::class, 'allCars']);

Route::get('/user-get-brands', [BrandController::class, 'getBrands']);
 //model-by-brand
 Route::get('/user-get-model-by-brand', [ModelController::class, 'getModelByBrand']);


//ADMIN-ROUTE-GROUP
Route::middleware(['middleware' => 'preventBackHistory'])->group(function () {
    Auth::routes([
        'login'=>true,
        'logout'=>true,
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
      ]);
});

Route::get('/logout', [LoginController::class, 'logout']);

//ADMIN-ROUTE-GROUP
Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'preventBackHistory']], function () {
    Route::get('dashboard', [AdminPagesController::class, 'dashboard'])->name('admin.dashboard');

    //lead-management
    Route::post('/add-new-lead', [EnquiryController::class, 'addLead']);
    Route::get('/get-enquiries', [EnquiryController::class, 'getEnquiries']);
    Route::post('/add-call-entry/{id}', [EnquiryController::class, 'addCallEntry']);
    Route::get('/get-follow-up-history', [EnquiryController::class, 'getHistory']);
    Route::get('/get-vehicle-for-booking', [EnquiryController::class, 'getVehicleForBooking']);


    //Brand
    Route::post('/add-brand', [BrandController::class, 'addBrand']);
    Route::get('/get-brands', [BrandController::class, 'getBrands']);
    Route::post('/delete-brands/{id}', [BrandController::class, 'deleteBrands']);


    //Model
    Route::post('/add-model', [ModelController::class, 'addModel']);
    Route::get('/get-models', [ModelController::class, 'getModels']);
    Route::post('/delete-model/{id}', [ModelController::class, 'deleteModel']);

    //Expense Category
    Route::post('/add-expensecategory', [ExpenseCategoryController::class, 'addExpenseCategory']);
    Route::get('/get-expensecategories', [ExpenseCategoryController::class, 'getExpenseCategories']);
    Route::post('/delete-expensecategory/{id}', [ExpenseCategoryController::class, 'deleteExpenseCategory']);

    //Expense

    Route::post('/add-expense', [ExpenseController::class, 'save']);
    Route::get('/get-expense-history', [ExpenseController::class, 'getHistory']);
    Route::get('/get-expense-report', [ExpenseController::class, 'expenseReport']);


    //model-by-brand
    Route::get('/get-model-by-brand', [ModelController::class, 'getModelByBrand']);

    //purchase
    Route::post('/add-purchase', [PurchaseController::class, 'addPurchase']);
    Route::get('/get-purchases', [PurchaseController::class, 'getPurchase']);
    Route::post('/delete-purchase/{id}', [PurchaseController::class, 'deletePurchase']);

    //images
    Route::get('/get-vehicle-for-image', [ImagesController::class, 'getVehicleImage']);

    Route::post('/add-reg-cert', [ImagesController::class, 'addRegCert']);
    Route::post('/delete-reg-cert', [ImagesController::class, 'DeleteRc']);

    Route::post('/add-insurance', [ImagesController::class, 'addInsurance']);
    Route::post('/delete-insurance', [ImagesController::class, 'deleteInsurance']);

    Route::post('/add-address-proof', [ImagesController::class, 'addAddressProof']);
    Route::post('/delete-address-proof', [ImagesController::class, 'deleteAddress']);

    Route::post('/add-image', [ImagesController::class, 'addImage']);
    Route::get('/get-images', [ImagesController::class, 'getImages']);
    Route::get('/get-new-images', [ImagesController::class, 'getNewImages']);

    Route::post('/remove-image', [ImagesController::class, 'removeImage']);


    Route::get('/get-vehicle-list', [VehicleListController::class, 'vehilceList']);


    //reday-to-sell
    Route::post('/ready-sell', [VehicleListController::class, 'sellReady']);

    Route::get('/ready-vehicles', [VehicleListController::class, 'readyVehicles']);

    Route::post('/add-to-web', [ReadyVehiclesController::class, 'add']);
    Route::post('/remove-from-web', [ReadyVehiclesController::class, 'remove']);
    Route::post('/add-home', [ReadyVehiclesController::class, 'addHome']);


    //Convertion_status
    Route::post('/add-convertion', [EnquiryController::class, 'addConvertion']);

    //Booking-List
    Route::get('/get-booking-list', [BookingListController::class, 'getBookingList']);

    //payment
    Route::post('/add-payment', [PaymentController::class, 'addPayment']);
    Route::get('/get-payment-history', [PaymentController::class, 'getHistory']);

    //mark-as-sale
    Route::post('/add-sale', [SaleController::class, 'addBuyerAddress']);

    //delivery-list
    Route::get('/get-delivery-list', [DeliveryListController::class, 'getDeliveryList']);

    //Booking-List
    Route::post('/add-rc-transfer', [DeliveryListController::class, 'rcTransfer']);

    //dashboard-data
    Route::get('/dashboard-data', [DashboardController::class, 'getDashboardData']);
 //Change password
 Route::post('updatePassword', [PasswordChangeController::class, 'changePassword']);
});



//SUPER-ADMIN-ROUTE-GROUP
// Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {

//     Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
// });



// Route::get('{path}', [AdminPagesController::class, 'dashboard'])->where('path', '.*')->middleware('isAdmin');
