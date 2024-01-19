<?php

namespace App\Http\Controllers;

use App\Models\PickDrop;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PickDropController extends Controller
{
    public function index()
    {
        return view('pick_drop');
    }

    public function storePickDrop(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'qty' => 'required',
            'item_price' => 'required',
            'delivery_charge' => 'required',
            'total_price' => 'required',
            // 'delivery_type' => 'required',
            // 'delivery_des' => 'required',
            'pick_name' => 'required',
            'pick_number' => 'required',
            'pick_address' => 'required',
            'drop_name' => 'required',
            'drop_number' => 'required',
            'drop_address' => 'required',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $pick_drop = new PickDrop();
        $pick_drop->item_name = $request->item_name;
        $pick_drop->qty = $request->qty;
        $pick_drop->item_price = $request->item_price;
        $pick_drop->delivery_charge = $request->delivery_charge;
        $pick_drop->total_price = $request->total_price;
        if($request->delivery_type == 'cash_on'){
            $pick_drop->delivery_type = 'cash on delivery';
        }
        else{
            $pick_drop->delivery_type = 'online payment';
        }
        if($pick_drop->delivery_type == 'delivery_des')
        {
            $pick_drop->delivery_des = 'inside city';
        }
        else{
            $pick_drop->delivery_des = 'outside city';
        }
        $pick_drop->pick_name = $request->pick_name;
        $pick_drop->pick_number = $request->pick_number;
        $pick_drop->pick_address = $request->pick_address;
        $pick_drop->drop_name = $request->drop_name;
        $pick_drop->drop_number = $request->drop_number;
        $pick_drop->drop_address = $request->drop_address;
        $pick_drop->status = 'Pending';
        $pick_drop->delivery_time = date('Y-m-d');
        $pick_drop->created_at = Carbon::now();
        $pick_drop->updated_at = Carbon::now();

        if($request->hasFile('product_image')){
            $image = $request->file('product_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move(public_path('uploads/vendor_logo'), $name);
            $pick_drop->product_image = $name;
        }

        // if($request->hasFile('product_image')){
        //     $image = $request->file('product_image');
        //     $image_name = time().rand(1111,9999).'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('uploads/vendor_logo'), $image_name);
        //     $pick_drop->product_image = $name;
        // }

        else{
            $pick_drop->product_image = 'default.png';
        }
        $pick_drop->description = $request->description;

        $pick_drop->save();
      
        return redirect()->back()->with('success', 'Pick Drop Request Sent Successfully');
    }
}

