<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['gallery_id', 'path', 'sort'])]
class GalleryImage extends Model
{
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
