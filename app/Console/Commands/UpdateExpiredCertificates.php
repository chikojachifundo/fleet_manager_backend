<?php

namespace App\Console\Commands;

use App\Models\VehicleCertificate;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateExpiredCertificates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-expired-certificates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark expired certificates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $updated = VehicleCertificate::where('status', '!=', 'expired')
            ->whereDate('expiry_date', '<', $today)
            ->update(['status' => 'expired']);

        $this->info("Updated {$updated} expired certificates");
    }
}
