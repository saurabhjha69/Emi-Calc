<?php

namespace App\Http\Controllers;

use App\Models\EmiRule;
use App\Models\Tenure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmiRuleController extends Controller
{

    public function index()
    {
        $emirules = EmiRule::with('tenure')->get();
        return view('emi_rules.index', compact('emirules'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'min_amount' => 'required|numeric|min:1',
            'max_amount' => 'required|numeric|gt:min_amount',
            'rate_of_interest' => 'required|numeric|min:0|max:30',
            'tenure_id' => 'required|exists:tenures,id',
            'is_active' => 'nullable',
        ]);

        $conflictingRule  = EmiRule::where('tenure_id', $validated['tenure_id'])
            ->where(function ($query) use ($validated) {
                $query->where('min_amount', '<=', $validated['max_amount'])
                    ->where('max_amount', '>=', $validated['min_amount']);
            })
            ->orderByDesc('max_amount')
            ->first();;

            // dd($conflictingRule);

        if ($conflictingRule) {
            $requiredMin = $conflictingRule->max_amount + 1;
            return redirect()->back()->withErrors([
                'min_amount' => "Overlapping range found. Min amount should be greater than or equal to ₹{$requiredMin}.",
            ])->withInput();
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['user_id'] = Auth::id();

        EmiRule::create($validated);

        return redirect()->route('emi_rules.index')->with('success', 'EMI Rule created successfully.');
    }

    public function edit(EmiRule $emi_rule)
    {
        $tenures = Tenure::where('is_active', true)->get();
        return view('emi_rules.edit', compact('tenures', 'emi_rule'));
    }


    public function update(Request $request, EmiRule $emi_rule)
    {
        $validated = $request->validate([
            'min_amount' => 'required|numeric|min:1',
            'max_amount' => 'required|numeric|gt:min_amount',
            'rate_of_interest' => 'required|numeric|min:0|max:30',
            'tenure_id' => 'required|exists:tenures,id',
            'is_active' => 'nullable',
        ]);

        $conflictingRule = EmiRule::where('tenure_id', $validated['tenure_id'])
            ->where('id', '!=', $emi_rule->id)
            ->where(function ($query) use ($validated) {
                $query->where('min_amount', '<=', $validated['max_amount'])
                    ->where('max_amount', '>=', $validated['min_amount']);
            })
            ->orderByDesc('max_amount')
            ->first();

        if ($conflictingRule) {
            $requiredMin = $conflictingRule->max_amount + 1;
            return redirect()->back()->withErrors([
                'min_amount' => "Overlapping range found. Min amount should be greater than or equal to ₹{$requiredMin}.",
            ])->withInput();
        }

        $validated['is_active'] = $request->boolean('is_active');

        $emi_rule->update($validated);
        // dd($emi_rule);

        return redirect()->route('emi_rules.index')->with('success', 'EMI Rule updated successfully.');
    }


    public function destroy(EmiRule $emiRule)
    {
        $emiRule->delete();
        return redirect()->route('emi_rules.index')->with('success', 'EMI Rule deleted successfully.');
    }
}
