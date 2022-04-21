<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Users insert
        DB::table('users')->insert([
            // 'name' => Str::random(10),
            'username' => 'admin',
            'password' => 'pass',
            'name' => 'John Doe'
        ]);

        // Products insert
        DB::table('products')->insert([
            'name' => 'Product 1',
            'reg_by' => '1',
            'unit_cost' => 1000,
            'supplier_name' => 'Constant supplies Nig. LTD',
            'supplier_phone' => '09042414141',
            'comapnay_name' => '247 Producers Company',
            'company_address' => 'Lafia, Nasarawa state'
        ]);

        // Products insert
        DB::table('products')->insert([
            'name' => 'Product 2',
            'reg_by' => '1',
            'unit_cost' => 2500,
            'supplier_name' => 'Doorstep supplies',
            'supplier_phone' => '08052526253',
            'comapnay_name' => 'Prods beveragies company',
            'company_address' => 'Kubwa, Abuja'
        ]);

        DB::table('settings')->insert([
            'business_name' => 'Inventory',
            'contact_phone' => '080xxxxxxxx',
            'contact_email' => 'contac.inventory@mail.com',
            'receipt_message' => 'Thank you for your patronage. Hope to see you soon',
            'currency' => '&#8358;',
            'low_product_alert' => 50,
            'business_address' => '',
            'primary_color' => '#000'
        ]);
    }
}
