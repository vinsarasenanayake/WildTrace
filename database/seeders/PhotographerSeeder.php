<?php

namespace Database\Seeders;

use App\Models\Photographer;
use Illuminate\Database\Seeder;

class PhotographerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photographers = [
            [
                'name' => 'Vinsara Senanayake',
                'profession' => 'Founder & Lead',
                'achievement' => 'NWPY Winner',
                'quote' => "Nature doesn't need a filter, it just needs a witness.",
                'post' => 'Canon Ambassador',
                'image' => 'images/teammember1.jpg',
            ],
            [
                'name' => 'Kavindu Gunawardhane',
                'profession' => 'Wildlife Photographer',
                'achievement' => 'Wild Sri Lanka Winner',
                'quote' => "Every shutter click is a promise to protect what we see.",
                'post' => 'Nat Geo Featured',
                'image' => 'images/teammember2.jpg',
            ],
            [
                'name' => 'Kumara Senanayake',
                'profession' => 'Wildlife Photographer',
                'achievement' => 'AWPC WILD Featured',
                'quote' => "I don't just take pictures; I collect stories of survival.",
                'post' => 'Nikon Ambassador',
                'image' => 'images/teammember3.jpg',
            ],
            [
                'name' => 'Ravi Shanker',
                'profession' => 'Wildlife Photographer',
                'achievement' => 'DJMPC Winner',
                'quote' => "From above, the earth tells a fragile story.",
                'post' => 'BBC Earth Featured',
                'image' => 'images/teammember4.jpg',
            ],
        ];

        foreach ($photographers as $data) {
            Photographer::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
