<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $page_title = 'Attendence For '. Carbon::now()->format('d-F-Y');
        $employees = Employee::where('status',Employee::ACTIVE)->get();
        
        $ids = Attendance::whereDate('created_at',Carbon::today())->pluck('employee_id')->toArray();
        $notAttended = Employee::whereNotIn('id',$ids)->get();        

        $attendedEmployee = Employee::where('status',Employee::ACTIVE)->whereHas('attendences',function($q){
            $q->whereDate('created_at',Carbon::today());
            $q->where('attendance',Attendance::PRESENT);
            $q->where('exit_time',null);
        })->get();

        $todayAttendences = Attendance::whereDate('created_at',Carbon::today())->with('employee')->get();
        
        return view('admin.employee.attendence.create',compact('employees','attendedEmployee','todayAttendences','page_title','notAttended'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isEmployeeTodayExist = Attendance::where('employee_id',$request->emp_id)->whereDate('created_at',Carbon::today())->first();

        if ($isEmployeeTodayExist) {
            return back()->with('error', 'Already Recorded');
        }


        $attendece = new Attendance();
        $attendece->employee_id = $request->emp_id;
        $attendece->entry = $request->entry;
        $attendece->entry_remarks = $request->remarks;
        $attendece->save();

        return back()->with('success','Attendence Recorded');
    }

    public function exit(Request $request)
    {
        $attendece = Attendance::where('employee_id',$request->emp_id)
                                ->whereDate('created_at',Carbon::today())
                                ->first();
        $attendece->exit_time = $request->exit;
        $attendece->exit_remarks = $request->remarks;
        $attendece->update();

        return back();
    }

    public function absent(Request $request)
    {
        $attendece = new Attendance();
        $attendece->employee_id = $request->emp_id;       
        $attendece->absent_remarks = $request->remarks;
        $attendece->attendance = Attendance::ABSENT;
        $attendece->save();

        return back()->with('success','Attendence Recorded');
    }

    public function report(Request $request)
    {              
        if (!$request->all()) {
            $reports = Attendance::whereMonth('created_at',Carbon::now()->month)            
                                        ->select(DB::raw('DATE(created_at) as date'),DB::raw('id'),DB::raw('employee_id'),
                                        DB::raw('attendance'),
                                        DB::raw('entry'),DB::raw('exit_time'),
                                        DB::raw('entry_remarks'),DB::raw('exit_remarks'),DB::raw('absent_remarks'))
                                        ->with('employee')
                                        ->orderBy('date','desc')
                                        ->get()
                                        ->groupBy('date');

            $page_title = 'Attendence Report Of '. Carbon::now()->format('F-Y');
        }else{                          
            try {
                
                $reports = Attendance::whereMonth('created_at',$request->month)
                                    ->whereYear('created_at',$request->year)
                                    ->select(DB::raw('DATE(created_at) as date'),DB::raw('id'),DB::raw('employee_id'),
                                        DB::raw('attendance'),
                                        DB::raw('entry'),DB::raw('exit_time'),
                                        DB::raw('entry_remarks'),DB::raw('exit_remarks'),DB::raw('absent_remarks'))
                                    ->with('employee')
                                    ->orderBy('date','desc')
                                    ->get()
                                    ->groupBy('date');                                    
            } catch (\Throwable $th) {
                return back()->with('error','Invalid Date');
            }

            $newDate = $request->year.'-'.$request->month;
            
            try {
                $page_title = 'Attendence Report Of '. Carbon::parse($newDate)->format('F-Y');
            } catch (\Throwable $th) {
                return back()->with('error','Invalid Date');
            }
        }

        $years = Attendance::select(DB::raw('YEAR(created_at) as years'))                            
                            ->orderBy('years','asc')                            
                            ->groupBy('years')                            
                            ->pluck('years')->toArray();        

        return view('admin.employee.attendence.report',compact('reports','page_title','years'));
    }

    public function reportDownload($date)
    {   
        return Excel::download(new AttendanceExport($date), "attendance-report-$date.xlsx");
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
