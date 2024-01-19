<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use App\Models\Delivery;
use App\Models\Rider;
use Carbon\Carbon;
use App\Events\NotificationEvent;
use Brian2694\Toastr\Facades\Toastr;

class AdminVendorController extends Controller
{
    public function index()
    {
        $data['title'] = 'Vendor List';
        $data['vendors'] = Vendor::where('status', 'Active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.vendor.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Add Vendor';

        return view('backend.vendor.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_name' => 'required',
            'vendor_name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $vendor = new Vendor();
        $vendor->owner_name = $request->owner_name;
        $vendor->vendor_name = $request->vendor_name;
        $vendor->email = $request->email;
        $vendor->mobile = $request->mobile;
        $vendor->address = $request->address;
        $vendor->username = $request->username;
        $vendor->password = Hash::make($request->password);

        if ($request->hasFile('vendor_logo')) {
            $image = $request->file('vendor_logo');
            $image_name = time() . rand(1111, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/vendor_logo'), $image_name);
            $vendor->vendor_logo = $image_name;
        }
        $vendor->save();
        Toastr::success('Vendor Added Successfully', 'Success');
        return redirect()
            ->route('vendor.index')
            ->with('success', 'Vendor Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'Vendor Details';
        $data['vendor'] = Vendor::find($id);

        return view('backend.vendor.show', $data);
    }

    public function vendor_report($id)
    {
        $data['title'] = 'Vendor Report';
        $data['vendor'] = Vendor::find($id);
        $data['deliveries'] = Delivery::where('vendor_id', $id)->get();
        $data['total_pending'] = Delivery::where('vendor_id', $id)
            ->where('status', 'Pending')
            ->count();
        $data['total_pickup'] = Delivery::where('vendor_id', $id)
            ->where('status', 'Pending_Pickup')
            ->count();
        $data['total_processing'] = Delivery::where('vendor_id', $id)
            ->where('status', 'Processing')
            ->count();
        $data['total_completed'] = Delivery::where('vendor_id', $id)
            ->where('status', 'Completed')
            ->count();

        $data['total_pending_amount'] = Delivery::where('vendor_id', $id)
            ->where('status', 'Pending')
            ->sum('total_price');
        $data['total_pickup_amount'] = Delivery::where('vendor_id', $id)
            ->where('status', 'Pending_Pickup')
            ->sum('total_price');
        $data['total_processing_amount'] = Delivery::where('vendor_id', $id)
            ->where('status', 'Processing')
            ->sum('total_price');
        $data['total_completed_amount'] = Delivery::where('vendor_id', $id)
            ->where('status', 'Completed')
            ->sum('total_price');

        $data['total_amount'] = Delivery::where('vendor_id', $id)->sum('total_price');
        $data['delivery_charge'] = Delivery::where('vendor_id', $id)->sum('delivery_charge');
        $data['payoff'] = $data['total_amount'] - $data['delivery_charge'];

        return view('backend.vendor.report', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Vendor';
        $data['vendor'] = Vendor::find($id);

        return view('backend.vendor.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'owner_name' => 'required',
            'vendor_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'vendor_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $vendor = Vendor::find($id);
        $vendor->owner_name = $request->owner_name;
        $vendor->vendor_name = $request->vendor_name;
        $vendor->email = $request->email;
        $vendor->mobile = $request->mobile;
        $vendor->address = $request->address;
        $vendor->username = $request->username;
        $vendor->password = Hash::make($request->password);

        if ($request->hasFile('vendor_logo')) {
            $image = $request->file('vendor_logo');
            $image_name = time() . rand(1111, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/vendor_logo'), $image_name);
            $vendor->vendor_logo = $image_name;
        }
        $vendor->save();
        Toastr::success('Vendor Updated Successfully', 'Success');

        return redirect()
            ->route('vendor.index')
            ->with('success', 'Vendor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
        Toastr::error('Vendor Deleted Successfully', 'Error');
        return redirect()
            ->route('vendor.index')
            ->with('success', 'Vendor Deleted Successfully');
    }

    public function pending_delivery()
    {
        //dd(11);
        $data['title'] = 'Pending Delivery List';
        $data['deliveries'] = Delivery::where('status', 'Pending')
            ->orderBy('id', 'desc')
            ->get();
        $data['riders'] = Rider::get();
        //$data['delivery_id'] = Delivery::find($id);
        
        return view('backend.vendor.pending_delivery', $data);
    }

    public function pending_pickup_delivery_list()
    {
        $data['title'] = 'Pending Pickup Delivery List';
        $data['deliveries'] = Delivery::where('status', 'Pending_Pickup')
            ->orderByDesc('created_at')
            ->get();

        return view('backend.vendor.pending_pickup_list', $data);
    }

    public function pending_pickup_delivery($id)
    {
        $data['title'] = 'Pending Pickup Delivery List';
        $data['delivery'] = Delivery::find($id);
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.vendor.pending_pickup_delivery', $data);
    }

    public function pending_pickup_delivery_store(Request $request, $id)
    {
        //dd(11);
        $request->validate([
            'pick_rider' => 'required',
        ]);

        $p_delivery = Delivery::find($id);
        $p_delivery->vendor_id = $request->vendor_id;
        $p_delivery->item_name = $request->item_name;
        $p_delivery->qty = $request->qty;
        $p_delivery->item_price = $request->item_price;
        $p_delivery->delivery_charge = $request->delivery_charge;
        $p_delivery->total_price = $request->total_price;
        $p_delivery->delivery_type = $request->delivery_type;
        $p_delivery->delivery_des = $request->delivery_des;
        if ($request->delivery_type == 'cash_on') {
            $p_delivery->delivery_type = 'cash on delivery';
        } else {
            $p_delivery->delivery_type = 'online payment';
        }
        if ($p_delivery->delivery_type == 'delivery_des') {
            $p_delivery->delivery_des = 'inside city';
        } else {
            $p_delivery->delivery_des = 'outside city';
        }
        $p_delivery->recipient_name = $request->recipient_name;
        $p_delivery->recipient_number = $request->recipient_number;
        $p_delivery->recipient_address = $request->recipient_address . '-' . $request->flat_no . '-' . $request->road_no;
        $p_delivery->status = 'Pending_Pickup';
        $p_delivery->delivery_time = date('Y-m-d');
        $p_delivery->pick_rider = $request->pick_rider;
        NotificationEvent::dispatch('You Have A New Pickup Delivery', $request->pick_rider, 'rider');
        # send notification to selected rider

        $p_delivery->save();
        Toastr::success('Rider Assign Successfully', 'Success');
        return redirect()
            ->route('vendor.pending.pickup')
            ->with('success', 'Delivery Added Successfully');
    }

    public function pending_pickup_delivery_storex(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'pick_rider' => 'required',
        ]);

        $selectedDeliveries = $request->input('delivery');
        //dd($selectedDeliveries);
        $pickrider = Delivery::where('pick_rider',$request->pick_rider)->first();
        //dd($pickrider);

        foreach ($selectedDeliveries as $deliveryId) {
            // Assuming you have a Delivery model
           // $delivery = new Delivery;
           // $delivery->vendor_id = $deliveryId; // Assuming 'id' is the primary key
            // Additional logic if needed
            //$delivery->pick_rider = $request->pick_rider;
            //$delivery->save();

            // $pickrider->update([
            //     'vendor_id' => $deliveryId,
            //     'pick_rider' => $request->pick_rider,
            //     // Additional fields if needed
            // ]);

            Delivery::updateOrCreate(
                [
                    'pick_rider' => $request->pick_rider,
                    'vendor_id' => $deliveryId,
                ],
            //     [
            //  // Use the data you need from the first function
            //         'item_name' => $request->item_name,
            //         'qty' => $request->qty,
            //         'item_price' => $request->item_price,
            //         'delivery_charge' => $request->delivery_charge,
            //         'total_price' => $request->total_price,
            //         'delivery_type' => $request->delivery_type,
            //         'delivery_des' => $request->delivery_des,
            //         'recipient_name' => $request->recipient_name,
            //         'recipient_number' => $request->recipient_number,
            //         'recipient_address' => $request->recipient_address . '-' . $request->flat_no . '-' . $request->road_no,
            //         'status' => 'Pending_Pickup',
            //         'delivery_time' => date('Y-m-d'),
            //         'pick_rider' => $request->pick_rider,
            //     ]
            );
        }

        // $p_delivery = new Delivery;   //Delivery_Id
        // $p_delivery->vendor_id = $selectedDeliveries; 
        // $p_delivery->pick_rider = $request->pick_rider;

        NotificationEvent::dispatch('You Have A New Pickup Delivery', $request->pick_rider, 'rider');
        # send notification to selected rider

       // $p_delivery->save();
        Toastr::success('Rider Assign Successfully', 'Success');
        return redirect()
            ->route('vendor.pending.delivery')
            ->with('success', 'Delivery Added Successfully');
    }

    public function processing_delivery()
    {
        $data['title'] = 'Processing Delivery List';
        $data['deliveries'] = Delivery::where('status', 'Processing')
            ->orderBy('id', 'DESC')
            ->get();
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.vendor.processing_delivery', $data);
    }

    public function processing_pickup_delivery($id)
    {
        $data['title'] = 'Processing Pickup Delivery List';
        $data['delivery'] = Delivery::find($id);
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.vendor.processing_pickup_delivery', $data);
    }

    public function processing_pickup_delivery_store(Request $request, $id)
    {
        $request->validate([
            'drop_rider' => 'required',
        ]);

        $p_delivery = Delivery::find($id);
        $p_delivery->vendor_id = $request->vendor_id;
        $p_delivery->item_name = $request->item_name;
        $p_delivery->qty = $request->qty;
        $p_delivery->item_price = $request->item_price;
        $p_delivery->delivery_charge = $request->delivery_charge;
        $p_delivery->total_price = $request->total_price;
        $p_delivery->delivery_type = $request->delivery_type;
        $p_delivery->delivery_des = $request->delivery_des;
        if ($request->delivery_type == 'cash_on') {
            $p_delivery->delivery_type = 'cash on delivery';
        } else {
            $p_delivery->delivery_type = 'online payment';
        }
        if ($p_delivery->delivery_type == 'delivery_des') {
            $p_delivery->delivery_des = 'inside city';
        } else {
            $p_delivery->delivery_des = 'outside city';
        }
        $p_delivery->recipient_name = $request->recipient_name;
        $p_delivery->recipient_number = $request->recipient_number;
        $p_delivery->recipient_address = $request->recipient_address . '-' . $request->flat_no . '-' . $request->road_no;
        $p_delivery->status = 'Processing';
        $p_delivery->delivery_time = date('Y-m-d');
        $p_delivery->pick_rider = $request->pick_rider;
        $p_delivery->drop_rider = $request->drop_rider;
        NotificationEvent::dispatch('You Have A New Pickup Delivery', $request->drop_rider, 'rider');

        $p_delivery->location = $request->location;
        $p_delivery->save();
        Toastr::success('Drop Rider Assign Successfully', 'Success');

        return redirect()
            ->route('vendor.processing.delivery')
            ->with('success', 'Delivery Added Successfully');
    }



    public function processing_pickup_delivery_storex(Request $request, $id)
    {
        $request->validate([
            'drop_rider' => 'required',
        ]);

        $selectedDeliveries = $request->input('delivery');

        $droprider = Delivery::where('drop_rider',$request->drop_rider)->first();

        foreach ($selectedDeliveries as $deliveryId) {


            // $droprider->update([
            //     'vendor_id' => $deliveryId,
            //     'drop_rider' => $request->drop_rider,
            // ]);

            Delivery::updateOrCreate(
                ['drop_rider' => $request->drop_rider, 'vendor_id' => $deliveryId],
                ['drop_rider' => $request->drop_rider, 'vendor_id' => $deliveryId]
                // Additional fields if needed
            );
        }
        
        NotificationEvent::dispatch('You Have A New Pickup Delivery', $request->drop_rider, 'rider');

        $p_delivery->location = $request->location;
        $p_delivery->save();
        Toastr::success('Drop Rider Assign Successfully', 'Success');

        return redirect()
            ->route('vendor.processing.delivery')
            ->with('success', 'Delivery Added Successfully');
    }

    public function complete_delivery_list()
    {
        $data['title'] = 'Complete Delivery List';
        $data['deliveries'] = Delivery::where('status', 'Completed')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('backend.vendor.complete_delivery_list', $data);
    }

    public function complete_delivery_create($id)
    {
        $data['title'] = 'Complete Delivery';
        $data['delivery'] = Delivery::find($id);
        $data['riders'] = Rider::where('status', 'active')->get();

        return view('backend.vendor.complete_delivery', $data);
    }

    public function complete_delivery_store(Request $request, $id)
    {
        $request->validate([
            'pick_rider' => 'required',
        ]);

        $p_delivery = Delivery::find($id);
        $p_delivery->vendor_id = $request->vendor_id;
        $p_delivery->item_name = $request->item_name;
        $p_delivery->qty = $request->qty;
        $p_delivery->item_price = $request->item_price;
        $p_delivery->delivery_charge = $request->delivery_charge;
        $p_delivery->total_price = $request->total_price;
        $p_delivery->delivery_type = $request->delivery_type;
        $p_delivery->delivery_des = $request->delivery_des;
        if ($request->delivery_type == 'cash_on') {
            $p_delivery->delivery_type = 'cash on delivery';
        } else {
            $p_delivery->delivery_type = 'online payment';
        }
        if ($p_delivery->delivery_type == 'delivery_des') {
            $p_delivery->delivery_des = 'inside city';
        } else {
            $p_delivery->delivery_des = 'outside city';
        }
        $p_delivery->recipient_name = $request->recipient_name;
        $p_delivery->recipient_number = $request->recipient_number;
        $p_delivery->recipient_address = $request->recipient_address . '-' . $request->flat_no . '-' . $request->road_no;
        $p_delivery->delivery_time = date('Y-m-d');
        $p_delivery->pick_rider = $request->pick_rider;
        $p_delivery->drop_rider = $request->drop_rider;
        if ($p_delivery->status == 'Processing') {
            $p_delivery->status = 'Completed';
        } else {
            $p_delivery->status = 'Completed';
        }
        $p_delivery->date_created = Carbon::now('Asia/Dhaka')->format('Y-m-d');
        $p_delivery->save();
        Toastr::success('Delivery Completed Successfully', 'Success');

        return redirect()
            ->route('vendor.complete.delivery')
            ->with('success', 'Delivery Added Successfully');
    }

    public function delivery_by_date_list()
    {
        $data['title'] = 'Date Wise Delivery List';
        $data['deliveries'] = Delivery::orderBy('id', 'desc')->get();

        return view('backend.vendor.delivery_by_date_list', $data);
    }

    public function delivery_by_date()
    {
        $data['title'] = 'Delivery List';
        $data['deliveries'] = Delivery::orderBy('id', 'desc')->get();

        return view('backend.vendor.delivery_by_date', $data);
    }

    public function delivery_by_date_store(Request $request)
    {
        $request->validate([
            'delivery_date' => 'required',
        ]);
        $data['deliveries'] = Delivery::where('date_created', $request->delivery_date)
            ->orderBy('id', 'desc')
            ->get();
            

        // show the all vendors who have delivery on this date
        $data['vendors'] = Delivery::where('date_created', $request->delivery_date)
            ->groupBy('vendor_id')
            ->get();

        $data['total_pending'] = Delivery::where('date_created', $request->delivery_date)
            ->where('status', 'Pending')
            ->count();
        $data['total_pickup'] = Delivery::where('date_created', $request->delivery_date)
            ->where('status', 'Pending_Pickup')
            ->count();
        $data['total_processing'] = Delivery::where('date_created', $request->delivery_date)
            ->where('status', 'Processing')
            ->count();
        $data['total_completed'] = Delivery::where('date_created', $request->delivery_date)
            ->where('status', 'Completed')
            ->count();

        $data['total_pending_amount'] = Delivery::where('date_created', $request->delivery_date)
            ->where('status', 'Pending')
            ->sum('total_price');
        $data['total_pickup_amount'] = Delivery::where('date_created', $request->delivery_date)
            ->where('status', 'Pending_Pickup')
            ->sum('total_price');
        $data['total_processing_amount'] = Delivery::where('date_created', $request->delivery_date)
            ->where('status', 'Processing')
            ->sum('total_price');
        $data['total_completed_amount'] = Delivery::where('date_created', $request->delivery_date)
            ->where('status', 'Completed')
            ->sum('total_price');

        $data['total_amount'] = Delivery::where('date_created', $request->delivery_date)->sum('total_price');
        $data['delivery_charge'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])->sum('delivery_charge');
        $data['payoff'] = $data['total_amount'] - $data['delivery_charge'];

        // // how to get which vendor has how many delivery in a date
        // $data['vendor'] = Delivery::where('date_created', $request->delivery_date)->where('status', 'Completed')->groupBy('vendor_id')->get();
        // dd($data['vendor']);

        $data['delivery_date'] = $request->delivery_date;
        $data['vendors'] = Vendor::get();
        return view('backend.vendor.delivery_by_date_list', $data);
    }

    public function date_to_date()
    {
        $data['title'] = 'Delivery By Date To Date';
        $data['deliveries'] = Delivery::orderBy('id', 'desc')->get();

        return view('backend.vendor.date_to_date', $data);
    }

    public function date_to_date_store(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $data['deliveries'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->orderBy('id', 'desc')
            ->get();
        $data['total_pending'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->where('status', 'Pending')
            ->count();
        $data['total_processing'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->where('status', 'Processing')
            ->count();
        $data['total_completed'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->where('status', 'Completed')
            ->count();
        $data['total_pickup'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->where('status', 'Pending_Pickup')
            ->count();

        $data['total_pending_amount'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->where('status', 'Pending')
            ->sum('total_price');
        $data['total_processing_amount'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->where('status', 'Processing')
            ->sum('total_price');
        $data['total_completed_amount'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->where('status', 'Completed')
            ->sum('total_price');
        $data['total_pickup_amount'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])
            ->where('status', 'Pending_Pickup')
            ->sum('total_price');

        $data['total_amount'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])->sum('total_price');
        $data['delivery_charge'] = Delivery::whereBetween('date_created', [$request->from_date, $request->to_date])->sum('delivery_charge');
        $data['payoff'] = $data['total_amount'] - $data['delivery_charge'];
        $data['from_date'] = $request->from_date;
        $data['to_date'] = $request->to_date;

        return view('backend.vendor.date_by_date_list', $data);
    }

    public function date_to_date_list()
    {
        $data['deliveries'] = Delivery::orderBy('id', 'desc')->get();

        return view('backend.vendor.date_by_date_list', $data);
    }

    // vendor invoice
    public function vendor_invoice($id)
    {
        $data['title'] = 'Invoice';
        $data['delivery'] = Delivery::findOrFail($id);

        return view('backend.vendor.invoice', $data);
    }

    // which vendor has how many delivery in a date show in the invoice
    public function vendor_d2d_invoice($id)
    {
        $data['title'] = 'Invoice';
        $data['delivery'] = Delivery::findOrFail($id);
        $data['deliveries'] = Delivery::where('date_created', $data['delivery']->date_created)
            ->where('vendor_id', $data['delivery']->vendor_id)
            ->where('status', 'Completed')
            ->get();

        return view('backend.vendor.d2d_invoice', $data);
    }



    public function active_vendor()
    {
        $data['title'] = 'Inactive Vendor List';
        $data['vendors'] = Vendor::where('status', 'Inactive')->get();

        return view('backend.vendor.inactive', $data);
    }

    public function active_vendor_store($id)
    {
        $vendor = Vendor::find($id);
        if ($vendor->status == 'Inactive') {
            $vendor->status = 'Active';
        } else {
            $vendor->status = 'Inactive';
        }
        $vendor->save();

        return redirect()
            ->back()
            ->with('success', 'Vendor Activated Successfully');
    }

    public function complete_pickup()
    {
        $data['title'] = 'Complete Pickup';
        $data['deliveries'] = Delivery::where('pick_status', 'Completed')->get();

        return view('backend.vendor.complete_pickup', $data);
    }

    public function hold_deliveries()
    {
        $data['title'] = 'Hold Deliveries';
        $data['deliveries'] = Delivery::where('status', 'Hold')->get();

        return view('backend.vendor.hold_deliveries', $data);
    }

    public function searchRiders(Request $request)
    {
        $searchTerm = $request->input('q');

        $riders = Rider::where('rider_name', 'like', "%$searchTerm%")
            ->get(['id', 'rider_name']);

        return response()->json($riders);
    }
}
