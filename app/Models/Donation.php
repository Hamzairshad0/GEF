<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'cause', 'frequency', 'amount', 'status'])]
class Donation extends Model
{
    public const STATUSES = ['pledged', 'contacted', 'received', 'cancelled'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2'];
    }
}
