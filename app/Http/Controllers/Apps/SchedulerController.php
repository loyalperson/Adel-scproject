<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\UsersAssignedRoleDataTable;
use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ScheduledSearch;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SchedulerController extends Controller
{
    public function index()
    {
        return view('pages/apps.scraper.scheduler.index');
    }

    public function schedule(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
            'schedule_times' => 'required|string',
            'frequency' => 'required|string' //<----------- NEEDS TO BE FIXED (VALIDATE TO ONLY DAILY, MONTHLY OR WEEKLY)
        ]);
        
        $user = auth()->user();
        $email = $user->email;
        $customer = Customer::where('email', $email)->first();
        
        $scheduleTimesWithoutCommas = str_replace(',', '', $request->input('schedule_times'));
        
        // If schedule_times has no spaces, manually create an array with that single value
        if (strpos($scheduleTimesWithoutCommas, ' ') === false) {
            $scheduleTimesArray = [$scheduleTimesWithoutCommas];
        } else {
            // Split the schedule_times string by spaces and store it as an array
            $scheduleTimesArray = explode(' ', $scheduleTimesWithoutCommas);
        }

        ScheduledSearch::create([
            'customer_id' => $customer->id,
            'query' => $request->input('query'),
            'schedule_times' => $scheduleTimesArray,
            'frequency' => $request->input('frequency'),
        ]);

        return redirect()->route('scraper.show-schedule')->with('success', 'Scheduled search created successfully.');
    }

    public function show(PermissionsDataTable $dataTable)
    {
        $email = auth()->user()->email;
        $customer = Customer::where('email', $email)->first();
        
        if ($customer) {
            $scheduledSearches = $customer->scheduledSearches;
            return $dataTable->render('pages/apps.scraper.show-schedule.index', compact('scheduledSearches'));
        }
        else return redirect()->route('dashboard')->with('error', 'You are not a customer');
    }

    public function toggleActive($id) {
        $task = ScheduledSearch::findOrFail($id);

        $task->isActive = !$task->isActive;
        $task->save();

        return redirect()->back()->with('status', 'Task status updated successfully!');
    }

    public function destroy($id)
    {
        // Find the scheduled task by its ID
        $task = ScheduledSearch::findOrFail($id);

        // Delete the scheduled task
        $task->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Scheduled task deleted successfully.');
    }
}