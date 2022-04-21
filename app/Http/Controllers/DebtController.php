<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;
use App\Models\Sale;


class DebtController extends Controller
{
    public function index(){
        // $data['debts'] = Debt::distinct()->select('debt_id')->get();
        $data['debts'] = Debt::all()->sortDesc();
        $data['settings'] = Settings::where('id', '<', 10)->first();
        return view('admin.debts', $data);
    }

    public static function addDebt($data){
        $sqlStatement = 'INSERT INTO debts (debt_id, description, total_debt_before, total_debt_after, amount_paid, debt_type, reg_by, initial_amount)  VALUE ("'.$data['debt_id'].'","'.$data['description'].'","'.$data['total_debt_before'].'","'.$data['total_debt_after'].'","'.$data['amount_paid'].'","'.$data['debt_type'].'","'.$data['reg_by'].'","'.$data['initial_amount'].'")';
        $runInsert = DB::unprepared($sqlStatement);
        return $runInsert;
    }

    public function newDebt(Request $request){
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'initial_amount' => ['required', 'string', 'max:255'],
            'debt_type' => ['required', 'string', 'max:255'],
        ]);

        $this->addDebt(
            [
                'debt_id' => uniqid(),
                'description' => $request->description,
                'initial_amount' => $request->initial_amount,
                'total_debt_before' => $request->initial_amount ,
                'total_debt_after' => $request->initial_amount ,
                'amount_paid' => 0,
                'debt_type' => $request->debt_type,
                'reg_by' => Auth::user()->id
            ]
        );
        return back()->with('success', 'Debt added succesfully.');
    }


    public function updateDebt(Request $request){
        $request->validate([
            'amount' => ['required', 'string', 'max:255'],
            'debt_id' => ['required', 'string', 'max:255']
        ]);
        $lastDebtPaid = Debt::where('debt_id', $request->debt_id)->orderBy('id', 'desc')->first();
        // print_r($lastDebtPaid->total_debt_before);
        if(!isset($lastDebtPaid->total_debt_after)){
            // didnt return valid result
            return back()->with('success', 'Debt ID not found');
        }

        if($lastDebtPaid->total_debt_after < $request->amount){
            // not possible. Debt amount is greater than remaining balance to be paid
            return back()->with('success', 'Amount entered exceeds debt balance. Payment not uaccepted');
        }

        $this->addDebt([
            'debt_id' => $lastDebtPaid->debt_id,
            'description' => $lastDebtPaid->description,
            'initial_amount' => $lastDebtPaid->initial_amount,
            'total_debt_before' => $lastDebtPaid->total_debt_after,
            'total_debt_after' => ($lastDebtPaid->total_debt_after -  $request->amount),
            'amount_paid' => $request->amount,
            'debt_type' => $lastDebtPaid->debt_type,
            'reg_by' => Auth::user()->id
        ]);

        Sale::where(['debt_id' => $request->debt_id])
          ->update([
              'debt_balance' => ($lastDebtPaid->total_debt_after -  $request->amount),
              'is_having_debts' => ($lastDebtPaid->total_debt_after -  $request->amount > 0)
          ]);
        return back()->with('success', 'Debt has been paid succesfully');
        // print_r($request->all());
        die();  

    }

    public function showDebtDetails($debt_id){
        $data['debts'] = Debt::where('debt_id', $debt_id)->get();
        $data['settings'] = Settings::where('id', '<', 10)->first();
        return view('admin.debt-history', $data);
    }
}
