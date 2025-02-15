<?php

namespace App\Domain\Translation\Models;

use App\Domain\Translation\Models\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public function translations()
    {
        return $this->hasMany(Translation::class, 'locale', 'code');
    }
}
