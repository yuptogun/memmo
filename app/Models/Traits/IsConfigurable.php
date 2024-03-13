<?php

namespace App\Models\Traits;

use InvalidArgumentException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Contracts\Database\Eloquent\Builder;

use App\Models\Config;

/**
 * every configurable models might know/perform these:
 *
 * @method static Config|Builder configs()
 */
trait IsConfigurable
{
    /** must iterate callback until its return is not being used as value of config of this type */
    protected const VALUE_NEW = 1;

    public function configs(): MorphMany
    {
        return $this->morphMany(Config::class, 'configurable');
    }

    public function hasConfig(string $key): bool
    {
        return $this->configs()->key($key)->exists();
    }

    /**
     * checks if `$value` is used for `$key` of this type, *regardless of ids*
     */
    public function configValueExists(string $key, string $value): bool
    {
        /** @var Model $this */
        return Config::where([
            'configurable_type' => $this->getTable(),
            'key' => $key,
            'value' => (string) $value,
        ])->exists();
    }

    public function getConfig(string $key): ?string
    {
        return Cache::remember(
            $this->getConfigCacheKey($key),
            86400,
            fn () => $this->configs()->key($key)->first()?->value
        );
    }

    /**
     * @param string|callable $value
     */
    public function setConfig(string $key, $value, ?int $options = null): self
    {
        tap(
            $this->getValidValue($value, (int) $options, $key),
            function ($value) use ($key) {
                $this->configs()->updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
                Cache::set($this->getConfigCacheKey($key), $value, 86400);
            }
        );

        return tap($this, fn(Model $model) => $model->touch());
    }

    public function unsetConfig(string $key): self
    {
        $this->configs()->key($key)->delete();
        Cache::forget($this->getConfigCacheKey($key));

        return tap($this, fn(Model $model) => $model->touch());
    }

    protected function getValidValue($value, int $options, string $key): string
    {
        $validator = function () {
            yield self::VALUE_NEW => function ($value, $key) {
                if (!is_callable($value)) {
                    throw new InvalidArgumentException('$value must be a callback that would hopefully return new & unique value');
                }
                do {
                    $v = $value();
                } while (
                    trim((string) $v) === '' || $this->configValueExists($key, $v)
                );
                return $v;
            };
        };

        foreach ($validator() as $option => $callback) {
            if ($options & $option) {
                $value = $callback($value, $key);
            }
        }
        return (string) $value;
    }

    protected function getConfigCacheKey(string $key): string
    {
        /** @var Model $this */
        return sprintf('configs:%s:%d:%s', $this->getTable(), $this->getKey(), $key);
    }
}
