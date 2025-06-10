<?php

namespace App\Http\Controllers;

use App\Models\Tenure;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $tenures = Tenure::where('is_active', true)->get();
        return view('admin.dashboard', compact('tenures'));
    }
}
