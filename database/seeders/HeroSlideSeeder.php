<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

/**
 * Home page hero slides: same messages as the original banner, paired with
 * photography from GEF's own schools. The defaults live in config/ghazali.php.
 */
class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlide::query()->delete();

        $now = now();
        HeroSlide::insert(collect(config('ghazali.hero_slides'))
            ->map(fn ($slide, $i) => $slide + ['sort' => $i, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now])
            ->all());
    }
}
