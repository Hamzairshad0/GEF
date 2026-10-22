<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['group', 'name', 'role', 'photo', 'sort'])]
class Person extends Model
{
    protected $table = 'people';
}
