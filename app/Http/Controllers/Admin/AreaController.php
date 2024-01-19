<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Area List";
        $data['areas'] = Area::orderBy('id', 'desc')->get();

        return view('backend.area.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Add New Area";
        $data['divisions'] = Division::orderBy('division_name', 'asc')->get();
        $data['districts'] = District::orderBy('district_name', 'asc')->get();

        return view('backend.area.create', $data);
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
            'division_id' => 'required',
            'district_id' => 'required',
            'area_name' => 'required',
        ]);

        $area = new Area();
        $area->division_id = $request->division_id;
        $area->district_id = $request->district_id;
        $area->area_name = $request->area_name;

        if($request->hasFile('area_image')) {
            $image = $request->file('area_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/area'), $image_name);
            $area->area_image = $image_name;
        }
        
        $area->save();

        return redirect()->route('area.index')->with('success', 'Area Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Edit Area";
        $data['area'] = Area::findOrFail($id);
        $data['divisions'] = Division::orderBy('division_name', 'asc')->get();
        $data['districts'] = District::orderBy('district_name', 'asc')->get();


        return view('backend.area.edit', $data);
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
            'division_id' => 'required',
            'district_id' => 'required',
            'area_name' => 'required',
        ]);

        $area = Area::findOrFail($id);
        $area->division_id = $request->division_id;
        $area->district_id = $request->district_id;
        $area->area_name = $request->area_name;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/area'), $image_name);
            $area->area_image = $image_name;
        }

        if($request->status == 'Active') {
            $area->status = 'Active';
        } else {
            $area->status = 'Inactive';
        }

        $area->save();

        return redirect()->route('area.index')->with('success', 'Area Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('area.index')->with('success', 'Area Deleted Successfully');
    }
}
