<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Milestone::create([
            'year' => '2018',
            'title' => 'The Beginning',
            'description' => 'Founded by lead photographer Vinsara with a humble exhibition in Colombo, showcasing the untamed beauty of the island.',
        ]);

        \App\Models\Milestone::create([
            'year' => '2020',
            'title' => 'Global Recognition',
            'description' => 'Featured in National Geographic\'s "Best of Wildlife" series for documenting the endangered Snow Leopard.',
        ]);

        \App\Models\Milestone::create([
            'year' => '2023',
            'title' => 'Trace Foundation',
            'description' => 'Launched our conservation arm, dedicating 10% of all profits to wildlife protection units across Sri Lanka.',
        ]);
    }
}
