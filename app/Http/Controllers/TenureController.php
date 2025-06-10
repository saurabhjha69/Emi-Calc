<?php

namespace App\Http\Controllers;

use App\Models\Tenure;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;

class TenureController extends Controller
{
    public function index(){
        $tenures = Tenure::all();
        return view('tenures.index', compact('tenures'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'months' => 'required|integer|max:360|unique:tenures',
            'is_active' => 'nullable'
        ]);
        // dd($validated);

        if($validated['months'] % 6 != 0){
            return redirect()->route('admin.dashboard')->withErrors(['months','months should be multiple of 6']);
        }

        $newTenure = new Tenure([
            'months' => $validated['months']
        ]);

        if(isset($validated['is_active'])){
            $newTenure->is_active = $request->boolean('is_active');
        }

        $newTenure->save();

        return redirect()->route('tenures.index')->with('success','Tenure Created Successfully!');

    }
    public function edit(Tenure $tenure){
        return view('tenures.edit',compact('tenure'));
    }

    public function update(Request $request, Tenure $tenure){
         $validated = $request->validate([
            'months' => 'required|integer|max:360|unique:tenures,months'. $tenure->id,
            'is_active' => 'nullable'
        ]);

            $tenure->update([
                'months' => $validated['months'],
                'is_active' => $request->boolean('is_active')
            ]);

        return redirect()->route('tenures.index')->with('success', 'Tenure updated Successfully.');



    }
    public function destroy(Tenure $tenure)
    {
        $tenure->delete();
        return redirect()->route('tenures.index')->with('success', 'Tenure deleted Successfully.');
    }
}
