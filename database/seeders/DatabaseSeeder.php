<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@ghazalifoundation.org');
        $password = env('ADMIN_PASSWORD') ?: Str::password(16, symbols: false);

        User::updateOrCreate(['email' => $email], [
            'name' => 'GEF Admin',
            'password' => $password,
            'is_admin' => true,
        ]);

        if (! env('ADMIN_PASSWORD')) {
            $this->command?->warn("Admin login: {$email} / {$password} (set ADMIN_PASSWORD in .env to choose your own)");
        }

        $this->call([
            ContentSeeder::class,
            HeroSlideSeeder::class,
        ]);
    }
}
