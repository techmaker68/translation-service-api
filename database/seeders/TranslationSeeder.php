<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory;

class TranslationSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $languageIds = DB::table('languages')->pluck('id')->toArray();
        $tags= ['mobile', 'desktop', 'web'];
        $batchSize = 1000;
        $totalRecords = 100000;
        $data = [];
        $now = Carbon::now();

        for ($i = 1; $i <= $totalRecords; $i++) {
            $data[] = [
                'language_id' => $faker->randomElement($languageIds),
                'translation_key'         => 'key_' . $i,
                'content' => $faker->sentence,
                'tags'     => $faker->randomElement($tags),
                'created_at'  => $now,
                'updated_at'  => $now,
            ];
            
            if (count($data) >= $batchSize) {
                DB::table('translations')->insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('translations')->insert($data);
        }
    }
}