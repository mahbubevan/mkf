<?php

namespace App\Http\Controllers;

use App\Models\SubContract;
use Illuminate\Http\Request;

class SubContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = SubContract::paginate(10);
        return view('admin.subcon.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sc = new SubContract();
        $sc->name = $request->name;
        $sc->buyer_name = $request->buyerName;
        $sc->quantity = $request->quantity;
        $sc->rate = floatval($request->rate);
        $sc->details = $request->details;
        $sc->total_amount = floatval($request->total_amount);
        $sc->save();

        return redirect()->route('admin.subcon.index')->with('success','New SubContract Initialized');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubContract  $subContract
     * @return \Illuminate\Http\Response
     */
    public function show(SubContract $subContract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubContract  $subContract
     * @return \Illuminate\Http\Response
     */
    public function edit(SubContract $subContract)
    {
        return view('admin.subcon.edit',compact('subContract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubContract  $subContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubContract $subContract)
    {        
        $subContract->status = $request->status;
        $subContract->work_status = $request->work_status;
        $subContract->payment_status = $request->payment_status;

        $subContract->update();

        return back()->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubContract  $subContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubContract $subContract)
    {        
        $subContract->delete();
        return back()->with('success','Deleted Successfully');
    }
}
