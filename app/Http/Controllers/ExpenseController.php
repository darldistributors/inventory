<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;

class ExpenseController extends Controller
{
    public function index(){
        $data['expenses'] = Expense::all();
        $data['settings'] = Settings::where('id', '<', 10)->first();
        return view('admin.expensesForm', $data);
    }

    
    public function store(Request $request){
        $request->validate([
            'date' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'string', 'max:255'],
            'incured_by' => ['required', 'string', 'max:255']
        ]);

        Expense::create([
            'date' => date('Y-m-d', strtotime($request->date)),
            'amount' => $request->amount,
            'comment' => $request->description,
            'reg_by' => Auth::user()->id,
            'incured_by' => $request->incured_by
        ]);

        return back()->with('success', 'Expense added successfully.');
    }

}
