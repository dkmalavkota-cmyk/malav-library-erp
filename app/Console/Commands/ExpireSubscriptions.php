<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    protected $signature = 'subscriptions:expire';

    protected $description = 'Mark expired trial and active subscriptions as expired';

    public function handle(): int
    {
        $count = Subscription::query()
            ->whereIn('status', ['trial', 'active'])
            ->whereDate('ends_at', '<', now()->startOfDay())
            ->update([
                'status' => 'expired',
                'updated_at' => now(),
            ]);

        $this->info("Expired subscriptions updated: {$count}");

        return self::SUCCESS;
    }
}