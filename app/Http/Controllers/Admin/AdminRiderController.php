<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;


class AdminRiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Rider List";
        $data['riders'] = Rider::orderBy('id', 'desc')->paginate(15);
        
        return view('backend.rider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Add Rider";

        return view('backend.rider.create', $data);
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
        $rider->status = 'Active';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/rider'), $image_name);
            $rider->image = $image_name;
        }
        
        $rider->save();
        Toastr::success('Rider Added Successfully', 'Success');
        return redirect()->route('rider.index')->with('success', 'Rider Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = "Rider Details";
        $data['rider'] = Rider::find($id);

        return view('backend.rider.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Edit Rider";
        $data['rider'] = Rider::find($id);

        return view('backend.rider.edit', $data);
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
            'rider_name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $rider = Rider::find($id);
        $rider->rider_name = $request->rider_name;
        $rider->mobile = $request->mobile;
        $rider->email = $request->email;
        $rider->address = $request->address;
        $rider->username = $request->username;
        $rider->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/rider'), $image_name);
            $rider->image = $image_name;
        }

        if ($request->status == 'Active') {
            $rider->status = 'Active';
        } else {
            $rider->status = 'Inactive';
        }

        $rider->save();
        Toastr::success('Rider Updated Successfully', 'Success');

        return redirect()->route('rider.index')->with('success', 'Rider Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rider = Rider::find($id);
        $rider->delete();
        Toastr::success('Rider Deleted Successfully', 'Success');

        return redirect()->route('rider.index')->with('success', 'Rider Deleted Successfully');
    }
}
