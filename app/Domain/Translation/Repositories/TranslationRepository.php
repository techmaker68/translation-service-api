<?php

namespace App\Domain\Translation\Repositories;

use App\Domain\Translation\Interfaces\TranslationRepositoryInterface;
use App\Domain\Translation\Models\Translation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class TranslationRepository implements TranslationRepositoryInterface
{
    // initiate the modal instance once

    public function __construct(private Translation $model) {}
    /**
     * Create a new translation.
     */
    public function create(array $data): Translation
    {
        return $this->model->create($data);
    }
    /**
     * Get all records.
     */
    public function getAll()
    {
        return $this->model->paginate(100);
    }

    /**
     * Update an existing translation.
     */
    public function update(int $id, array $data)
    {
        $translation = $this->model->find($id);

        if (!$translation) {
            throw new \Exception("Translation not found for ID: $id");
        }

        $translation->update($data);

        return $translation->refresh();
    }

    /**
     * Find a translation by its ID.
     */
    public function find(int $id): ?Translation
    {
        return $this->model->find($id);
    }

    /**
     * Search translations by filters.
     */
    public function search(string $query): Collection
    {
        return $this->model->where(function ($q) use ($query) {
            $q->where('translation_key', 'like', "%$query%")
                ->orWhere('content', 'like', "%$query%")
                ->orWhereRaw("FIND_IN_SET(?, tags)", [$query]); // Search in comma-separated tags
        })
            ->limit(100)
            ->get();
    }



    /**
     * delete translations.
     */
    public function destroy(int $id)
    {
        return $this->model->find($id)->delete();
    }
    /**
     * Get all translations for export.
     */
    public function export()
    {
        $cacheKey = 'translations_export_json';
        $json = Cache::get($cacheKey);

        if (!is_null($json)) {
            return $json;
        }

        $translations = DB::select('SELECT  translation_key, content, tags FROM translations');
        $json = json_encode($translations);
        Cache::forever($cacheKey, $json);
        return $json;
    }
}
