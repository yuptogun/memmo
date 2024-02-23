<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $memo
 * @property null|Carbon $updated_at
 * @property-read string title
 * @property-read string timestamp
 */
class Memmo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'memo'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTitleAttribute(): string
    {
        return explode("\n", $this->memo)[0];
    }

    public function getContentAttribute(): string
    {
        return preg_replace('/^' . $this->title . '\n+/', '', $this->memo);
    }

    public function getTimestampAttribute(): string
    {
        /** @var Carbon $timestamp */
        $timestamp = $this->updated_at ?? $this->created_at;

        return $timestamp->isSameMonth()
            ? $timestamp->diffForHumans()
            : $timestamp->format(
                $timestamp->isSameYear() ? 'n/j H:i' : 'n/j/Y'
            );
    }
}
