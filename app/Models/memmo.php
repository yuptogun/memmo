<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class memmo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'memo'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
