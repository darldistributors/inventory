<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ReportController;
use App\Models\Settings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data['settings'] = Settings::where('id', '<', 10)->first();
    return view('loginForm', $data);
});

Route::get('/dashboard', [ReportController::class,'showDashboard'
])->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard', function () {
//     $data['settings'] = Settings::where('id', '<', 10)->first();
//     return view('admin.dashboard', $data);
// })->middleware(['auth'])->name('dashboard');

Route::get('admin/new-staff', function () {
    $data['settings'] = Settings::where('id', '<', 10)->first();
    return view('admin.newStaff', $data);
})->middleware(['auth'])->name('admin.staff.new');

Route::post('/admin/new-staff', [RegisteredUserController::class, 'store'])->name('new.staff')->middleware('auth');

Route::get('admin/manage-staff', [RegisteredUserController::class,'index'
])->middleware(['auth'])->name('admin.staff.manage');

Route::get('admin/product', [ProductController::class,'index'
])->middleware(['auth'])->name('product');

Route::post('admin/product', [ProductController::class, 'store'
])->name('new.product')->middleware('auth');

Route::get('admin/order/new', [OrderController::class,'index'
])->middleware(['auth'])->name('order');

Route::post('admin/order/new', [OrderController::class, 'store'
])->name('new.order')->middleware('auth');

Route::get('admin/order/confirm', [OrderController::class,'confirmOrderPage'
])->middleware(['auth'])->name('order.confirm');

Route::post('admin/order/confirm', [OrderController::class, 'orderConfirmed'
])->name('received.order')->middleware('auth');

Route::get('admin/inventory', [ProductController::class,'inventory'
])->middleware(['auth'])->name('inventory');

Route::post('admin/inventory', [ProductController::class, 'editInventory'
])->name('inventory.edit')->middleware('auth');

Route::get('admin/expenses', [ExpenseController::class,'index'
])->middleware(['auth'])->name('expenses');

Route::post('admin/expenses', [ExpenseController::class,'store'
])->middleware(['auth'])->name('expenses.add');

Route::get('admin/sales/{sales_id?}/{items?}', [SaleController::class,'index'
])->middleware(['auth'])->name('sales');

Route::post('admin/sales', [SaleController::class,'store'
])->middleware(['auth'])->name('sales.new');


Route::get('admin/held-sales/{salesID?}', [SaleController::class,'processHeldReciept'
])->middleware(['auth'])->name('sales.held.receipt.process');

Route::get('admin/settings', [SettingsController::class,'index'
])->middleware(['auth'])->name('settings');

Route::post('admin/settings', [SettingsController::class,'updateSettings'
])->middleware(['auth'])->name('settings.update');

Route::get('admin/debts', [DebtController::class,'index'
])->middleware(['auth'])->name('debts');

Route::post('admin/debts', [DebtController::class,'newDebt'
])->middleware(['auth'])->name('debts.new');

Route::post('admin/debts/update', [DebtController::class,'updateDebt'
])->middleware(['auth'])->name('debts.update');

Route::get('admin/debt/detils/{debt_id?}', [DebtController::class,'showDebtDetails'
])->middleware(['auth'])->name('debts.show.details');

Route::get('admin/reports/{report_type?}', [ReportController::class,'index'
])->middleware(['auth'])->name('reports');

Route::get('admin/print-receipt/{receipt_no?}', [ReportController::class,'printReceipt'
])->middleware(['auth'])->name('print');

Route::get('admin/product/expiring', [ReportController::class,'expiringProducts'
])->middleware(['auth'])->name('expiring');

Route::post('admin/product/delete', [ProductController::class,'deleteProduct'
])->middleware(['auth'])->name('product.delete');


// Route::get('admin/product-category', [CategoryController::class,'index'
// ])->middleware(['auth'])->name('product.category');

// Route::post('/admin/manage-staff', [RegisteredUserController::class, 'show'])->name('manage.staff')->middleware('auth');








Route::get('admin/register-product', function () {
    return view('admin/register-product');
});

Route::get('admin/product/new', function () {
    return view('admin.ProductCategoryForm');
});

Route::get('/admin.productNameForm', function () {
    return view('admin.ProductNameForm');
});

Route::get('/admin.brandNameForm', function () {
    return view('admin.brandNameForm');
});
Route::get('/admin.vendorsForm', function () {
    return view('admin.vendorsForm');
});

Route::get('/admin.customerForm', function () {
    return view('/admin.customerForm');
});
Route::get('/admin.carriageInwardsForm', function () {
    return view('/admin.carriageInwardsForm');
});

Route::get('/admin.carriageOutwardsForm', function () {
    return view('/admin.carriageOutwardsForm');
});

Route::get('/admin.placeOrderForm', function () {
    return view('/admin.placeOrderForm');
});

Route::get('/admin.confirmOrderForm', function () {
    return view('/admin.confirmOrder');
});
Route::get('/admin.recent-Orders', function () {
    return view('/admin.recent-Orders');
});
Route::get('/admin.expensesForm', function () {
    return view('/admin.expensesForm');
});

Route::get('/admin.sellProductForm', function () {
    return view('/admin.sellProductForm');
});

Route::get('/admin.customerList', function () {
    return view('/admin.customerList');
});
Route::get('/admin.recent-Sales', function () {
    return view('/admin.recent-Sales');
});

Route::get('/admin.sales-report', function () {
    return view('/admin.sales-report');
});

Route::get('/admin.purchase-report', function () {
    return view('/admin.purchase-report');
});

Route::get('/admin.inventory-report', function () {
    return view('/admin.inventory-report');
});
Route::get('/admin.customer-report', function () {
    return view('/admin.customer-report');
});
Route::get('/admin.vendors-report', function () {
    return view('/admin.vendors-report');
});

Route::get('/admin.expired-product-report', function () {
    return view('/admin.expired-product-report');
});

Route::get('/admin.carriageInwards-report', function () {
    return view('/admin.carriageInwards-report');
});

Route::get('/admin.carriageOutwards-report', function () {
    return view('/admin.carriageOutwards-report');
});

Route::get('/admin.return-Product-CustomerForm', function () {
    return view('/admin.return-Product-CustomerForm');
});

Route::get('/admin.return-Product-SupplierForm', function () {
    return view('/admin.return-Product-SupplierForm');
});


require __DIR__.'/auth.php';
