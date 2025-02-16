<?php

namespace App\Domain\Translation\Repositories;

use App\Domain\Translation\Interfaces\TranslationRepositoryInterface;
use App\Domain\Translation\Models\Translation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TranslationRepository implements TranslationRepositoryInterface
{
    // initiate the modal instance once
    private function modalInstance()
    {
        return new Translation();
    }
    /**
     * Create a new translation.
     */
    public function create(array $data): Translation
    {
        return $this->modalInstance()->create($data);
    }
    /**
     * Get all records.
     */
    public function getAll()
    {
        return $this->modalInstance()->paginate(100);
    }

    /**
     * Update an existing translation.
     */
    public function update(int $id, array $data)
    {
        $translation = $this->modalInstance()->find($id);

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
        return $this->modalInstance()->find($id);
    }

    /**
     * Search translations by filters.
     */
    public function search(string $query): Collection
    {
        return $this->modalInstance()
            ->where(function ($q) use ($query) {
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
        return $this->modalInstance()->find($id)->delete();
    }
    /**
     * Get all translations for export.
     */
    public function export()
    {

        return DB::table('translations')
        ->select(['id', 'translation_key', 'language_id', 'content', 'tags'])
        ->get()
        ->chunk(10000);
    }
}
