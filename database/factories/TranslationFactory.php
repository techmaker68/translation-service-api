<?php

namespace Database\Factories;

use App\Domain\Translation\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    protected $model = Translation::class; 

    public function definition()
    {
        return [
            'translation_key' => $this->faker->word,
            'language_id' => 1, 
            'content' => $this->faker->sentence,
            'tags' => $this->faker->word,
        ];
    }
}

