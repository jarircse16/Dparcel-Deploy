<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use DB;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $data['title'] = "Delivery List";
    //     $data['deliveries'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)->latest()->get();

    //     return view('vendor.pending_delivery', $data);
    // }

    public function index(Request $request)
    {
        $data['title'] = 'Delivery List';

        // Get the currently authenticated vendor
        $vendor = Auth::guard('vendor')->user();
    
        // Start with a query to get deliveries for the vendor
        $query = Delivery::where('vendor_id', $vendor->id);

        //$pick_id = Delivery::all();
       // dd($pick_id);
        //dd($query);
        // Check if a search term is provided
        if ($request->has('search')) {
            $search = $request->input('search');
            //dd($search);
            // Apply search criteria to the query
            $query->where(function ($query) use ($search) {
                $query->Where('recipient_number', 'like', "%$search%");

            })->select();
        
        
        // Fetch the latest delivery
        $latestDelivery = $query->latest()->first();
        // Fetch deliveries
       // $data['deliveries'] = $query->latest()->get();
        //dd($pick_id->vendor_id);
        if($latestDelivery){
            return redirect()->route('vendor.tracking', ['id' => $latestDelivery->id]);
        }
        else
        {
            session()->flash('message', '404 Not Found');
        }

    
        // Check if a search term is provided
        if ($request->has('search')) {
            $search = $request->input('search');
    
            // Apply search criteria to the query
            $query->where(function ($query) use ($search) {
                $query->where('qty', 'like', "%$search%")
                      ->orWhere('item_price', 'like', "%$search%")
                      ->orWhere('delivery_charge', 'like', "%$search%")
                      ->orWhere('recipient_name', 'like', "%$search%")
                      ->orWhere('recipient_number', 'like', "%$search%")
                      ->orWhere('recipient_address', 'like', "%$search%");
            });
        }
    
        // Fetch deliveries
        $data['deliveries'] = $query->latest()->get();
    
        return view('vendor.pending_delivery', $data);

    }
        $data['deliveries'] = $query->latest()->get();
        return view('vendor.pending_delivery', $data);
}

    // Add this method to your DeliveryController
    public function search(Request $request)
    {
        // Retrieve search parameters from the request
        $searchTerm = $request->input('search');
    
        // Perform search logic using the $searchTerm
        $results = Delivery::where('field_to_search', 'like', "%$searchTerm%")->get();
    
        // Return the search results, possibly in a JSON response
        return response()->json(['results' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create New Delivery';

        return view('vendor.delivery_create', $data);
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
            'item_name' => 'required',
            'qty' => 'required',
            'item_price' => 'required',
            'delivery_charge' => 'required',
            'total_price' => 'required',
            // 'delivery_type' => 'required',
            // 'delivery_des' => 'required',
            'recipient_name' => 'required',
            'recipient_number' => 'required',
            'recipient_address' => 'required',
        ]);

        $delivery = new Delivery();
        $delivery->vendor_id = Auth::guard('vendor')->user()->id;
        $delivery->item_name = $request->item_name;
        $delivery->qty = $request->qty;
        $delivery->item_price = $request->item_price;
        $delivery->delivery_charge = $request->delivery_charge;
        $delivery->total_price = $request->total_price;
        if ($request->delivery_type == 'cash_on') {
            $delivery->delivery_type = 'cash on delivery';
        } else {
            $delivery->delivery_type = 'online payment';
        }
        if ($delivery->delivery_type == 'delivery_des') {
            $delivery->delivery_des = 'inside city';
        } else {
            $delivery->delivery_des = 'outside city';
        }
        $delivery->recipient_name = $request->recipient_name;
        $delivery->recipient_number = $request->recipient_number;
        $delivery->recipient_address = $request->recipient_address . '-' . $request->flat_no . '-' . $request->road_no;
        $delivery->status = 'Pending';
        $delivery->delivery_time = date('Y-m-d');
        $delivery->created_at = Carbon::now();
        $delivery->updated_at = Carbon::now();


        // $url = 'https://msg.elitbuzz-bd.com/smsapi';
        // $data = [
        //     "api_key" => "C200887465786cd3eb63d8.99241342",
        //     'type' => 'text',
        //     'contacts' => $request->recipient_number,
        //     'senderid' => '8809601011425',
        //     'msg' => 'Your order has been placed successfully. Your order id is ' . $delivery->id . '. Thank you for your order. DMAN',
        // ];
        
        // $response = Http::post($url, $data);
        
        $delivery->save();

        Toastr::success('Delivery Created Successfully', 'Success');
        return redirect()
            ->route('delivery.index')
            ->with('success', 'Delivery Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 
    }

    public function showDelivery($id)
    {

        
        $delivery = Delivery::find($id);
        //dd($delivery);
        if (!$delivery) {
            abort(404); // or handle the case when the delivery is not found
        }
        return view('vendor.scan-qr-code', ['delivery' => $delivery]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Delivery';
        $data['delivery'] = Delivery::find($id);
        $data['id']=$id;

        return view('vendor.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*     public function update(Request $request, $id)
    {
//dd($id);
       
        // Validate the request data
        $request->validate([
            'qty' => 'required|integer',
            'item_price' => 'required|numeric',
            'delivery_charge' => 'required|numeric',
            'delivery_time' => 'required|date',
            'recipient_name' => 'required',
            'recipient_number' => 'required',
            'recipient_address' => 'required',
        ]);
    
        // Find the delivery record
        $delivery = Delivery::find($id)->first();
        //dd($delivery);
        // Update the delivery record with the validated request data
        $delivery->update([
            'qty' => $request->qty,
            'item_price' => $request->item_price,
            'delivery_charge' => $request->delivery_charge,
            'delivery_time' => $request->delivery_time,
            'recipient_name' => $request->recipient_name,
            'recipient_number' => $request->recipient_number,
            'recipient_address' => $request->flat_no . '-' . $request->road_no . '-' . $request->recipient_address,
        ]);
    
        // Optionally, you can update additional fields manually if needed
        // $delivery->additional_field = $request->additional_field;
    
        // Save the changes
        $delivery->save();
    
        // Redirect to the index page with a success message
        return redirect()->route('delivery.index')
            ->with('success', 'Delivery updated successfully');
    } */
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required',
            'qty' => 'required',
            'item_price' => 'required',
            'delivery_charge' => 'required',
            'total_price' => 'required',
            // 'delivery_type' => 'required',
            // 'delivery_des' => 'required',
            'recipient_name' => 'required',
            'recipient_number' => 'required',
            'recipient_address' => 'required',
        ]);

        $delivery = Delivery::find($id);
        $delivery->vendor_id = Auth::guard('vendor')->user()->id;
        $delivery->item_name = $request->item_name;
        $delivery->qty = $request->qty;
        $delivery->item_price = $request->item_price;
        $delivery->delivery_charge = $request->delivery_charge;
        $delivery->total_price = $request->total_price;
        if ($request->delivery_type == 'cash_on') {
            $delivery->delivery_type = 'cash on delivery';
        } else {
            $delivery->delivery_type = 'online payment';
        }
        if ($delivery->delivery_type == 'delivery_des') {
            $delivery->delivery_des = 'inside city';
        } else {
            $delivery->delivery_des = 'outside city';
        }
        $delivery->recipient_name = $request->recipient_name;
        $delivery->recipient_number = $request->recipient_number;
       // $delivery->recipient_address = $request->flat_no . '-' . $request->road_no . '-' . $request->recipient_address;
        $delivery->recipient_address = $request->recipient_address;
        $delivery->status = 'Pending';
        $delivery->delivery_time = date('Y-m-d');
        $delivery->created_at = Carbon::now();
        $delivery->updated_at = Carbon::now();
        $delivery->save();
        Toastr::success('Delivery Updated Successfully', 'Success');
        return redirect()
            ->route('delivery.index')
            ->with('success', 'Delivery Updated Successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}