<?php

namespace App\Models;

use Generator;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Traits\HasSavedAt;
use App\Models\Traits\CachesItself;
use App\Models\Traits\IsConfigurable;

/**
 * @property-read int id
 * @property string $memo
 * @property null|Carbon $updated_at
 * @property-read string title
 * @property-read string timestamp
 * @property-read bool is_shared
 * @property-read null|string share_code
 */
class Memmo extends Model
{
    use HasFactory, SoftDeletes;
    use HasSavedAt, CachesItself, IsConfigurable;

    protected $fillable = ['user_id', 'memo'];

    public static function boot()
    {
        parent::boot();

        static::saved(fn (self $memmo) => $memmo->cacheSelf());
        static::deleted(fn (self $memmo) => $memmo->uncacheSelf());
    }

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

    public function getIsSharedAttribute(): bool
    {
        return $this->getConfig('is_shared', '0')
            && $this->getConfig('share_code');
    }

    public function getShareCodeAttribute(): ?string
    {
        return $this->getConfig('share_code');
    }

    public function share(): self
    {
        if (!$this->hasConfig('share_code')) {
            $this->setConfig('share_code', fn () => Str::random(8), self::VALUE_NEW);
        }
        return $this->setConfig('is_shared', '1');
    }

    public function unshare(): self
    {
        return $this->unsetConfig('is_shared');
    }

    protected function getSelfCacheKeys(): Generator
    {
        yield fn(self $memmo) => "id:" . $memmo->getKey();

        $shareCode = $this->getConfig('share_code');
        if ($shareCode) {
            yield fn(self $memmo) => "share_code:$shareCode";
        }
    }

    private function getMemoLines(): array
    {
        return explode("\n", $this->memo);
    }
}
