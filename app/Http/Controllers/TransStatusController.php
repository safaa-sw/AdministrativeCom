<?php

namespace App\Http\Controllers;

use App\Models\TransStatus;
use Illuminate\Http\Request;

class TransStatusController extends Controller
{
   
    public function index()
    {
        $statuses=TransStatus::paginate(8);
        return view('admin.transactions.transStatus',compact('statuses'));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $transStatus = TransStatus::create($request->all());
        return redirect()->route('transStatus.index');
    }

   
    public function show(TransStatus $transStatus)
    {
        //
    }

    
    public function edit(TransStatus $transStatus)
    {
        //
    }

   
    public function update(Request $request)
    {
        $transStatus= TransStatus::find($request->statusId);
        $transStatus->status= $request->statusEdit;
        $transStatus->save();
        return redirect()->route('transStatus.index');
    }

    
    public function destroy(TransStatus $transStatus)
    {
        //
    }
}
