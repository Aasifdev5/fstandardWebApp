<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Equipment;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Daily check for inspection reminders and critical alerts
        $schedule->call(function () {
            $equipments = Equipment::with('inspections', 'client')->get();

            foreach ($equipments as $equipment) {
                $lastInspection = $equipment->inspections()->latest()->first();
                if (!$lastInspection) continue;

                $nextInspection = $lastInspection->inspected_at->addMonths(6);
                $isCritical = $lastInspection->status === 'critical';

                // Send reminder if next inspection is within 30 days
                if (!$isCritical && $nextInspection->isFuture() && $nextInspection->diffInDays(now()) <= 30) {
                    $equipment->notifyClient('reminder');
                    Log::info("Reminder email sent for equipment {$equipment->code} on {$nextInspection}");
                }

                // Send alert if status is critical
                if ($isCritical) {
                    $equipment->notifyClient('critical');
                    Log::info("Critical alert email sent for equipment {$equipment->code}");
                }
            }
        })->dailyAt('08:00'); // Run every day at 8 AM
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
