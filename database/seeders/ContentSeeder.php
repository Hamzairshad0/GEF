<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Gallery;
use App\Models\Person;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Seeder;

/**
 * Imports the content crawled from ghazalifoundation.org (database/seeders/data/*.json).
 */
class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $postFiles = [
            'program' => 'programs',
            'department' => 'departments',
            'campaign' => 'campaigns',
            'story' => 'stories',
            'blog' => 'blogs',
        ];

        foreach ($postFiles as $type => $file) {
            foreach ($this->data($file) as $item) {
                Post::updateOrCreate(['type' => $type, 'slug' => $item['slug']], [
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'] ?? null,
                    'body' => $item['body'],
                    'banner' => $item['banner'],
                    'thumb' => $item['thumb'] ?? null,
                    'meta_description' => $item['meta_description'] ?? null,
                    'sort' => $item['sort'] ?? 0,
                    'published_at' => $item['published_at'] ?? now(),
                ]);
            }
        }

        Person::query()->delete();
        foreach (['board' => 'board', 'ambassador' => 'ambassadors'] as $group => $file) {
            foreach ($this->data($file) as $i => $person) {
                Person::create(['group' => $group, 'sort' => $i] + $person);
            }
        }

        Document::query()->delete();
        foreach ($this->data('documents') as $doc) {
            Document::create([
                'type' => $doc['type'],
                'language' => $doc['language'],
                'title' => $doc['title'],
                'file_url' => $doc['file'],
                'cover' => $doc['cover'] ?? null,
                'sort' => $doc['sort'],
            ]);
        }

        Video::query()->delete();
        foreach ($this->data('videos') as $video) {
            Video::create($video);
        }

        Gallery::query()->delete();
        foreach ($this->data('galleries') as $item) {
            $gallery = Gallery::create(['title' => $item['title'], 'event' => $item['event'], 'sort' => $item['sort']]);
            foreach ($item['images'] as $i => $path) {
                $gallery->images()->create(['path' => $path, 'sort' => $i]);
            }
        }
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(database_path("seeders/data/{$file}.json")), true);
    }
}
