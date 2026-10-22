<?php

/*
| Organisation details shown across the site (header, footer, contact and
| donate pages). Content is taken verbatim from ghazalifoundation.org.
*/

return [
    'name' => 'Ghazali Education Foundation',
    'short_name' => 'GEF',
    'tagline' => 'Education NGO in Pakistan',
    'vision' => 'Better society through value-based education',
    'mission' => 'Dedicated to exploring and strengthening the potential of students through education and training with the active participation of the community.',

    'contact' => [
        'address' => '5-E Samanberg, Johar town, Lahore Pakistan',
        'map_url' => 'https://maps.app.goo.gl/qjn7xnUM53C5UXNx5',
        'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13611.205117391397!2d74.27739236969732!3d31.474652238472547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391903fcbabaaaab%3A0x18e53141324c869c!2sGhazali%20Education%20Foundation!5e0!3m2!1sen!2s!4v1724249261717!5m2!1sen!2s',
        'uan' => '(042) 111 438 438',
        'uan_tel' => '042111438438',
        'mobile' => '+92 333 1213 623',
        'mobile_tel' => '+923331213623',
        'email' => 'info@get.org.pk',
        'csr_email' => 'pdu@get.org.pk',
        'volunteer_email' => 'volunteer@get.org.pk',
        'office_hours' => '9 am to 5 pm, Monday-Friday',
    ],

    'social' => [
        'facebook' => 'https://www.facebook.com/GhazaliEducationFoundation?mibextid=LQQJ4d',
        'instagram' => 'https://www.instagram.com/ghazalieducationfoundation/profilecard/?igsh=MTdjMG9nbXMxOXhvMQ==',
        'linkedin' => 'https://www.linkedin.com/company/ghazali-education-foundation-pakistan/',
        'tiktok' => 'https://www.tiktok.com/@gef_pakistan',
        'x' => 'https://x.com/GEF_Pakistan',
        'youtube' => 'https://www.youtube.com/@GhazaliEduTrust',
    ],

    'bank' => [
        'title' => 'Ghazali Education Foundation',
        'account' => '0206-0100676606',
        'iban' => 'PK 65 MEZN 0002-0601-0067-6606',
        'swift' => 'MEZN PKKAGRD',
        'bank' => 'Meezan Bank, Akbar Chowk, Lahore-Pakistan.',
    ],

    // Options of the donation form found on every page of the original site
    'donation_causes' => [
        'Educate an Orphan',
        'Sponsor a disabled Child',
        'Sponsor an Orphan family',
        'Adopt a School',
        'Start a new School',
        'Sponsor a Residential College Student',
        'Build a Classroom',
        'Sponsor a Hifz e Quran Student',
        'Donate Qurbani',
        'Donate Food',
        'General Donation',
        'Sadqa',
        'Zakat',
        'Winter warm wear & Hygiene Kit',
    ],
    'donation_frequencies' => ['one-time' => 'One-time', 'monthly' => 'Monthly', 'yearly' => 'Yearly'],
    'donation_presets' => [5000, 10000, 25000, 50000],

    'milestones' => [
        ['value' => 850, 'suffix' => '+', 'label' => 'Schools', 'icon' => 'school'],
        ['value' => 125, 'suffix' => 'K', 'label' => 'Students', 'icon' => 'students'],
        ['value' => 45, 'suffix' => '', 'label' => 'Districts', 'icon' => 'map'],
        ['value' => 1600, 'suffix' => '', 'label' => 'Special Child', 'icon' => 'heart'],
        ['value' => 4000, 'suffix' => '', 'label' => 'Orphan', 'icon' => 'hand'],
    ],

    // Stats from the last slide of the original home banner
    'hero_stats' => [
        ['value' => '5000+', 'label' => 'Teachers'],
        ['value' => '125,000+', 'label' => 'Students'],
        ['value' => '850+', 'label' => 'Schools'],
        ['value' => '45+', 'label' => 'Districts'],
    ],

    'schools' => [
        'Punjab' => ['Attock', 'Bahawalpur', 'Bahawalnagar', 'Bhakkar', 'Chakwal', 'Chiniot', 'G.Khan', 'Faisalabad', 'Gujrat', 'Hafizabad', 'Jhang', 'Jhelum', 'Kasur', 'Khanewal', 'Khushab', 'Lahore', 'Layyah', 'Lodhran', 'M.B Din', 'Mianwali', 'Multan', 'Muzaffargarh', 'Nankana Sahib', 'Narowal', 'Pakpattan', 'Rahim Yar Khan', 'Rajanpur', 'Rawalpindi', 'Sahiwal', 'Sargodha', 'Sheikpura', 'Sialkot', 'Toba Tek Singh', 'Vehari'],
        'Sindh' => ['Kashmore', 'Jakababad'],
        'KPK' => ['Mardan', 'Swabi'],
        'Balochistan' => ['Loralai', 'Quetta', 'Zhob', 'Ziarat'],
    ],

    // "GEF school's network" video slider on the home page
    'program_videos' => [
        ['video' => 'https://ghazalifoundation.org/wp-content/uploads/2024/02/y9dcvn.mp4', 'title' => 'Cultivating the leaders of tomorrow', 'text' => 'Ghazali Premier College is state of the art institute that attracts talented students and gives them new horizons of life.'],
        ['video' => 'https://ghazalifoundation.org/wp-content/uploads/2024/02/lvx6it.mp4', 'title' => 'Strength Lies In Differences', 'text' => 'Hindu community schools are providing career path to the children of said community by respecting their religious values.'],
        ['video' => 'https://ghazalifoundation.org/wp-content/uploads/2024/02/fdrhjg.mp4', 'title' => 'Compassion and attention can transform the lives of differently abled children', 'text' => "Rural Inclusive Education Program's resource centers are providing learning facilities to special children under the supervision of dedicated and trained teachers."],
        ['video' => 'https://ghazalifoundation.org/wp-content/uploads/2024/02/0d2spr.mp4', 'title' => 'Little by little, a little becomes a lot', 'text' => 'Sindh is the second largest populated province of Pakistan. GEF stepped forward to provide state of the art educational opportunities to the children of far flung areas of Sindh, where neither government nor private school was operational within the radius of miles.'],
        ['video' => 'https://ghazalifoundation.org/wp-content/uploads/2024/02/wyna19.mp4', 'title' => 'Every Individual matters', 'text' => 'out of school children program is serving the marginalized communities by facilitating them teaching and learning opportunities.'],
    ],

    'volunteer_interests' => ['Social work', 'Leadership', 'Event management', 'Public speaking', 'Workshops & training', 'Content writing', 'Photography', 'Graphic designing'],
];
