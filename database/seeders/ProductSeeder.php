<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Photographer;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['reptiles', 'aquatics', 'mammals', 'butterflies', 'birds', 'amphibians', 'flora'];
        $photographerIds = Photographer::pluck('id')->toArray();
        // If no photographers seed runs before, default to range 1-4 just in case, but we should run photographer seeder first
        if (empty($photographerIds)) {
            $photographerIds = [1, 2, 3, 4];
        }

        $speciesList = [
            1 => ['category' => 'reptiles', 'title' => 'Emerald Green Tree Python', 'desc' => 'Ideally camouflaged in the canopy, this serpent waits in perfect stillness. Its vibrant scales mimic the lush leaves of the tropical rainforest, providing a near-perfect disguise from both predator and prey. A marvel of evolutionary adaptation, it remains coiled for days, embodying the patient rhythm of the deep jungle.'],
            2 => ['category' => 'aquatics', 'title' => 'Clownfish in Anemone', 'desc' => 'A vibrant symbiosis beneath the waves, where life dances in a delicate balance. The clownfish finds refuge among the stinging tentacles, protected by its unique mucosal layer that renders it invisible to the anemone\'s bite. This striking scene captures the intricate relationships that sustain the vast and mysterious ecosystems of the coral reef.'],
            3 => ['category' => 'mammals', 'title' => 'African Lion Monarch', 'desc' => 'The king surveys his golden savannah kingdom with eyes that have seen the rise and fall of countless seasons. His powerful presence commands respect across the endless plains, a symbol of raw power and natural authority. This moment captures the quiet dignity of a predator at peace, overlooking the land that sustains his pride.'],
            4 => ['category' => 'butterflies', 'title' => 'Blue Morpho Flight', 'desc' => 'Iridescent wings flashing through the rainforest, creating a rhythmic pulse of brilliant azure against the emerald shadows. The sudden bursts of color serve as both a dazzling display and a clever defense mechanism against forest predators. This image freezes the ethereal beauty of a creature that seems to be made of pure light and sky.'],
            5 => ['category' => 'birds', 'title' => 'Scarlet Macaw Portrait', 'desc' => 'Vivid colors high in the Amazon canopy announce the presence of these intelligent and social wanderers. Their brilliant plumage is a testament to the sheer diversity of life found within the world\'s most vital carbon sink. Each feather is a brushstroke of nature\'s finest art, reflecting the untamed spirit of the wild tropics.'],
            6 => ['category' => 'amphibians', 'title' => 'Red-Eyed Tree Frog', 'desc' => 'A flash of color in the deep green night, these amphibians are the silent sentinels of the humid lowlands. Their iconic crimson eyes are a startling contrast to their lime-green bodies, serving as a secondary defense that can startle birds and small mammals. Capturing this creature requires immense patience and a deep appreciation for the miniature wonders of the forest floor.'],
            7 => ['category' => 'flora', 'title' => 'Orchid of the Mist', 'desc' => 'Delicate beauty thriving in the cloud forest, where moisture-laden air sustains a hidden garden of exotic flora. These ancient plants have adapted to high-altitude environments, producing blooms that are as complex as they are beautiful. This photograph honors the fragile resilience of mountain ecosystems that are often hidden from the human eye.'],
            8 => ['category' => 'mammals', 'title' => 'Elephant Matriarch', 'desc' => 'Wisdom and strength leading the herd across vast distances in search of water and sustenance. She carries the memories of generations, knowing the hidden paths and ancient wells that ensure the survival of her family. Her massive frame and gentle movements represent the profound emotional depth and social complexity of these magnificent titans.'],
            9 => ['category' => 'birds', 'title' => 'Kingfisher Dive', 'desc' => 'A splash of blue hunting in the river, moving with a speed that defies the human eye\'s ability to track. In a fraction of a second, the bird enters the water and emerges with its prize, a perfect hunter in a world of reflections. This image captures the precise moment where air, water, and predator converge in a display of natural perfection.'],
            10 => ['category' => 'reptiles', 'title' => 'Komodo Dragon Stride', 'desc' => 'An ancient predator walking the earth, a living relic from a time when giant reptiles ruled the islands. Its powerful limbs and flicking tongue are tools of a master hunter, adapted to a harsh and sun-drenched landscape. This photograph captures the primal energy of a creature that bridges the gap between the prehistoric past and our modern world.'],
            11 => ['category' => 'aquatics', 'title' => 'Sea Turtle Glide', 'desc' => 'Graceful navigator of the ocean currents, embarking on a journey that spans entire hemispheres. These ancient mariners have existed for millions of years, witnessing the changing tides of the world\'s great oceans. Their peaceful movements through the blue depths remind us of the vast, quiet wilderness that exists beneath the surface of our planet.'],
            12 => ['category' => 'mammals', 'title' => 'Leopard in Ambush', 'desc' => 'Silent shadow in the dappled light, a master of concealment waiting for the perfect moment to strike. Every muscle is tensed, every sense tuned to the subtle movements of the forest, making it the most elusive of the big cats. This shot preserves the breathtaking tension of a wild encounter where life and death are separated by only a heartbeat.'],
            13 => ['category' => 'butterflies', 'title' => 'Monarch Migration', 'desc' => 'A quiet blizzard of orange wings, millions of butterflies embarking on a multi-generational odyssey across a continent. This incredible feat of navigation and endurance is one of nature\'s most spectacular displays of collective survival. Each individual is a fragile miracle, contributing to a massive movement that has inspired wonder for centuries.'],
            14 => ['category' => 'birds', 'title' => 'Owl in Twilight', 'desc' => 'Silent wings under the moon, a nocturnal hunter emerging from the shadows to claim the night. Its large, soulful eyes are designed to capture the faintest light, making it a master of the darkness. This image evokes the mysterious beauty of the twilight hours, where the world belongs to those who move without a sound.'],
            15 => ['category' => 'flora', 'title' => 'Baobab Silhouette', 'desc' => 'The tree of life against a setting sun, standing as a timeless monument in the arid African landscape. These ancient giants can live for thousands of years, providing shelter and life-giving water to countless species of birds and animals. Their unique shapes reach toward the darkening sky, telling a story of survival in the harshest of environments.'],
            16 => ['category' => 'amphibians', 'title' => 'Dart Frog Warning', 'desc' => 'Small but mighty, a warning in yellow hidden amongst the damp leaves of the jungle floor. Its brilliant hue is a biological signal to all potential predators that a single touch could be fatal. This photograph captures the intense beauty and dangerous power that can be found in even the smallest corner of the wild world.'],
            17 => ['category' => 'mammals', 'title' => 'Giraffe Tower', 'desc' => 'Gentle giants reaching for the sky, their long necks allowing them to feast on the highest branches of the acacia trees. They move across the savannah with a slow, swaying grace that is unlike any other creature on earth. This image celebrates the unique elegance and towering presence of one of nature\'s most distinctive and beloved inhabitants.'],
            18 => ['category' => 'aquatics', 'title' => 'Coral Reef Panorama', 'desc' => 'A bustling metropolis of marine life, where every inch of the reef is filled with activity and color. From the smallest polyp to the largest reef shark, this ecosystem represents the incredible productivity and beauty of our oceans. This photograph is a tribute to the underwater cities that protect our coastlines and provide a home for a quarter of all marine species.'],
        ];

        $options = [
            'frames' => [
                ['size' => '12 x 18 in', 'price' => 50],
                ['size' => '18 x 24 in', 'price' => 80],
                ['size' => '24 x 36 in', 'price' => 120],
                ['size' => '40 x 60 in', 'price' => 200],
            ],

        ];

        // Real world camera settings
        $apertures = ['f/1.4', 'f/1.8', 'f/2.8', 'f/4', 'f/5.6', 'f/8', 'f/11', 'f/16'];
        $shutters = ['1/125s', '1/250s', '1/500s', '1/1000s', '1/2000s', '1/4000s', '1/8000s'];
        $isos = ['100', '200', '400', '800', '1600', '3200', '6400'];
        $focals = ['24mm', '35mm', '50mm', '85mm', '105mm', '200mm', '400mm', '600mm'];

        for ($i = 1; $i <= 18; $i++) {
            $species = $speciesList[$i] ?? [
                'category' => $categories[array_rand($categories)],
                'title' => 'Wild Enigma ' . $i,
                'desc' => 'A mysterious glimpse into the wild.'
            ];

            // Generate unique base price for this product
            $basePrice = rand(50, 150);
            // Round to nearest 5 for cleaner pricing
            $basePrice = ceil($basePrice / 5) * 5;

            $productOptions = [
                'frames' => [
                    ['size' => '12 x 18 in', 'price' => $basePrice],
                    ['size' => '18 x 24 in', 'price' => ceil(($basePrice * 1.5) / 5) * 5],
                    ['size' => '24 x 36 in', 'price' => ceil(($basePrice * 2.0) / 5) * 5],
                    ['size' => '40 x 60 in', 'price' => ceil(($basePrice * 3.5) / 5) * 5],
                ],

            ];

            Product::updateOrCreate(
                ['image_url' => "images/product{$i}.jpg"],
                [
                    'title' => $species['title'],
                    'description' => $species['desc'],
                    'long_description' => "Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.",
                    'price' => $basePrice,
                    'category' => $species['category'],
                    'location' => ['Yala National Park', 'Wilpattu National Park', 'Udawalawe National Park', 'Sinharaja Forest', 'Horton Plains', 'Kumana National Park'][array_rand(['Yala National Park', 'Wilpattu National Park', 'Udawalawe National Park', 'Sinharaja Forest', 'Horton Plains', 'Kumana National Park'])],
                    'photographer_id' => $photographerIds[array_rand($photographerIds)],
                    'aperture' => $apertures[array_rand($apertures)],
                    'shutter_speed' => $shutters[array_rand($shutters)],
                    'iso' => $isos[array_rand($isos)],
                    'focal_length' => $focals[array_rand($focals)],
                    'options' => $productOptions,
                ]
            );
        }
    }
}
