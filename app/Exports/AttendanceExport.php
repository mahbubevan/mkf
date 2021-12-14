<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttendanceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $date; 
    
    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return Attendance::whereDate('created_at',$this->date)->with('employee')->get();
    }
}
