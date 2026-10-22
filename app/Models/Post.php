<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'slug', 'title', 'excerpt', 'body', 'banner', 'thumb', 'meta_description', 'sort', 'is_published', 'published_at'])]
class Post extends Model
{
    /**
     * Each post type keeps the URL prefix used on the original WordPress site,
     * so existing links and search rankings keep working.
     */
    public const TYPES = [
        'program' => ['label' => 'Program', 'plural' => 'Our Programs', 'prefix' => 'our-programs', 'index' => 'programs'],
        'department' => ['label' => 'Department', 'plural' => 'Our Departments', 'prefix' => 'our-departments', 'index' => 'departments'],
        'campaign' => ['label' => 'Cause', 'plural' => 'Causes We Support', 'prefix' => 'our-campaigns', 'index' => 'causes'],
        'story' => ['label' => 'Success Story', 'plural' => 'Stories of Hope', 'prefix' => 'our-achievements', 'index' => 'home'],
        'blog' => ['label' => 'Blog', 'plural' => 'Blogs', 'prefix' => 'blog', 'index' => 'blogs'],
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type)->where('is_published', true)
            ->orderBy('sort')->orderByDesc('published_at');
    }

    public function url(): string
    {
        return url(self::TYPES[$this->type]['prefix'].'/'.$this->slug);
    }

    public function image(): ?string
    {
        return $this->thumb ?: $this->banner;
    }

    public function summary(int $limit = 150): string
    {
        $text = $this->excerpt ?: strip_tags((string) $this->body);

        return str($text)->replace('...', '')->squish()->limit($limit)->toString();
    }

    public function readingTime(): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags((string) $this->body)) / 200));
    }
}
