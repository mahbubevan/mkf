<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Attendence For '. Carbon::today()->format('d-m-Y');

        $employees = Employee::where('status',Employee::ACTIVE)->whereHas('attendences',function($q){
            $q->whereDate('created_at',Carbon::today());
            $q->where('attendance','!=',Attendance::PRESENT);
        })->get();

        $attendedEmployee = Employee::where('status',Employee::ACTIVE)->whereHas('attendences',function($q){
            $q->whereDate('created_at',Carbon::today());
            $q->where('attendance',Attendance::PRESENT);
            $q->where('exit',null);
        })->get();

        $todayAttendences = Attendance::whereDate('created_at',Carbon::today())->with('employee')->get();
        
        return view('admin.employee.attendence.create',compact('employees','attendedEmployee','todayAttendences','page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attendece = new Attendance();
        $attendece->employee_id = $request->emp_id;
        $attendece->entry = $request->entry;
        $attendece->remarks = $request->remarks;
        $attendece->save();

        return back();
    }

    public function exit(Request $request)
    {
        $attendece = Attendance::where('employee_id',$request->emp_id)
                                ->whereDate('created_at',Carbon::today())
                                ->first();
        $attendece->exit = $request->exit;
        $attendece->remarks = $request->remarks;
        $attendece->update();

        return back();
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
        //
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
        //
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
