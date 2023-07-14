<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfitLoss;

class ProfitLossSeeder extends Seeder
{
    public function run()
    {
        // Array of sample data
        $data = [
            [
                'year' => 2021,
                'revenue' => 10000,
                'expenses' => 7000,
                'customer_name' => 'Customer A',
                'contact_person' => 'John Doe',
                'deal_status' => 'Completed',
            ],
            [
                'year' => 2022,
                'revenue' => 15000,
                'expenses' => 8000,
                'customer_name' => 'Customer B',
                'contact_person' => 'Jane Smith',
                'deal_status' => 'In Progress',
            ],
            [
                'year' => 2023,
                'revenue' => 10000,
                'expenses' => 7000,
                'customer_name' => 'Customer C',
                'contact_person' => 'John',
                'deal_status' => 'Completed',
            ],
            [
                'year' => 2024,
                'revenue' => 15000,
                'expenses' => 8000,
                'customer_name' => 'Customer C',
                'contact_person' => 'Smith',
                'deal_status' => 'In Progress',
            ],
            // Add more sample data as needed
        ];

        // Create records using the sample data for net_profit calculation
        foreach ($data as $item) {
            $item['net_profit'] = $item['revenue'] - $item['expenses'];
            ProfitLoss::create($item);
        }
    }
}
