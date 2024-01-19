<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Delivery;
use App\Models\BulkDelivery;
use Illuminate\Http\Request;
use App\Exports\BulkDeliveryExport;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Vendor as ModelsVendor;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    public function Index()
    {
        
        return view('vendor.vendor_login');
    }

    public function VendorDashboard()
    {
        $data['p_deliveries'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Pending')
            ->get();
        $data['processing'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Processing')
            ->get();
        $data['pickup'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Pending_Pickup')
            ->get();
        $data['c_delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Completed')
            ->get();

        return view('vendor.index', $data);
    }

    public function VendorLogin(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('vendor')->attempt(['username' => $check['username'], 'password' => $check['password']])) {
            $user = Vendor::where('username', $check['username'])->first();
            if ($user->status == 'Inactive') {
                Auth::guard('vendor')->logout();
                Toastr::warning('You are not authorized !!', 'Warning');
                return redirect()
                    ->back()
                    ->with('error', 'vendor Login Failed');
            } else {
                Auth::guard('vendor')->login($user);
                Toastr::success('vendor Login Success', 'Success');
                return redirect()
                    ->route('vendor.dashboard')
                    ->with('error', 'vendor Login Success');
            }
        } else {
            Toastr::error('vendor Login Failed', 'Error');
            return redirect()->back();
        }
    }

    public function VendorLogout()
    {
        Auth::guard('vendor')->logout();
        Toastr::success('vendor Logout Success', 'Success');
        return redirect('/');
    }

    public function VendorRegister()
    {
        return view('vendor.vendor_register');
    }

    public function VendorRegisterCreate(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required',
            'username' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $vendor = new Vendor();
        $vendor->vendor_name = $request->vendor_name;
        $vendor->username = $request->username;
        $vendor->mobile = $request->mobile;
        $vendor->email = $request->email;
        $vendor->password = Hash::make($request->password);
        $vendor->status = 'Inactive';
        $vendor->save();

        Toastr::success('vendor Register Success. Waiting for admin approval', 'Success');

        return redirect()->route('vendor_login_form');
    }

    public function pending_pickup_list()
    {
        $data['title'] = 'Pending Pickup';
        $data['d'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Pending_Pickup')
            ->get();

        return view('vendor.pending_pickup', $data);
    }

    public function processing_list()
    {
        $data['title'] = 'Processing';
        $data['d'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Processing')
            ->get();

        return view('vendor.pending_pickup', $data);
    }

    public function completed_list()
    {
        $data['title'] = 'Completed';
        $data['d'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Completed')
            ->get();

        return view('vendor.pending_pickup', $data);
    }

    public function tracking($id)
    {
        $data['title'] = 'Tracking Delivery';
        $data['delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('id', $id)
            ->first();

        return view('vendor.tracking', $data);
    }

    public function update_profile()
    {
        $data['title'] = 'Update Profile';
        $data['vendor'] = Vendor::where('id', Auth::guard('vendor')->user()->id)->first();

        return view('vendor.update_profile', $data);
    }

    public function update_profile_store(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required',
            'owner_name' => 'nullable',
            'username' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'address' => 'required',
            // 'password' => 'required',
        ]);

        $vendor = Vendor::where('id', Auth::guard('vendor')->user()->id)->first();
        $vendor->vendor_name = $request->vendor_name;
        $vendor->owner_name = $request->owner_name;
        $vendor->username = $request->username;
        $vendor->mobile = $request->mobile;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        // $vendor->password = Hash::make($request->password);
        $vendor->status = 'Active';

        if ($request->hasFile('vendor_logo')) {
            $image = $request->file('vendor_logo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/vendor/profile');
            $image->move($destinationPath, $name);
            $vendor->vendor_logo = $name;
        }

        $vendor->save();
        Toastr::success('Profile Update Successfully :)', 'Success');
        return redirect()
            ->route('vendor.dashboard')
            ->with('success', 'Profile Updated Successfully');
    }

    public function forget_password()
    {
        return view('vendor.forget_password');
    }

    public function forget_password_store(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        $vendor = Vendor::where('email', $request->email)->first();
        $r = hexdec(uniqid());
        if ($vendor) {
            $mail_data = [
                'recipient' => $vendor->email,
                'fromEmail' => 'support@fiverzone.com',
                'fromName' => 'Dparcel',

                'fromMessage' => 'Forget Password',
                'link' => 'https://dparcel.fiverzone.com/vendor/reset/password/' . $vendor->id . '/' . $r,
            ];

            Mail::send('vendor.mail_otp', $mail_data, function ($message) use ($mail_data) {
                $message
                    ->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['fromMessage']);
            });
            return redirect()->route('vendor.forget.password.wait');
        }
    }

    public function forget_password_wait()
    {
        return view('vendor.vendor_password_forget_wait');
    }

    public function reset_password($id, $token)
    {
        $data['title'] = 'Reset Password';
        $data['vendor'] = Vendor::where('id', $id)->first();
        $data['token'] = $token;
        return view('vendor.reset_password', $data);
    }

    public function reset_password_store(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $vendor = Vendor::where('id', $id)->first();
        if ($vendor) {
            $vendor->password = Hash::make($request->password);
            $vendor->save();
            return redirect()->route('vendor_login_form');
        }
        Toastr::success('Password Reset Successfully :)', 'Success');
        return redirect()->back();
    }

    public function vendor_sell_report()
    {
        $data['title'] = 'Vendor Sell Report';
        $data['total_delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)->count();
        $data['total_amount'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)->sum('item_price');
        $data['total_pending_amount'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Pending')
            ->sum('item_price');
        $data['total_pending'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Pending')
            ->count();
        $data['total_pending_pickup_delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Pending_Pickup')
            ->count();
        $data['total_pickup_amount'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Pending_Pickup')
            ->sum('item_price');
        $data['total_processing_delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Processing')
            ->count();
        $data['total_processing_amount'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Processing')
            ->sum('item_price');
        $data['total_completed_delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Completed')
            ->count();
        $data['total_complete_amount'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Completed')
            ->sum('item_price');
        $data['total_cancel_delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Cancel')
            ->count();
        $data['total_cancel_amount'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Cancel')
            ->sum('item_price');
        $data['total_return_delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Return')
            ->count();
        $data['total_return_amount'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Return')
            ->sum('item_price');
        $data['delivery'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)->get();

        $data['p_d'] = Delivery::where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', 'Pending')
            ->get();
        foreach ($data['p_d'] as $pd) {
            if ($pd->delivery_type == 'cash on delivery' && $pd->delivery_des == 'outside city') {
                $data['p_m'] = $pd->item_price * 0.01;
                $data['t_a'] = $pd->total_price - $data['p_m'];
            }
        }

        return view('vendor.sell_report', $data);
    }

    public function bulk_delivery()
    {
        return view('vendor.bulk_delivery');
    }

    public function delivery_export()
    {
        return Excel::download(new BulkDeliveryExport(), 'bulkDeliveries.xlsx');
    }

    // public function upload_file(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls,csv|max:2048'
    //     ]);
    //     $b_d = new BulkDelivery();

    //     if ($request->hasFile('file')) {
    //         $fileExl = hexdec(uniqid()) . '.' . $request->file('file')->getClientOriginalExtension();
    //         $b_d['excel_file'] = Storage::putFileAs('bulk/excel',$request->file('file'),$fileExl);
    //     }
    //     // $b_d->excel_file = $file->getClientOriginalName();

    //     $b_d->vendor_id = Auth::guard('vendor')->user()->id;
    //     $b_d->save();

    //     Toastr::success('File Uploaded Successfully :)', 'Success');
    //     return redirect()->route('vendor.dashboard');

    // }

    public function upload_file(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $b_d = new BulkDelivery();

        if ($request->hasFile('file')) {
            $fileExl = hexdec(uniqid()) . '.' . $request->file('file')->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/vendor/profile'); // Specify the desired path

            // Move the uploaded file to the specified path
            $request->file('file')->move($destinationPath, $fileExl);

            $b_d->excel_file = $fileExl;
        }

        $b_d->vendor_id = Auth::guard('vendor')->user()->id;
        $b_d->save();

        Toastr::success('File Uploaded Successfully :)', 'Success');
        return redirect()->route('vendor.dashboard');
    }

    public function user_tracking($id)
    {
        $data['title'] = 'Tracking Delivery';
        $data['delivery'] = Delivery::where('id', $id)->first();
        
        return view('vendor.user_tracking', $data);
    }
}
