<?php

namespace App\Domain\Translation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
class Translation extends Model
{
    use HasFactory;

    protected $table = 'translations';

    protected $fillable = [
        'translation_key',
        'language_id',
        'locale',
        'content',
        'tags',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    protected static function booted()
    {
        static::saved(function ($model) {
            Cache::forget('translations_export_json');
        });
        static::deleted(function ($model) {
            Cache::forget('translations_export_json');
        });
    }
}
