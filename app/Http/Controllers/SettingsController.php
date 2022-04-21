<?php

namespace App\Http\Controllers;
use App\Models\Settings;


use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        $data['settings'] = Settings::where('id', '<', 10)->first();
        // $data['business_name'] = 'Darl';
        // $data['primary_color'] = 'Darl';
        // $data['contact_phone'] = '09031514346';
        // $data['contact_email'] = 'darl.distributors@gmail.com';
        // $data['receipt_message'] = 'Thank you for patronizing us. We wish to see you next time. COntact us on {--contact_phone--} or {--contact_email--}';
        // $data['currency'] = 'NGN';
        // $data['low_product_alert'] = 50;
        // $data['business_address'] = 'New Karu Abuja';

        return view('admin.settings-page', $data); 
    }

    public function updateSettings(Request $request){

        $request->validate([
            'business_name' => ['required'],
            'contact_phone' => ['required'],
            'contact_email' => ['required'],
            'receipt_message' => ['required'],
            'currency' => ['required'],
            'low_product_alert' => ['required'],
            'primary_color' => ['required', 'string', 'max:7'],
        ]);

        Settings::where('id', '<', '10')
          ->update([
            'business_name' => $request->business_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'receipt_message' => $request->receipt_message,
            'currency' => $request->currency,
            'low_product_alert' => $request->low_product_alert,
            'business_address' => $request->business_address ?? '-',
            'primary_color' => $request->primary_color
            ]);

        return back()->with('success', 'Business setting updated successfully');
    }
}
