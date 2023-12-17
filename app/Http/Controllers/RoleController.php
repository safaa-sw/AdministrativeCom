<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $roles= Role::paginate(8);
       
        return view('admin.userAndRoles.role',compact('roles'));

       // return Role::with('operations')->get();
    }

    
    public function create()
    {

    }

    
    public function store(Request $request)
    {

        $roles= Role::create($request->all());
        return redirect()->route('roles.index');

       
    }

    
    public function show(Role $role)
    {
        
    }

    
    public function edit(Role $role)
    {
        //
    }

    
    public function update(Request $request, Role $role)
    {
        $roles = Role::find($request->roleId);
        $roles->name = $request->roleEdit;
        $roles->save();
        return redirect()->route('roles.index');

       
    }

    
    public function destroy(Role $role)
    {
        //
    }
}
