<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Apps\CustomersListController;
use App\Http\Controllers\Apps\CustomersDetailsController;
use App\Http\Controllers\Apps\SubmitTicketController;
use App\Http\Controllers\Apps\FavouritesController;
use App\Http\Controllers\Apps\SchedulerController;
use App\Http\Controllers\Apps\TicketsListController;
use App\Http\Controllers\Apps\ScraperController;
use App\Http\Controllers\Apps\CustomerSubscriptionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\UserSettingsController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/subscription', [CustomerSubscriptionController::class, 'index'])->name('subscription');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/scraper', [ScraperController::class, 'index'])->name('scraper.index');
    Route::get('/scraper/scheduler', [SchedulerController::class, 'index'])->name('scraper.scheduler');
    Route::post('/scraper/schedule', [SchedulerController::class, 'schedule'])->name('scraper.schedule');
    Route::get('/scraper/show-schedule', [SchedulerController::class, 'show'])->name('scraper.show-schedule');
    Route::get('/scraper/search', [ScraperController::class, 'search'])->name('scraper.search');
    Route::get('/scraper/history', [ScraperController::class, 'history'])->name('scraper.history');
    Route::get('/scraper/history/details/id/{id}', [ScraperController::class, 'showDetails'])->name('scraper.history.details');

    Route::post('/scraper/show-schedule/id/{id}/toggle-active', [SchedulerController::class, 'toggleActive'])->name('scraper.scheduler.item.toggle-active');

    Route::get('/scraper/history/favourites', [FavouritesController::class, 'index'])->name('scraper.history.favourites');
    Route::post('/scraper/history/favourites/store', [FavouritesController::class, 'store'])->name('scraper.history.favourites.store');
    Route::post('/scraper/history/favourites/remove', [FavouritesController::class, 'remove'])->name('scraper.history.favourites.remove');
    
    Route::delete('/scraper/scheduled-item/{id}', [SchedulerController::class, 'destroy'])->name('scraper.scheduler.destroy');
    Route::post('/scraper/export', [ScraperController::class, 'exportToExcel'])->name('scraper.export');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    Route::get('/user-settings', [UserSettingsController::class, 'index'])->name('user.settings');
    Route::post('/user-settings', [UserSettingsController::class, 'update'])->name('user.settings.update');

    Route::get('/customers/customers-list', [CustomersListController::class, 'index'])->name('customers.customers-list.index');
    Route::get('/customers/customers-details/id/1', [CustomersDetailsController::class, 'index'])->name('customers.customers-details.index');
    Route::get('/customers/customers-details/id/{id}', [CustomersDetailsController::class, 'show'])->name('customers.customers-details.show');

    Route::delete('/customers/{id}',  [CustomersListController::class, 'destroy'])->name('customers.destroy');

    Route::name('tickets.')->group(function () {
        Route::resource('/tickets/tickets-list', TicketsListController::class);
        Route::resource('/tickets/submit-ticket', SubmitTicketController::class);
    });
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

Route::post('/send-ticket', [TicketController::class, 'sendTicket'])->name('send.ticket');

Route::post('/update-quotas', function () {
    // Update config variables
    config(['quotas.quota1' => request('quota1')]);
    config(['quotas.quota2' => request('quota2')]);

    // Save the changes to the config file
    $configPath = base_path('config/quotas.php');
    file_put_contents($configPath, '<?php return ' . var_export(config('quotas'), true) . ';');

    return redirect()->back()->with('success', 'Quotas updated successfully');
})->name('updateQuotas');

require __DIR__ . '/auth.php';
