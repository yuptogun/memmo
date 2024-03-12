<?php

namespace App\Models;

use Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Database\Eloquent\Builder;

use App\Models\Traits\CachesItself;

/**
 * @property string configurable_type
 * @property int $configurable_id
 * @property string $key
 * @property string $value
 * @method static self|Builder key(string $key)
 * @method static self|Builder value(string $value)
 */
class Config extends Model
{
    use HasFactory;
    use CachesItself;

    public $timestamps = false;

    protected $fillable = ['configurable_type', 'configurable_id', 'key', 'value'];

    public static function boot()
    {
        parent::boot();

        static::saved(fn (self $config) => $config->cacheSelf());
        static::deleted(fn (self $config) => $config->uncacheSelf());
    }

    public function configurable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeKey(Builder $builder, string $key): Builder
    {
        return $builder->where('key', $key);
    }

    public function scopeKeyValue(Builder $builder, string $key, string $value): Builder
    {
        return $builder->key($key)->where('value', $value);
    }

    protected function getSelfCacheKeys(): Generator
    {
        yield fn(self $config) => implode(':', [$config->configurable->getTable(), $config->configurable->getKey(), $config->key]);
    }
}
