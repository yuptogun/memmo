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
        $lines = $this->getMemoLines();
        return array_shift($lines);
    }

    public function getContentAttribute(): string
    {
        $lines = $this->getMemoLines();
        array_shift($lines);
        return trim(implode("\n", $lines));
    }

    private function getMemoLines(): array
    {
        return explode("\n", $this->memo);
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
