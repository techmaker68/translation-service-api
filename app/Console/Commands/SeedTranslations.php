<?php

namespace App\Console\Commands;

use App\Domain\Translation\Models\Language;
use App\Domain\Translation\Models\Translation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:translations {--count=100000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the translations table with dummy data for scalability testing';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $totalRecords = (int) $this->option('count');
        $batchSize = 1000; // Insert in batches for performance
        $languages = Language::pluck('id', 'code')->toArray(); // Fetch available languages
        $tagsOptions = ['mobile', 'desktop', 'web'];

        if (empty($languages)) {
            $this->error("No languages found. Please seed the languages table first.");
            return 1; // Exit with error code
        }

        $this->info("Seeding {$totalRecords} records...");

        for ($i = 0; $i < $totalRecords; $i += $batchSize) {
            DB::transaction(function () use ($i, $batchSize, $languages, $tagsOptions, $totalRecords) {
                $batch = [];
                for ($j = 0; $j < $batchSize && ($i + $j) < $totalRecords; $j++) {
                    $key = 'key_' . ($i + $j);
                    $locale = array_rand($languages); // Pick a random locale code
                    $languageId = $languages[$locale]; // Get corresponding language_id
                    $content = "This is the translation for {$key} in {$locale}";
                    $tags = $tagsOptions[array_rand($tagsOptions)];

                    $batch[] = [
                        'translation_key' => $key,
                        'language_id'     => $languageId, // Use language_id instead of locale
                        'content'         => $content,
                        'tags'            => $tags,
                        'created_at'      => now(),
                        'updated_at'      => now(),
                    ];
                }
                Translation::insert($batch);
            });

            $this->info("Inserted " . min($i + $batchSize, $totalRecords) . " records...");
        }

        $this->info("Seeding completed.");
        return 0;
    }
}
