<?php

namespace App\Http\Controllers;

use App\Models\TransType;
use Illuminate\Http\Request;

class TransTypeController extends Controller
{
    
    public function index()
    {
        $transTypes=TransType::paginate(8);
        return view('admin.transactions.transTypes',compact('transTypes'));
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $transType = TransType::create($request->all());
        return redirect()->route('transTypes.index');
    }

    
    public function show(TransType $transType)
    {
        //$type=TransType::find($transType->id);
        //return 
    }

    
    public function edit(TransType $transType)
    {
        //
    }

    
    public function update(Request $request)
    {
        $transType= TransType::find($request->typeId);
        $transType->type= $request->typeEdit;
        $transType->name= $request->nameEdit;
        $transType->save();
        return redirect()->route('transTypes.index');

    }

    public function destroy(TransType $transType)
    {
        //
    }
}
