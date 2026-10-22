<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

/**
 * Home page hero slides: same messages as the original banner, paired with
 * photography from GEF's own schools.
 */
class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'eyebrow' => 'Ghazali Education Foundation',
                'title' => "Let's Make Pakistan 100% Literate",
                'subtitle' => 'Over 125,000 children in 850+ schools across Pakistan are learning today because of supporters like you.',
                'image' => '/uploads/2024/02/orphan-neddy.jpg',
                'cta_label' => 'Donate Now',
                'cta_url' => '/donate',
            ],
            [
                'eyebrow' => 'Causes We Support',
                'title' => 'Sponsor an Orphan',
                'subtitle' => 'Sponsor an orphan, ignite a future. Your support goes beyond essentials, shaping lives through care and education.',
                'image' => '/uploads/2026/03/activity.jpg-scaled.jpeg',
                'cta_label' => 'Sponsor an Orphan',
                'cta_url' => '/our-campaigns/sponsor-an-orphan',
            ],
            [
                'eyebrow' => 'Causes We Support',
                'title' => "Sponsor a Student's College Education",
                'subtitle' => 'Educate a child, transform a community. Sponsor a Resident Student College and be the change for a brighter tomorrow in Pakistan.',
                'image' => '/uploads/2024/02/compagins-scaled.jpg',
                'cta_label' => 'Sponsor a Student',
                'cta_url' => '/our-campaigns/sponsor-a-students-college-education',
            ],
            [
                'eyebrow' => 'Causes We Support',
                'title' => 'Sponsor a Disabled Child',
                'subtitle' => 'The chance to provide vital support and resources to empower children with disabilities, ensuring they have access to necessary services and opportunities for a brighter future.',
                'image' => '/uploads/2024/02/about-us-bg.jpg',
                'cta_label' => 'Sponsor a Child',
                'cta_url' => '/our-campaigns/sponsor-a-disabled-child',
            ],
            [
                'eyebrow' => 'Causes We Support',
                'title' => 'Adopt a School',
                'subtitle' => 'Adopt a school, nurture a future. Transform lives with education. Your support, their brighter tomorrow.',
                'image' => '/uploads/2024/02/our-departments-bg.jpg',
                'cta_label' => 'Adopt a School',
                'cta_url' => '/our-campaigns/adopt-a-school',
            ],
            [
                'eyebrow' => 'Causes We Support',
                'title' => 'Start a New School',
                'subtitle' => 'Your investment in a Brighter Future. Starting a new school is not just an act of generosity, it is an investment in the future of Pakistan.',
                'image' => '/uploads/2024/02/gettyimages-453013945-scaled-1.jpg',
                'cta_label' => 'Start a School',
                'cta_url' => '/our-campaigns/start-a-new-school',
            ],
        ];

        HeroSlide::query()->delete();
        foreach ($slides as $i => $slide) {
            HeroSlide::create($slide + ['sort' => $i]);
        }
    }
}
