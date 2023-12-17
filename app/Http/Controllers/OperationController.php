<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Role;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations= Operation::paginate(8);
       
        return view('admin.userAndRoles.operation',compact('operations'));
        //return Operation::with('roles')->get();
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $operation= Operation::create($request->all());
        return redirect()->route('operation.index');
    }

    
    public function show(Operation $operation)
    {
        //
    }

    
    public function edit(Operation $operation)
    {
        //
    }

    
    public function update(Request $request, Operation $operation)
    {
        $operation = Operation::find($request->operationId);
        $operation->name = $request->operationEdit;
        $operation->save();
        return redirect()->route('operation.index');
    }

    
    public function destroy(Operation $operation)
    {
        //
    }


    

}
