<?php

namespace App\Http\Controllers;

use App\Models\EmiRule;
use App\Models\Tenure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmiController extends Controller
{
    public function form()
    {
        $tenures = Tenure::all();
        return view('emi.form',compact('tenures'));
    }

    public function calculate(Request $request)
{
    $validated = $request->validate([
        'principal_amount' => 'required|numeric|min:10000',
        'tenure_id' => 'required|exists:tenures,id',
    ]);

    // dd($validated);

    $P = $validated['principal_amount'];


    $tenure = Tenure::find($validated['tenure_id']);
    if (!$tenure) {
        return back()->withErrors(['tenure_id' => 'Invalid Tenure Selected.']);
    }
    $N = $tenure->months;

    $emi_rule = EmiRule::where('is_active', true)
        ->where('min_amount', '<=', $P)
        ->where('max_amount', '>=', $P)
        ->where('tenure_id', $tenure->id)
        ->first();

        // dd($emi_rule);
    if (!$emi_rule) {
        return back()->withErrors(['principal_amount' => 'No EMI Rule found for given amount and tenure.']);
    }

    $R = $emi_rule->rate_of_interest / 12 / 100;

    $emi = $R > 0
        ? ($P * $R * pow(1 + $R, $N)) / (pow(1 + $R, $N) - 1)
        : $P / $N;

    $total_payment = $emi * $N;
    $interest_payable = $total_payment - $P;

    return redirect()->route('emi.form')->with('result', [
        'emi' => round($emi, 2),
        'interest' => round($interest_payable, 2),
        'total' => round($total_payment, 2),
        'rate' => $emi_rule->rate_of_interest,
        'year' => round($N/12),
        'pamount' => $P
    ]);
}

}
