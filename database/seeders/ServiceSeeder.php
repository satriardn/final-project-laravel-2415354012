<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'        => 'Shared Hosting Basic',
                'price'       => 50000,
                'description' => 'Paket hosting basic untuk website sederhana',
                'status'      => true,
            ],
            [
                'name'        => 'VPS Starter',
                'price'       => 150000,
                'description' => 'VPS dengan resource minimal untuk project kecil',
                'status'      => true,
            ],
            [
                'name'        => 'Domain .COM',
                'price'       => 175000,
                'description' => 'Registrasi domain .COM untuk 1 tahun',
                'status'      => true,
            ],
            [
                'name'        => 'SSL Premium',
                'price'       => 500000,
                'description' => 'Sertifikat SSL premium untuk keamanan website',
                'status'      => true,
            ],
            [
                'name'        => 'Email Hosting Business',
                'price'       => 100000,
                'description' => 'Email hosting untuk kebutuhan bisnis',
                'status'      => false,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}