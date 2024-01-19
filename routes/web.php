<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PickDropController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Vendor\DeliveryController;
use App\Http\Controllers\Admin\AdminRiderController;
use App\Http\Controllers\Admin\AdminVendorController;
use Illuminate\Support\Facades\View;

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

Route::view('/terms_and_conditions', 'vendor.terms_and_conditions')->name('terms_and_conditions');
Route::get('vendor/login', [VendorController::class, 'Index'])->name('vendor_login_form');
Route::get('vendor/forget/password', [VendorController::class, 'forget_password'])->name('vendor.forget.password');
Route::post('vendor/forget/password', [VendorController::class, 'forget_password_store'])->name('vendor.forget.password.store');
Route::get('vendor/forget/password/wait', [VendorController::class, 'forget_password_wait'])->name('vendor.forget.password.wait');
Route::get('vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');
Route::post('vendor/login/owner', [VendorController::class, 'VendorLogin'])->name('vendor.login');
Route::post('/register/create', [VendorController::class, 'VendorRegisterCreate'])->name('vendor.register.create');
Route::get('vendor/reset/password/{id}/{token}', [VendorController::class, 'reset_password'])->name('vendor.reset.password');
Route::post('vendor/reset/password/store/{id}', [VendorController::class, 'reset_password_store'])->name('vendor.reset.password.store');


Route::get('parcel/tracking/{id}', [VendorController::class, 'user_tracking'])->name('user.tracking');


Route::group(['prefix' => 'vendor', 'middleware' => 'vendor'], function () {
    Route::get('/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/logout', [VendorController::class, 'VendorLogout'])->name('vendor.logout');
    Route::resource('delivery', DeliveryController::class);
    Route::get('pending/pickup', [VendorController::class, 'pending_pickup_list'])->name('vendor.pickup');
    Route::get('processing/list', [VendorController::class, 'processing_list'])->name('vendor.processing');
    Route::get('complete/list', [VendorController::class, 'completed_list'])->name('vendor.complete.list');
    Route::get('tracking/{id}', [VendorController::class, 'tracking'])->name('vendor.tracking');

    Route::get('update/profile', [VendorController::class, 'update_profile'])->name('vendor.profile');
    Route::put('update/profile', [VendorController::class, 'update_profile_store'])->name('profile.store');

    Route::get('report', [VendorController::class, 'vendor_sell_report'])->name('vendor.sell_report');

    Route::post('/delivery/{id}', [DeliveryController::class, 'update'])->name('delivery.update');
    
    // routes/web.php
    Route::get('/delivery/{id}', [DeliveryController::class, 'showDelivery'])->name('delivery.show');

    Route::view('/scan-qr-code', 'vendor.scan-qr-code')->name('vendor.scan-qr-code');
    Route::get('/scan-qr-code/{id}', [DeliveryController::class, 'showDelivery'])->name('vendor.scan-qr-code');

    Route::view('/scan-qr-code', 'vendor.scan-qr-code')->name('vendor.scan-qr-code');

    // Add this to your routes/web.php
    Route::post('/delivery/search', [DeliveryController::class, 'search'])->name('delivery.search');

    

   // Route::view('/scanqr','vendor.scanqr')->name('vendor.scanqr');
  //  Route::get('/scanqr/{id}', [DeliveryController::class, 'qrDelivery'])->name('vendor.scanqr');
    
    Route::get('/d2d/invoice/serial', function () {
        return Redirect::to('vendor/delivery');
        // Alternatively, you can use the redirect helper function:
        // return redirect('vendor/delivery');
    });

    




  //  Route::any('delivery/{id}', function ($id) {
        // Your route logic here
   // })->name('delivery.update');
    

    //  export delivery data
    Route::get('bulk/delivery/', [VendorController::class, 'bulk_delivery'])->name('vendor.export');
    Route::post('delivery/export', [VendorController::class, 'delivery_export'])->name('delivery.export');
    Route::post('delivery/import', [VendorController::class, 'delivery_import'])->name('delivery.import');
    Route::post('upload/file', [VendorController::class, 'upload_file'])->name('upload.file.store');
});

Route::get('rider/login', [RiderController::class, 'login'])->name('rider.login');
Route::post('rider/login/store', [RiderController::class, 'loginStore'])->name('rider.login.store');
Route::get('rider/forget/password', [RiderController::class, 'forget_password'])->name('rider.forget.password');
Route::post('rider/forget/password', [RiderController::class, 'forget_password_store'])->name('rider.forget.password.store');
Route::get('rider/forget/password/wait', [RiderController::class, 'forget_password_wait'])->name('rider.forget.password.wait');
Route::get('rider/reset/password/{id}/{token}', [RiderController::class, 'reset_password'])->name('rider.reset.password');
Route::post('rider/reset/password/store/{id}', [RiderController::class, 'reset_password_store'])->name('rider.reset.password.store');


//Rider

Route::group(['prefix' => 'rider', 'middleware' => 'rider'], function () {
    Route::get('/dashboard', [RiderController::class, 'dashboard'])->name('rider.dashboard')->middleware('rider');
    Route::get('/register', [RiderController::class, 'register'])->name('rider.register');
    Route::post('/register', [RiderController::class, 'registerStore'])->name('rider.register.store');
    Route::get('/logout', [RiderController::class, 'logout'])->name('rider.logout');
    Route::get('pending/pickup/delivery', [RiderController::class, 'pending_pick_delivery'])->name('pending.pickup.delivery');
    Route::get('pending/drop/delivery', [RiderController::class, 'pending_drop_delivery'])->name('pending.drop.delivery');

    Route::post('/bulk-approve-pickup', [RiderController::class, 'bulkApprovePickup'])
    ->name('rider.bulk.approve.pickup');

    Route::post('/bulk-approve-drop', [RiderController::class, 'bulkApproveDrop'])
    ->name('rider.bulk.approve.drop');




    // approve pickup delivery
    Route::get('approve/pickup/delivery/{id}', [RiderController::class, 'approve_pick'])->name('approve.pickup.delivery');
    Route::post('approve/pickup/delivery/{id}', [RiderController::class, 'approve_pick'])->name('approve.pickup.delivery.store');

    // decline pickup delivery
    Route::get('decline/pickup/delivery/{id}', [RiderController::class, 'decline_pick'])->name('decline.pickup.delivery');
    Route::post('decline/pickup/delivery/{id}', [RiderController::class, 'decline_pick'])->name('decline.pickup.delivery.store');
    // approve drop delivery
    Route::get('approve/drop/delivery/{id}', [RiderController::class, 'approve_drop'])->name('approve.drop.delivery');
    Route::post('approve/drop/delivery/{id}', [RiderController::class, 'approve_drop'])->name('approve.drop.delivery.store');

    // decline drop delivery
    Route::get('decline/drop/delivery/{id}', [RiderController::class, 'decline_drop'])->name('decline.drop.delivery');
    Route::post('decline/drop/delivery/{id}', [RiderController::class, 'decline_drop'])->name('decline.drop.delivery.store');

    Route::get('pickup/delivery/list', [RiderController::class, 'pick_delivery_list'])->name('rider.pickup.delivery');
    Route::get('drop/delivery/list', [RiderController::class, 'drop_delivery_list'])->name('rider.drop.delivery');

    Route::get('delivery/details/{id}', [RiderController::class, 'vendor_delivery_details'])->name('rider.delivery.details');
    Route::post('update/delivery/status/{id}', [RiderController::class, 'update_delivery_details'])->name('rider.delivery.details.store');

    Route::get('drop/delivery/details/{id}', [RiderController::class, 'drop_delivery_details'])->name('drop.delivery.details');
    Route::post('update/drop/delivery/status/{id}', [RiderController::class, 'drop_delivery_store'])->name('drop.delivery.details.store');

    Route::get('complete/pickups', [RiderController::class, 'complete_pickups'])->name('complete.pickups');


    Route::get('pending-pick-drop', [RiderController::class, 'pendingPickDrop'])->name('pending.pick_drop');

    Route::post('pick-drop-approved/{id}', [RiderController::class, 'pickDropApproved'])->name('pick_drop.approved');
    Route::post('pick-drop-declined/{id}', [RiderController::class, 'pickDropDeclined'])->name('pick_drop.declined');

    Route::get('processing-pickdrops', [RiderController::class, 'processingPickList'])->name('processing.pick_drop.list');
    Route::get('processing-pickdrop/{id}', [RiderController::class, 'proccesingPickDetails'])->name('processing.pick_drop');
    Route::post('update-processing-pickdrop/{id}', [RiderController::class, 'processingPickStore'])->name('processing.pick_drop.store');

    Route::get('pending-pickdrop-list', [RiderController::class, 'pending_pickdrop_list'])->name('pending_pickdrop_list');
    Route::get('approve-drop/{id}', [RiderController::class, 'approve_drop_pickup'])->name('approve_drop_pickup');
    Route::post('approve-drop/{id}', [RiderController::class, 'approve_drop_pickup'])->name('approve_drop_pickup');
    Route::get('decline-drop/{id}', [RiderController::class, 'decline_drop_pickup'])->name('decline_drop_pickup');
    Route::get('processing-pickdrop-list', [RiderController::class, 'processing_pickdrop_list'])->name('processing_pickdrop_list');
    Route::get('processing-dropDetails/{id}', [RiderController::class, 'processing_pickdrop_details'])->name('processing_pickdrop_details');
    Route::post('processing-dropDetails/{id}', [RiderController::class, 'processing_pickdrop_store'])->name('processing_pickdrop_store');

    // Pending pickup routes
    Route::get('pending/pickup/list', [RiderController::class, 'pending_pick_delivery_list'])->name('rider.pending.pickup.list');
    Route::get('pending/pickup/search', [RiderController::class, 'searchPendingPickup'])->name('rider.pending.pickup.search');
    
    //Pending Drop Routes
    Route::get('pending/drop/search', [RiderController::class, 'searchPendingDrop'])->name('rider.pending.drop.search');

    // Add this route for searching complete pickups
    Route::get('complete/pickup/search', [RiderController::class, 'searchCompletePickup'])->name('rider.complete.pickup.search');
    Route::get('/search', [RiderController::class, 'search'])->name('rider.search');


});



Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login/store', [AdminController::class, 'customLogin'])->name('admin.login.store');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('searching/{id}', [AdminController::class, 'searching'])->name('admin.searching');

    Route::resource('vendor', AdminVendorController::class);
    Route::resource('rider', AdminRiderController::class);
    Route::resource('area', AreaController::class);

    Route::get('bulk/delivery/list', [AdminController::class, 'bulkDeliveries'])->name('bulk.delivery.list');

    Route::get('pending/delivery', [AdminVendorController::class, 'pending_delivery'])->name('vendor.pending.delivery');
    Route::put('pending/delivery', [AdminVendorController::class, 'pending_delivery'])->name('vendor.pending.delivery');
    
    //New Route for Multiple Select
    //Route::get('vendor/pending/delivery', [AdminVendorController::class, 'pending_delivery'])->name('vendor.pending.delivery');
    Route::put('pending/deliveryx', [AdminVendorController::class, 'pending_pickup_delivery_storex'])->name('pending.delivery.storex');
    
    Route::put('vendor/processing/deliveryx', [AdminVendorController::class, 'processing_pickup_delivery_storex'])->name('processing.delivery.storex');

    Route::get('pending/delivery/{id}', [AdminVendorController::class, 'pending_pickup_delivery'])->name('pending.delivery');
    Route::put('pending/delivery/{id}', [AdminVendorController::class, 'pending_pickup_delivery_store'])->name('pending.delivery.store');
    Route::get('/search-riders', [AdminVendorController::class, 'searchRiders']);
    Route::get('vendor/pending/pickup', [AdminVendorController::class, 'pending_pickup_delivery_list'])->name('vendor.pending.pickup');
    Route::get('vendor/processing/delivery', [AdminVendorController::class, 'processing_delivery'])->name('vendor.processing.delivery');
    Route::get('vendor/processing/pickup/{id}', [AdminVendorController::class, 'processing_pickup_delivery'])->name('vendor.processing.pickup');
    Route::put('vendor/processing/pickup/{id}', [AdminVendorController::class, 'processing_pickup_delivery_store'])->name('vendor.processing.pickup.store');

    Route::get('vendor/complete/delivery', [AdminVendorController::class, 'complete_delivery_list'])->name('vendor.complete.delivery');
    Route::get('vendor/complete/{id}', [AdminVendorController::class, 'complete_delivery_create'])->name('vendor.complete');
    Route::put('vendor/complete/{id}', [AdminVendorController::class, 'complete_delivery_store'])->name('vendor.complete.store');

    Route::get('vendor/delivery/by/date/list', [AdminVendorController::class, 'delivery_by_date'])->name('delivery.by.date.list');
    Route::get('vendor/delivery/by/date', [AdminVendorController::class, 'delivery_by_date'])->name('delivery.by.date');
    Route::post('vendor/delivery/by/date', [AdminVendorController::class, 'delivery_by_date_store'])->name('delivery.by.date.store');

    Route::get('/searching', [AdminController::class,'searchex'])->name('admin.searching');
    Route::get('/searching/{id}', [AdminController::class, 'searchex'])->name('admin.searching');

    Route::get('vendor/date2date/list', [AdminVendorController::class, 'date_to_date_list'])->name('date2date.list');
    Route::get('vendor/date2date/create', [AdminVendorController::class, 'date_to_date'])->name('date2date.create');
    Route::post('vendor/date2date/create', [AdminVendorController::class, 'date_to_date_store'])->name('date2date.store');

    Route::get('vendor/report/{id}', [AdminVendorController::class, 'vendor_report'])->name('vendor.report');

    Route::get('vendor/invoice/{id}', [AdminVendorController::class, 'vendor_invoice'])->name('vendor.invoice');
    Route::get('vendor/d2d/invoice/{id}', [AdminVendorController::class, 'vendor_d2d_invoice'])->name('vendor.d2d.invoice');

     // inactive vendors
     Route::get('vendor/inactive/list', [AdminVendorController::class, 'active_vendor'])->name('inactive.vendor.list');
     Route::post('vendor/inactive/list/{id}', [AdminVendorController::class, 'active_vendor_store'])->name('active.vendor.store');

    Route::get('pickdrop-list', [AdminController::class, 'pickDropList'])->name('pickdrop.list');
    Route::get('pickdrop/{id}', [AdminController::class, 'pickDropDetails'])->name('pickdrop.details');
    Route::put('pickrider/{id}', [AdminController::class, 'pickRider'])->name('pick.rider');

    Route::get('processing/pickupdrop/', [AdminController::class, 'processingPick'])->name('processing.pickup');
    Route::get('processing/pickupdrop/details/{id}', [AdminController::class, 'pendingPickDetails'])->name('processing.pickup.details');
    Route::put('processing/pickupdrop/details/{id}', [AdminController::class, 'pendingUpdate'])->name('processing.pickup.store');

    Route::get('return/list', [AdminController::class, 'return_list'])->name('return.list');
    Route::get('complete/pickup/list', [AdminVendorController::class, 'complete_pickup'])->name('complete.pickup');

    Route::get('completed-pickup', [AdminController::class, 'completedPick'])->name('completed.pickup');
    Route::get('completed-pickup/details/{id}', [AdminController::class, 'completedPickDetails'])->name('completed.pickup.details');

    Route::get('processing/pickupdrops/', [AdminController::class, 'processing_pickupDrop'])->name('processing_pickupDrop');
    Route::get('processing/pickupdrops/details/{id}', [AdminController::class, 'processing_pickupDrop_details'])->name('processing_pickupDrop_details');
    Route::put('processing/pickupdrops/details/{id}', [AdminController::class, 'processing_pickupDrop_update'])->name('processing_pickupDrop_update');
    Route::get('complete-drop', [AdminController::class, 'complete_drops'])->name('complete.drop');

    Route::get('cancel-pickdrop', [AdminController::class, 'cancelPickDrop'])->name('cancel.pickdrop');

    Route::get('hold-list', [AdminVendorController::class, 'hold_deliveries'])->name('hold.list');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/pickdrop', [PickDropController::class, 'index'])->name('pickdrop');
// Route::get('/pickdrop/create', [PickDropController::class, 'create'])->name('pickdrop.create');
Route::post('/pickdrop/create', [PickDropController::class, 'storePickDrop'])->name('pickdrop.store');

Route::get('/dashboard', function () {
    return view('customer.dashboard');
})->middleware(['auth'])->name('dashboard');




require __DIR__.'/auth.php';
