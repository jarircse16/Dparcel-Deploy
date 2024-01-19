<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Delivery;
use App\Models\PickDrop;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class RiderController extends Controller
{
    public function login()
    {
        return view('rider.login');
    }

    public function register()
    {
        return view('rider.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'rider_name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $rider = new Rider();
        $rider->rider_name = $request->rider_name;
        $rider->mobile = $request->mobile;
        $rider->email = $request->email;
        $rider->address = $request->address;
        $rider->username = $request->username;
        $rider->password = Hash::make($request->password);
        $rider->status = 'active';

        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $image_name = time().'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('images/rider'), $image_name);
        //     $rider->image = $image_name;
        // }
        $rider->image = 'default.png';

        $rider->save();
        Toastr::success('Rider Created Successfully', 'Success');
        return redirect()->route('rider.login');
    }

    public function loginStore(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('rider')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            Toastr::success('Rider Login Success', 'Success');
            return redirect()->route('rider.dashboard');
        } else {
            Toastr::error('Rider Login Failed', 'Error');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::guard('rider')->logout();
        Toastr::success('Rider Logout Success', 'Success');
        return redirect('/');
    }

    public function dashboard()
    {
        $data['pending_pickups'] = Delivery::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('is_pick', 0)
            ->get();
        $data['pending_drops'] = Delivery::where('drop_rider', Auth::guard('rider')->user()->id)
            ->where('is_drop', 0)
            ->get();
        $data['total_pickups'] = Delivery::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('is_pick', 1)
            ->get();
        $data['total_drops'] = Delivery::where('drop_rider', Auth::guard('rider')->user()->id)
            ->where('is_drop', 1)
            ->get();

        return view('rider.dashboard', $data);

        
    }

    // which pick_rider is assigned to which delivery
    public function pending_pick_delivery()
    {
        $data['title'] = 'Pending Pick Delivery';
        $data['deliveries'] = Delivery::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('is_pick', 0)
            ->latest()
            ->get();

        return view('rider.pending_pickup', $data);
    }

    public function pending_drop_delivery()
    {
        $data['title'] = 'Pending Drop Delivery';
        $data['deliveries'] = Delivery::where('drop_rider', Auth::guard('rider')->user()->id)
            ->where('is_drop', 0)
            ->latest()
            ->get();

        return view('rider.pending_drop', $data);
    }

    

    // approve pick up
    public function approve_pick($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery->is_pick == 0) {
            $delivery->is_pick = 1;
            $delivery->save();
            return redirect()->route('rider.pickup.delivery');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Pickup Already Approved');
        }

        $delivery->save();
        Toastr::success('Pickup Approved Successfully', 'Success');
        return redirect()
            ->back()
            ->with('success', 'Pickup Approved');
    }


    public function bulkApprovePickup(Request $request)
    {
        $deliveryIds = $request->input('delivery');
        //dd($deliveryIds);

        if (!empty($deliveryIds)) {
            // Assuming you have a Delivery model
            $deliveries = Delivery::whereIn('id', $deliveryIds)->get();

            foreach ($deliveries as $delivery) {
                if ($delivery->is_pick == 0) {
                    $delivery->is_pick = 1;
                    $delivery->save();
                }
            }

            Toastr::success('Bulk Pickups Approved Successfully', 'Success');
        } else {
            Toastr::warning('No deliveries selected for approval', 'Warning');
            return redirect()->route('pending.pickup.delivery');
        }

        return redirect()->route('rider.pickup.delivery');
    }


    // approve drop
    public function approve_drop($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery->is_drop == 0) {
            
            $delivery->is_pick = 1; // Logically fixed because cannot drop without picking
            $delivery->is_drop = 1;
            $delivery->save();
            return redirect()->route('rider.drop.delivery');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Drop Already Approved');
        }

        $delivery->save();
        Toastr::success('Drop Approved Successfully', 'Success');
        return redirect()
            ->back()
            ->with('success', 'Drop Approved');
    }


    public function bulkApproveDrop(Request $request)
    {
        $deliveryIds = $request->input('delivery');

        if (!empty($deliveryIds)) {
            // Assuming you have a Delivery model
            $deliveries = Delivery::whereIn('id', $deliveryIds)->get();

            foreach ($deliveries as $delivery) {
                if ($delivery->is_pick == 0) {
                    $delivery->is_pick = 1;
                    $delivery->save();
                }
                if ($delivery->is_drop == 0) {
                    $delivery->is_drop = 1;
                    $delivery->save();
                }
            }

            Toastr::success('Bulk Drops Approved Successfully', 'Success');
        } else {
            Toastr::warning('No deliveries selected for approval', 'Warning');
            return redirect()->route('pending.drop.delivery');
        }

        return redirect()->route('rider.drop.delivery');
    }




    public function decline_pick($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery->is_pick == 0) {
            $delivery->is_pick = 0;
            $delivery->status = 'Pending';
            $delivery->pick_rider = null;
            $delivery->save();
            return redirect()->route('rider.dashboard');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Pickup Already Declined');
        }

        $delivery->save();
        Toastr::success('Pickup Declined Successfully', 'Success');
        return redirect()
            ->back()
            ->with('success', 'Pickup Declined');
    }

    public function decline_drop($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery->is_drop == 0) {
            $delivery->is_drop = 0;
            $delivery->status = 'Pending_Pickup';
            $delivery->drop_rider = null;
            $delivery->save();
            return redirect()->route('rider.dashboard');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Drop Already Declined');
        }

        $delivery->save();
        Toastr::success('Drop Declined Successfully', 'Success');
        return redirect()
            ->back()
            ->with('success', 'Drop Declined');
    }

    public function pick_delivery_list()
    {
        $data['title'] = 'Pick Delivery List';
        $data['deliveries'] = Delivery::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('pick_status', null)
            ->latest()
            ->get();

        return view('rider.pick_delivery', $data);
    }

    public function drop_delivery_list()
    {
        $data['title'] = 'Drop Delivery List';
        $data['deliveries'] = Delivery::where('drop_rider', Auth::guard('rider')->user()->id)
            ->where('is_drop', 1)
            ->latest()
            ->get();

        return view('rider.drop_delivery', $data);
    }

    public function vendor_delivery_details($id)
    {
        $data['title'] = 'Delivery Details';
        $data['delivery'] = Delivery::find($id);

        return view('rider.delivery_details', $data);
    }

    public function update_delivery_details(Request $request, $id)
    {
        $request->validate([
            'pick_status' => 'required',
            'status_description' => 'nullable',
        ]);

        $delivery = Delivery::find($id);

        $name = $delivery->recipient_name;
        $mobile = $delivery->recipient_number;
        
        $delivery->pick_status = $request->pick_status;
        if ($request->pick_status == 'Completed') {
            $delivery->status = 'Pending_Pickup';
            $delivery->status_description = $request->status_description;

            $url = 'https://msg.elitbuzz-bd.com/smsapi';
            $data = [
                'api_key' => 'C200887465786cd3eb63d8.99241342',
                'type' => 'text',
                'contacts' => $mobile,
                'senderid' => '8809601011425',
                'msg' => 'আসসালামু আলাইকুম Dman-Delivery Service, ' . $name . ' আপনার অর্ডার নং ' . $delivery->id . ' এর পিকআপ সম্পন্ন হয়েছে। ধন্যবাদ । ট্র্যাক করুন : http://127.0.0.1:8000/parcel/tracking/' . $delivery->id . ' ',
            ];

            $response = Http::post($url, $data);
            $delivery->save();
        } else {
            $delivery->status = 'Pending';
            $delivery->is_pick = 0;
            $delivery->pick_rider = null;
            $delivery->pick_status = null;
            $delivery->status_description = $request->status_description;
            $delivery->save();
        }
        Toastr::success('Delivery Updated Successfully', 'Success');

        return redirect()->route('rider.dashboard');
    }

    public function drop_delivery_details($id)
    {
        $data['title'] = 'Delivery Details';
        $data['delivery'] = Delivery::find($id);

        return view('rider.drop_delivery_details', $data);
    }

    public function drop_delivery_store(Request $request, $id)
    {
        $request->validate([
            'drop_status' => 'required',
            'status_description' => 'nullable',
        ]);

        $delivery = Delivery::find($id);
        $delivery->drop_status = $request->drop_status;
        if ($request->drop_status == 'Completed') {
            $delivery->status = 'Completed';
            $delivery->status_description = $request->status_description;
            $delivery->date_created = Carbon::now('Asia/Dhaka')->format('Y-m-d');
        } elseif ($request->drop_status == 'Partial') {
            $delivery->status = 'Completed';
            $delivery->status_description = $request->status_description;
        } elseif ($request->drop_status == 'Hold') {
            $delivery->status = 'Hold';
            $delivery->status_description = $request->status_description;
        } else {
            $delivery->status = 'Return';
            $delivery->status_description = $request->status_description;
        }
        $delivery->save();
        Toastr::success('Delivery Updated Successfully', 'Success');
        return redirect()->route('rider.dashboard');
    }

    public function forget_password()
    {
        return view('rider.forget_password');
    }

    public function forget_password_store(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        $rider = Rider::where('email', $request->email)->first();
        $r = hexdec(uniqid());
        if ($rider) {
            $mail_data = [
                'recipient' => $rider->email,
                'fromEmail' => 'support@fiverzone.com',
                'fromName' => 'Dparcel',

                'fromMessage' => 'Forget Password',
                'link' => 'https://dparcel.fiverzone.com/rider/reset/password/' . $rider->id . '/' . $r,
            ];

            Mail::send('rider.mail_otp', $mail_data, function ($message) use ($mail_data) {
                $message
                    ->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['fromMessage']);
            });
            return redirect()->route('rider.forget.password.wait');
        }
    }

    public function forget_password_wait()
    {
        return view('rider.rider_password_forget_wait');
    }

    public function reset_password($id, $token)
    {
        $data['title'] = 'Reset Password';
        $data['rider'] = Rider::where('id', $id)->first();
        $data['token'] = $token;
        return view('rider.reset_password', $data);
    }

    public function reset_password_store(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $rider = Rider::where('id', $id)->first();
        if ($rider) {
            $rider->password = Hash::make($request->password);
            $rider->save();
            return redirect()->route('rider.login');
        }
        return redirect()->back();
    }

    public function complete_pickups()
    {
        $data['title'] = 'Complete Pickups';
        $data['deliveries'] = Delivery::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('pick_status', 'Completed')
            ->get();

        return view('rider.complete_pickups', $data);
    }

    public function pendingPickDrop()
    {
        $data['title'] = 'Pending Pickups';
        $data['pick_drop'] = PickDrop::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('status', 'Pending_Pickup')
            ->get();

        return view('rider.pending_pickups', $data);
    }

    public function processingPickList()
    {
        $data['title'] = 'Processing Pickups';
        $data['pick_drop'] = PickDrop::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('is_pick', 1)
            ->get();

        return view('rider.processing_pickdrops', $data);
    }

    public function pickDropApproved($id)
    {
        $pick_drop = PickDrop::find($id);
        if ($pick_drop->is_pick == 0) {
            $pick_drop->is_pick = 1;
        } else {
            $pick_drop->is_pick = 0;
        }

        $pick_drop->save();
        Toastr::success('Pickup Approved Successfully', 'Success');
        return redirect()->route('processing.pick_drop.list');
    }

    public function proccesingPickDetails($id)
    {
        $data['title'] = 'Pickup Details';
        $data['pick_drop'] = PickDrop::find($id);
        return view('rider.processing_pickdrop', $data);
    }

    public function processingPickStore(Request $request, $id)
    {
        $request->validate([
            'pick_status' => 'required',
        ]);

        $delivery = PickDrop::find($id);
        $delivery->pick_status = $request->pick_status;
        if ($request->pick_status == 'Completed') {
            $delivery->status = 'Processing';
            $delivery->pick_status = 'Completed';
        } else {
            $delivery->status = 'Cancel';
            $delivery->is_pick = 0;
            $delivery->pick_rider = null;
            $delivery->pick_status = null;
        }
        $delivery->save();
        Toastr::success('Delivery Updated Successfully', 'Success');

        return redirect()->route('rider.dashboard');
    }

    public function pickDropDeclined($id)
    {
        $pick_drop = PickDrop::find($id);
        $pick_drop->pick_status = 'Pending_Pickup';
        $pick_drop->save();
        Toastr::success('Pickup Cancelled Successfully', 'Success');
        return redirect()->back();
    }

    // pending_pickdrop list
    public function pending_pickdrop_list()
    {
        $data['title'] = 'Pending PickDrop List';
        $data['pick_drop'] = PickDrop::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('drop_status', 'Pending_Drop')
            ->get();
        return view('rider.pending_pickdrop_list', $data);
    }

    // approve drop pickup
    public function approve_drop_pickup($id)
    {
        $pick_drop = PickDrop::find($id);
        $pick_drop->drop_status = 'Processing';
        $pick_drop->is_drop = 1;
        $pick_drop->save();
        Toastr::success('Pickup Approved Successfully', 'Success');
        return redirect()->back();
    }

    // decline drop pickup
    public function decline_drop_pickup($id)
    {
        $pick_drop = PickDrop::find($id);
        $pick_drop->drop_status = 'Pending_Drop';
        $pick_drop->is_drop = 0;
        $pick_drop->save();
        Toastr::success('Pickup Declined Successfully', 'Success');
        return redirect()->back();
    }

    // processing_pickdrop list
    public function processing_pickdrop_list()
    {
        $data['title'] = 'Processing PickDrop List';
        $data['pick_drop'] = PickDrop::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('drop_status', 'Processing')
            ->get();
        return view('rider.processing_pickdrop_list', $data);
    }

    // processing_pickdrop details
    public function processing_pickdrop_details($id)
    {
        $data['title'] = 'Processing PickDrop Details';
        $data['pick_drop'] = PickDrop::find($id);
        return view('rider.processing_pickdrop_details', $data);
    }

    // processing_pickdrop store
    public function processing_pickdrop_store(Request $request, $id)
    {
        $request->validate([
            'drop_status' => 'required',
        ]);

        $delivery = PickDrop::find($id);
        $delivery->drop_status = $request->drop_status;
        if ($request->drop_status == 'Completed') {
            $delivery->status = 'Completed';
            $delivery->drop_status = 'Completed';
        } else {
            $delivery->status = 'Cancel';
            $delivery->drop_rider = null;
            $delivery->drop_status = null;
        }
        $delivery->save();
        Toastr::success('Delivery Updated Successfully', 'Success');

        return redirect()->route('rider.dashboard');
    }


        // Add this method to handle the search functionality
    public function searchPendingPickup(Request $request)
    {
        $data['title'] = 'Pending Pickup List';

        // Get the currently authenticated rider
        $rider = Auth::guard('rider')->user();

        // Check if the rider has any pending pickups
        if ($rider) {
            // Fetch pickups based on the search query
            $data['deliveries'] = Delivery::where('pick_rider', $rider->id)
                ->where('is_pick', 0)
                ->where(function ($query) use ($request) {
                    $query->where('item_name', 'like', '%' . $request->search . '%')
                        ->orWhere('qty', 'like', '%' . $request->search . '%')
                        ->orWhere('vendor_name', 'like', '%' . $request->search . '%');
                })
                ->latest()
                ->get();
        } else {
            // If the rider is not authenticated or has no pickups, set an empty array
            $data['deliveries'] = [];
        }

        return view('rider.pending_pickup', $data);
    }

    // Modify the existing method name to match the route name
    public function pending_pick_delivery_list()
    {
        $data['title'] = 'Pending Pick Delivery';
        $data['deliveries'] = Delivery::where('pick_rider', Auth::guard('rider')->user()->id)
            ->where('is_pick', 0)
            ->latest()
            ->get();

        return view('rider.pending_pickup', $data);
    }

/*     public function search(Request $request)
    {
        $search = request('search');

$riders = Rider::where('rider_name', 'like', "%$search%")
    ->orWhere('email', 'like', "%$search%")
    ->orWhere('mobile', 'like', "%$search%")
    ->orWhere(function ($query) use ($search) {
        $query->whereExists(function ($subQuery) use ($search) {
            $subQuery->from('pending_pickups')
                ->whereRaw('riders.id = pending_pickups.id')
                ->where('rider_name', 'like', "%$search%");
        })
        ->orWhereExists(function ($subQuery) use ($search) {
            $subQuery->from('pending_drops')
                ->whereRaw('riders.id = pending_drops.id')
                ->where('email', 'like', "%$search%");
        })
        ->orWhereExists(function ($subQuery) use ($search) {
            $subQuery->from('completed_pickups')
                ->whereRaw('riders.id = completed_pickups.id')
                ->where('mobile', 'like', "%$search%");
        })
        ->orWhereExists(function ($subQuery) use ($search) {
            $subQuery->from('completed_drops')
                ->whereRaw('riders.id = completed_drops.id')
                ->where('address', 'like', "%$search%");
        });
    })
    ->get();

    }
 */
public function search(Request $request)
{
    $search = $request->input('search');
    $searchResults = Rider::where('rider_name', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%')
        ->orWhere('mobile', 'like', '%' . $search . '%')
        ->orWhere('address', 'like', '%' . $search . '%')
        ->get();

    return view('rider.search-results', compact('searchResults'));
}

}
