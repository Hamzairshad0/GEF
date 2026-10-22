<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'language', 'title', 'file_url', 'cover', 'sort'])]
class Document extends Model
{
    /** Pulls a year out of titles like "22-23 ANNUAL REPORTS" or "July 2024". */
    public function year(): ?string
    {
        if (preg_match('/(19|20)\d{2}/', $this->title, $m)) {
            return $m[0];
        }

        return preg_match('/^(\d{2})-(\d{2})/', $this->title, $m) ? '20'.$m[1].'–'.$m[2] : null;
    }

    public function label(): string
    {
        return str($this->title)->replace(['ANNUAL REPORTS', 'AUDIT REPORTS'], '')->squish()->title()->toString();
    }
}
