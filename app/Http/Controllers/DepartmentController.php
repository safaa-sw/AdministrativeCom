<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments= Department::paginate(8);
       
        return view('admin.userAndRoles.department',compact('departments'));
        //return Department::all();
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        
        $department= Department::create($request->all());
        return redirect()->route('department.index');
    }

    
    public function show(Department $department)
    {
        //
    }

    
    public function edit(Department $department)
    {
        //
    }

    
    public function update(Request $request, Department $department)
    {
        $depatrment = Department::find($request->departmentId);
        $depatrment->name = $request->departmentEdit;
        $depatrment->save();
        return redirect()->route('department.index');
    }

   
    public function destroy(Department $department)
    {
        //
    }
}
