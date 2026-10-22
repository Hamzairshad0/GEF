<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['eyebrow', 'title', 'subtitle', 'image', 'cta_label', 'cta_url', 'sort', 'is_active'])]
class HeroSlide extends Model
{
    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
