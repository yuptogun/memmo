<?php

namespace App\Models\Traits;

use Illuminate\Support\Carbon;

/**
 * @property-read Carbon saved_at
 * @property-read string saved_around
 */
trait AttributeSavedAt
{
    public function getSavedAtAttribute(): Carbon
    {
        return $this->updated_at ?? $this->created_at;
    }

    protected function getSavedAroundAttribute(): string
    {
        /** @var Carbon $savedAt */
        $savedAt = $this->saved_at;

        return $savedAt->isSameMonth()
            ? $savedAt->diffForHumans()
            : $savedAt->format(
                $savedAt->isSameYear() ? 'n/j H:i' : 'n/j/Y'
            );
    }
}
