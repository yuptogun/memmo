<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Traits\IsConfigurable;
use App\Models\Traits\AttributeSavedAt;

/**
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
    use AttributeSavedAt, IsConfigurable;

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

    public function getIsSharedAttribute(): bool
    {
        return $this->getConfig('is_shared')
            && $this->getConfig('share_code');
    }

    public function getShareCodeAttribute(): ?string
    {
        return $this->is_shared
            ? ($this->getConfig('share_code_alias') ?? $this->getConfig('share_code'))
            : null;
    }

    public function share(?string $alias = null): self
    {
        $this->setConfig('is_shared', '1');

        if (!$this->hasConfig('share_code')) {
            $this->setConfig('share_code', fn () => Str::random(8), self::VALUE_NEW);
        }

        if ((string) $alias !== '') {
            if (!$this->configValueExists('share_code_alias', $alias)) {
                $this->setConfig('share_code_alias', $alias);
            }
        }

        return $this;
    }

    public function unshare(): self
    {
        // keep share_code & share_code_alias
        return $this->unsetConfig('is_shared');
    }

    private function getMemoLines(): array
    {
        return explode("\n", $this->memo);
    }
}
