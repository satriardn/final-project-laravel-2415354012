<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'customer_id' => 'CUST-001',
                'name'        => 'Budi Santoso',
                'email'       => 'budi@example.com',
                'phone'       => '081234567890',
                'address'     => 'Jl. Sudirman No. 1, Jakarta',
                'status'      => true,
            ],
            [
                'customer_id' => 'CUST-002',
                'name'        => 'Siti Rahma',
                'email'       => 'siti@example.com',
                'phone'       => '082345678901',
                'address'     => 'Jl. Gatot Subroto No. 5, Bandung',
                'status'      => true,
            ],
            [
                'customer_id' => 'CUST-003',
                'name'        => 'Andi Wijaya',
                'email'       => 'andi@example.com',
                'phone'       => '083456789012',
                'address'     => 'Jl. Pemuda No. 10, Surabaya',
                'status'      => false,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}