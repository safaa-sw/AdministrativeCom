<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use Illuminate\Http\Request;

class SecretController extends Controller
{
    
    public function index()
    {
        $secrets=Secret::paginate(8);
        return view('admin.transactions.secrets',compact('secrets'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $secret = Secret::create($request->all());
        return redirect()->route('secrets.index');
    }

    public function show(Secret $secret)
    {
        //
    }

   
    public function edit(Secret $secret)
    {
        //
    }

    
    public function update(Request $request)
    {
        $secret= Secret::find($request->secretId);
        $secret->name= $request->nameEdit;
        $secret->save();
        return redirect()->route('secrets.index');
    }

   
    public function destroy(Secret $secret)
    {
        //
    }
}
