<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'city', 'institution', 'interests', 'message', 'read_at'])]
class VolunteerApplication extends Model
{
    protected function casts(): array
    {
        return ['interests' => 'array', 'read_at' => 'datetime'];
    }
}
