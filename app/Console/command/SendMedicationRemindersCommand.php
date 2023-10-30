<?php

namespace App\Console\Commands;

use App\Models\Medication;
use Illuminate\Console\Command;

class SendMedicationRemindersCommand extends Command
{
    protected $signature = 'send:medication-reminders';

    protected $description = 'Send medication reminders to patients.';

    public function handle()
    {
        $medicationReminders = Medication::where('reminder_time', '<=', now())->get();

        foreach ($medicationReminders as $medicationReminder) {
            return "medication reminder";
        }
    }
}
 