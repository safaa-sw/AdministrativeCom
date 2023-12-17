<?php

namespace App\Http\Controllers;

use App\Models\Importance;
use Illuminate\Http\Request;

class ImportanceController extends Controller
{
   
    public function index()
    {
        $importances=Importance::paginate(8);
        return view('admin.transactions.importances',compact('importances'));
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $importance = Importance::create($request->all());
        return redirect()->route('importances.index');
    }

   
    public function show(Importance $importance)
    {
        //
    }

    
    public function edit(Importance $importance)
    {
        //
    }

    
    public function update(Request $request)
    {
        $importance= Importance::find($request->importanceId);
        $importance->name= $request->nameEdit;
        $importance->save();
        return redirect()->route('importances.index');
    }

    
    public function destroy(Importance $importance)
    {
        //
    }
}
