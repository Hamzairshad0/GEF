<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Person;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Imports the content crawled from ghazalifoundation.org (database/seeders/data/*.json).
 *
 * Uses bulk inserts inside one transaction: a remote database (e.g. Neon) can be
 * hundreds of milliseconds away, and a run either completes fully or not at all.
 */
class ContentSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $stamps = ['created_at' => $now, 'updated_at' => $now];

            $posts = [];
            foreach (['program' => 'programs', 'department' => 'departments', 'campaign' => 'campaigns', 'story' => 'stories', 'blog' => 'blogs'] as $type => $file) {
                foreach ($this->data($file) as $item) {
                    $posts[] = [
                        'type' => $type,
                        'slug' => $item['slug'],
                        'title' => $item['title'],
                        'excerpt' => $item['excerpt'] ?? null,
                        'body' => $item['body'],
                        'banner' => $item['banner'],
                        'thumb' => $item['thumb'] ?? null,
                        'meta_description' => $item['meta_description'] ?? null,
                        'sort' => $item['sort'] ?? 0,
                        'is_published' => true,
                        'published_at' => $item['published_at'] ?? $now,
                    ] + $stamps;
                }
            }
            Post::upsert($posts, ['type', 'slug'], ['title', 'excerpt', 'body', 'banner', 'thumb', 'meta_description', 'sort', 'published_at', 'updated_at']);

            Person::query()->delete();
            $people = [];
            foreach (['board' => 'board', 'ambassador' => 'ambassadors'] as $group => $file) {
                foreach ($this->data($file) as $i => $person) {
                    $people[] = ['group' => $group, 'sort' => $i, 'name' => $person['name'], 'role' => $person['role'], 'photo' => $person['photo']] + $stamps;
                }
            }
            Person::insert($people);

            Document::query()->delete();
            Document::insert(array_map(fn ($doc) => [
                'type' => $doc['type'],
                'language' => $doc['language'],
                'title' => $doc['title'],
                'file_url' => $doc['file'],
                'cover' => $doc['cover'] ?? null,
                'sort' => $doc['sort'],
            ] + $stamps, $this->data('documents')));

            Video::query()->delete();
            Video::insert(array_map(fn ($video) => $video + ['title' => null] + $stamps, $this->data('videos')));

            GalleryImage::query()->delete();
            Gallery::query()->delete();
            $images = [];
            foreach ($this->data('galleries') as $item) {
                $galleryId = Gallery::insertGetId(['title' => $item['title'], 'event' => $item['event'], 'sort' => $item['sort']] + $stamps);
                foreach ($item['images'] as $i => $path) {
                    $images[] = ['gallery_id' => $galleryId, 'path' => $path, 'sort' => $i] + $stamps;
                }
            }
            GalleryImage::insert($images);
        });
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(database_path("seeders/data/{$file}.json")), true);
    }
}
