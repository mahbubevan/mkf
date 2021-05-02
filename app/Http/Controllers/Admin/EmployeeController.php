<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeController extends Controller
{
    public function list()
    {
        $data['page_title'] = 'Employee Record';
        $data['employees'] = Employee::latest()->paginate(20);

        return view('admin.employee.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Employee Create';

        return view('admin.employee.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
            'salary' => 'required|numeric',
            'hire_date' => 'required|date|date_format:m/d/Y',
            'image' => 'required|image',
            'nid' => 'required|image',
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->designation = $request->designation;
        $employee->img = uploadImage($request->image, 'img/employee/profile');
        $employee->nid = uploadImage($request->nid, 'img/employee/nid');
        $employee->salary = $request->salary;
        $employee->hire_date = Carbon::parse($request->hire_date)->format('Y-m-d');
        $employee->type = $request->type;
        $employee->save();

        return back()->with('success', 'Employee Created Successfully');
    }

    public function show(Employee $employee)
    {
        $data['page_title'] = 'Employee Details Of - ' . $employee->name;

        return view('admin.employee.show', $data, compact('employee'));
    }

    public function destroy(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        $employee->delete();
        return back()->with('success', 'Employee Deleted Successfully');
    }

    public function salary_update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'salary' => 'required|numeric'
        ]);

        $employee->salary = $request->salary;
        $employee->update();

        return back()->with('success', 'Employee Salary Updated Successfully');
    }

    public function type_update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'type' => 'required'
        ]);

        $employee->type = $request->type;
        $employee->update();

        return back()->with('success', 'Employee Type Updated Successfully');
    }

    public function status_update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);

        $employee->status = $request->status;
        $employee->update();

        return back()->with('success', 'Employee Status Updated Successfully');
    }
}
