<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Rider;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\PickDrop;
use App\Models\BulkDelivery;
use Illuminate\Http\Request;
use App\Exports\BulkDeliveryExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\NotificationEvent;
use App\Models\User;
use App\Models\PendingPickup;
use App\Models\PendingDrop;
use App\Models\CompletedPickup;
use App\Models\CompletedDrop;


class AdminController extends Controller
{
    public function login()
    {
        $data['title'] = "Admin Login";

        return view('backend.login', $data);
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            Auth::login(Auth::guard('admin')->user());
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->with('error', 'Email or Password is incorrect');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('admin.login');
    }


    public function searchex(Request $request)
{
    $data['title'] = 'Delivery List';
    $query = Delivery::query();
    
    if ($request->has('search')) {
        $search = $request->input('search');
        $search_str = strval($search);

        $latestDelivery = $query->where('recipient_number', 'like', "%$search_str%")
            ->orWhere('recipient_name', 'like', "%$search_str%")
            ->latest()
            ->first();

        if ($latestDelivery) {
            return view('admin.searching', ['latestDelivery' => $latestDelivery]);
        } else {
            session()->flash('message', '404 Not Found');
            return redirect()->back();
        }
    }

    // If no search term provided, fetch the latest delivery
    $latestDelivery = $query->latest()->first();

    if ($latestDelivery) {
        return view('admin.searching', ['latestDelivery' => $latestDelivery]);
    } else {
        session()->flash('message', '404 Not Found');
        return redirect()->back();
    }
}






    public function dashboard()
    {
        $data['title'] = "Admin Dashboard";
        $data['total_vendor'] = Vendor::all()->count();
        $data['total_rider'] = Rider::all()->count();
        $data['total_customer'] = Customer::all()->count();
        $data['total_pending_delivery'] = Delivery::where('status', 'Pending')->count();
        $data['total_processing_delivery'] = Delivery::where('status', 'Processing')->count();
        $data['pending_pickup'] = Delivery::where('status', 'Pending_Pickup')->count();
        $data['total_completed_delivery'] = Delivery::where('status', 'Completed')->count();
        $data['total_area'] = Area::where('status', 'Active')->count();
        $data['total_bulk_delivery'] = BulkDelivery::all()->count();
        // pickdrops

        $data['total_pickdrops'] = PickDrop::all()->count();
        $data['total_pending_pick'] = PickDrop::where('status', 'Pending')->count();
        $data['total_processing_pick'] = PickDrop::where('status', 'Processing')->count();
        $data['total_completed_pick'] = PickDrop::where('status', 'Completed')->count();
        $data['total_cancel_pick'] = PickDrop::where('status', 'Cancel')->count();

        return view('backend.index', $data);
    }

    public function bulkDeliveries()
    {
        $data['title'] = "Bulk Deliveries";
        $data['bulk_delivery'] = BulkDelivery::latest()->get();

        return view('backend.bulk_deliveries', $data);
    }

    public function return_list()
    {
        $data['title'] = "Return List";
        $data['deliveries'] = Delivery::where('status', 'Return')->latest()->get();

        return view('backend.vendor.return_list', $data);
    }


    public function pickDropList() {
        $data['title'] = "Pick Drop List";
        $data['pick_drop'] = PickDrop::where('status', 'Pending')->latest()->get();

        return view('backend.pickdrop.pick_drop_list', $data);
    }
    
    public function pickDropDetails($id)
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::find($id);
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.pick_drop_details', $data);
    }

    public function pickRider(Request $request, $id)
    {
        $request->validate([
            'pick_rider' => 'required',
        ]);

        $p_delivery = PickDrop::find($id);
        $p_delivery->item_name = $request->item_name;
        $p_delivery->qty = $request->qty;
        $p_delivery->item_price = $request->item_price;
        $p_delivery->delivery_charge = $request->delivery_charge;
        $p_delivery->total_price = $request->total_price;
        $p_delivery->delivery_type = $request->delivery_type;
        $p_delivery->delivery_des = $request->delivery_des;
        if($request->delivery_type == 'cash_on'){
            $p_delivery->delivery_type = 'cash on delivery';
        }
        else{
            $p_delivery->delivery_type = 'online payment';
        }
        if($p_delivery->delivery_type == 'delivery_des')
        {
            $p_delivery->delivery_des = 'inside city';
        }
        else{
            $p_delivery->delivery_des = 'outside city';
        }
        $p_delivery->pick_name = $request->pick_name;
        $p_delivery->pick_number = $request->pick_number;
        $p_delivery->pick_address = $request->pick_address;
        $p_delivery->drop_name = $request->drop_name;
        $p_delivery->drop_number = $request->drop_number;
        $p_delivery->drop_address = $request->drop_address;
        $p_delivery->delivery_time = date('Y-m-d');
        $p_delivery->pick_rider = $request->pick_rider;
        $p_delivery->status = 'Pending_Pickup';
        NotificationEvent::dispatch('You Have A New Pickup Delivery', $request->pick_rider, 'rider');
        # send notification to selected rider
        
        $p_delivery->save();

        

        return redirect()->route('processing.pickup')->with('success', 'Rider Assigned Successfully');
    }

    public function processingPick()
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::where('status', 'Pending_Pickup')->latest()->get();
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.pending_pick', $data);
    }

    public function pendingPickDetails($id)
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::find($id);
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.pending_pick_details', $data);
    }


    public function pendingUpdate(Request $request, $id)
    {
        $request->validate([
            'pick_rider' => 'required',
        ]);

        $p_delivery = PickDrop::find($id);
        $p_delivery->item_name = $request->item_name;
        $p_delivery->qty = $request->qty;
        $p_delivery->item_price = $request->item_price;
        $p_delivery->delivery_charge = $request->delivery_charge;
        $p_delivery->total_price = $request->total_price;
        $p_delivery->delivery_type = $request->delivery_type;
        $p_delivery->delivery_des = $request->delivery_des;
        if($request->delivery_type == 'cash_on'){
            $p_delivery->delivery_type = 'cash on delivery';
        }
        else{
            $p_delivery->delivery_type = 'online payment';
        }
        if($p_delivery->delivery_type == 'delivery_des')
        {
            $p_delivery->delivery_des = 'inside city';
        }
        else{
            $p_delivery->delivery_des = 'outside city';
        }
        $p_delivery->pick_name = $request->pick_name;
        $p_delivery->pick_number = $request->pick_number;
        $p_delivery->pick_address = $request->pick_address;
        $p_delivery->drop_name = $request->drop_name;
        $p_delivery->drop_number = $request->drop_number;
        $p_delivery->drop_address = $request->drop_address;
        $p_delivery->delivery_time = date('Y-m-d');
        $p_delivery->pick_rider = $request->pick_rider;
        $p_delivery->status = 'Pending';
        
        NotificationEvent::dispatch('You Have A New Pickup Delivery', $request->pick_rider, 'rider');
        # send notification to selected rider
        
        $p_delivery->save();
        return redirect()->route('pickdrop.list')->with('success', 'Rider Assigned Successfully');
    }

    public function processingPickDrop()
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::where('status', 'Processing')->latest()->get();
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.proccesing_pick', $data);
    }

    public function processingPickDropDetails($id)
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::find($id);
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.proccesing_pick_details', $data);
    }

    public function processingPickDropUpdate(Request $request, $id)
    {
        $request->validate([
            'drop_rider' => 'required',
        ]);

        $p_delivery = PickDrop::find($id);
        $p_delivery->item_name = $request->item_name;
        $p_delivery->qty = $request->qty;
        $p_delivery->item_price = $request->item_price;
        $p_delivery->delivery_charge = $request->delivery_charge;
        $p_delivery->total_price = $request->total_price;
        $p_delivery->delivery_type = $request->delivery_type;
        $p_delivery->delivery_des = $request->delivery_des;
        if($request->delivery_type == 'cash_on'){
            $p_delivery->delivery_type = 'cash on delivery';
        }
        else{
            $p_delivery->delivery_type = 'online payment';
        }
        if($p_delivery->delivery_type == 'delivery_des')
        {
            $p_delivery->delivery_des = 'inside city';
        }
        else{
            $p_delivery->delivery_des = 'outside city';
        }
        $p_delivery->pick_name = $request->pick_name;
        $p_delivery->pick_number = $request->pick_number;
        $p_delivery->pick_address = $request->pick_address;
        $p_delivery->drop_name = $request->drop_name;
        $p_delivery->drop_number = $request->drop_number;
        $p_delivery->drop_address = $request->drop_address;
        $p_delivery->delivery_time = date('Y-m-d');
        $p_delivery->pick_rider = $request->pick_rider;
        $p_delivery->drop_rider = $request->drop_rider;
        $p_delivery->status = 'Processing';
        NotificationEvent::dispatch('You Have A New Drop Delivery', $request->drop_rider, 'rider');
        # send notification to selected rider
        
        $p_delivery->save();

        return redirect()->route('complete.drop')->with('success', 'Rider Assigned Successfully');
    }

    public function completedPick()
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::where('pick_status', 'Completed')->latest()->get();
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.completed_pick', $data);
    }

    public function completedPickDetails($id)
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::where('id', $id)->where('pick_status', 'Completed')->first();

        return view('backend.pickdrop.completed_pick_detail', $data);
    }

    public function processing_pickupDrop()
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::where('status', 'Processing')->latest()->get();
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.proccesing_pick', $data);
    }

    public function processing_pickupDrop_details($id)
    {
        $data['title'] = "Pick Drop Details";
        $data['pick_drop'] = PickDrop::find($id);
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.proccesing_drop_details', $data);
    }

    // processing pickup drop store
    public function processing_pickupDrop_update(Request $request, $id)
    {
        $request->validate([
            'drop_rider' => 'required',
        ]);

        $p_delivery = PickDrop::find($id);
        $p_delivery->item_name = $request->item_name;
        $p_delivery->qty = $request->qty;
        $p_delivery->item_price = $request->item_price;
        $p_delivery->delivery_charge = $request->delivery_charge;
        $p_delivery->total_price = $request->total_price;
        $p_delivery->delivery_type = $request->delivery_type;
        $p_delivery->delivery_des = $request->delivery_des;
        if($request->delivery_type == 'cash_on'){
            $p_delivery->delivery_type = 'cash on delivery';
        }
        else{
            $p_delivery->delivery_type = 'online payment';
        }
        if($p_delivery->delivery_type == 'delivery_des')
        {
            $p_delivery->delivery_des = 'inside city';
        }
        else{
            $p_delivery->delivery_des = 'outside city';
        }
        $p_delivery->pick_name = $request->pick_name;
        $p_delivery->pick_number = $request->pick_number;
        $p_delivery->pick_address = $request->pick_address;
        $p_delivery->drop_name = $request->drop_name;
        $p_delivery->drop_number = $request->drop_number;
        $p_delivery->drop_address = $request->drop_address;
        $p_delivery->delivery_time = date('Y-m-d');
        $p_delivery->drop_rider = $request->drop_rider;
        $p_delivery->status = 'Processing';
        $p_delivery->drop_status = 'Pending_Drop';
        NotificationEvent::dispatch('You Have A New Pickup Delivery', $request->drop_rider, 'rider');
        # send notification to selected rider
        
        $p_delivery->save();
        return redirect()->route('processing_pickupDrop')->with('success', 'Rider Assigned Successfully');
    }

    public function complete_drops()
    {
        $data['title'] = "Completed Drop";
        $data['pick_drop'] = PickDrop::where('status', 'Completed')->latest()->get();
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.completed_drop', $data);
    }

    public function cancelPickDrop() {
        $data['title'] = "Cancel Drop";
        $data['pick_drop'] = PickDrop::where('status', 'Cancel')->latest()->get();
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.pickdrop.cancel_drop', $data);
    }


    // get the excel file data as an order

    public function search(Request $request)
{
    $query = $request->input('query');

    // Perform the search across multiple models/tables
    $searchResults = [];

    // Search in the Vendor model/table
    $searchResults['vendors'] = Vendor::where('vendor_name', 'LIKE', "%$query%")
        ->orWhere('email', 'LIKE', "%$query%")
        ->orWhere('mobile', 'LIKE', "%$query%")
        ->orWhere('address', 'LIKE', "%$query%")
        ->get();

    // Search in the Rider model/table
    $searchResults['riders'] = Rider::where('rider_name', 'LIKE', "%$query%")
        ->orWhere('email', 'LIKE', "%$query%")
        ->orWhere('mobile', 'LIKE', "%$query%")
        ->orWhere('address', 'LIKE', "%$query%")
        ->get();

    // Search in the Admin model/table
    $searchResults['users'] = User::where('name', 'LIKE', "%$query%")
    ->orWhere('email', 'LIKE', "%$query%")
    ->get();

    // Search in the PendingPickup model/table
    $searchResults['pendingPickups'] = PendingPickup::where('rider_name', 'LIKE', "%$query%")
    ->orWhere('email', 'LIKE', "%$query%")
    ->orWhere('mobile', 'LIKE', "%$query%")
    ->orWhere('address', 'LIKE', "%$query%")
    ->get();

    // Search in the PendingDrop model/table
    $searchResults['pendingDrops'] = PendingDrop::where('rider_name', 'LIKE', "%$query%")
    ->orWhere('email', 'LIKE', "%$query%")
    ->orWhere('mobile', 'LIKE', "%$query%")
    ->orWhere('address', 'LIKE', "%$query%")
    ->get();

    // Search in the CompletedPickup model/table
    $searchResults['completedPickups'] = CompletedPickup::where('rider_name', 'LIKE', "%$query%")
    ->orWhere('email', 'LIKE', "%$query%")
    ->orWhere('mobile', 'LIKE', "%$query%")
    ->orWhere('address', 'LIKE', "%$query%")
    ->get();

    // Search in the CompletedDrop model/table
    $searchResults['completedDrops'] = CompletedDrop::where('rider_name', 'LIKE', "%$query%")
    ->orWhere('email', 'LIKE', "%$query%")
    ->orWhere('mobile', 'LIKE', "%$query%")
    ->orWhere('address', 'LIKE', "%$query%")
    ->get();

    $data['title'] = "Admin Dashboard";
    $data['total_vendor'] = Vendor::all()->count();
    $data['total_rider'] = Rider::all()->count();
    $data['total_customer'] = Customer::all()->count();
    $data['total_pending_delivery'] = Delivery::where('status', 'Pending')->count();
    $data['total_processing_delivery'] = Delivery::where('status', 'Processing')->count();
    $data['pending_pickup'] = Delivery::where('status', 'Pending_Pickup')->count();
    $data['total_completed_delivery'] = Delivery::where('status', 'Completed')->count();
    $data['total_area'] = Area::where('status', 'Active')->count();
    $data['total_bulk_delivery'] = BulkDelivery::all()->count();
    // pickdrops

    $data['total_pickdrops'] = PickDrop::all()->count();
    $data['total_pending_pick'] = PickDrop::where('status', 'Pending')->count();
    $data['total_processing_pick'] = PickDrop::where('status', 'Processing')->count();
    $data['total_completed_pick'] = PickDrop::where('status', 'Completed')->count();
    $data['total_cancel_pick'] = PickDrop::where('status', 'Cancel')->count();
    $data['searchResults'] = $searchResults;
    
    return view('backend.index', $data);
   // return view('backend.index', compact('total_cancel_pick','total_completed_pick','total_processing_pick','total_pending_pick','total_pickdrops','total_area','total_rider','total_vendor','total_bulk_delivery','total_completed_delivery','total_processing_delivery','pending_pickup','searchResults', 'total_pending_delivery', 'pending_pickups'));
}


}
