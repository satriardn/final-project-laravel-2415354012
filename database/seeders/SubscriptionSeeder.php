<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $subscriptions = [
            [
                'customer_id' => 1,
                'service_id'  => 1,
                'start_date'  => '2026-01-01',
                'end_date'    => '2027-01-01',
                'status'      => 'active',
            ],
            [
                'customer_id' => 1,
                'service_id'  => 3,
                'start_date'  => '2026-01-01',
                'end_date'    => '2027-01-01',
                'status'      => 'active',
            ],
            [
                'customer_id' => 2,
                'service_id'  => 2,
                'start_date'  => '2026-03-01',
                'end_date'    => '2027-03-01',
                'status'      => 'trial',
            ],
            [
                'customer_id' => 3,
                'service_id'  => 4,
                'start_date'  => '2025-06-01',
                'end_date'    => '2026-06-01',
                'status'      => 'isolir',
            ],
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::create($subscription);
        }
    }
}