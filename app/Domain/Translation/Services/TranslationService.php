<?php

namespace App\Domain\Translation\Services;

use App\Domain\Translation\Interfaces\TranslationServiceInterface;
use App\Domain\Translation\Models\Language;
use App\Domain\Translation\Models\Translation;
use App\Domain\Translation\Repositories\TranslationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TranslationService implements TranslationServiceInterface
{
    protected TranslationRepository $repository;

    public function __construct(TranslationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Create a new translation.
     */
    public function createTranslation(array $data): Translation
    {
        $language = Language::where('id', $data['language_id'])->firstOrFail();

        return $this->repository->create([
            'translation_key' => $data['translation_key'],
            'language_id' => $language->id,
            'content' => $data['content'],
            'tags' => $data['tags'] ?? null,
        ]);
    }

    /**
     * Update an existing translation.
     */
    public function updateTranslation(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Retrieve a translation by ID.
     */
    public function getTranslation(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Search for translations.
     */
    public function searchTranslations(Request $request): Collection
    {
        $filters = $request->only(['query']); // Accept a single search string
    
        if (empty($filters['query'])) {
            return collect(); // Return empty if no search query is provided
        }
    
        return $this->repository->search($filters['query']);
    }
    

        /**
     * destriy translations.
     */
    public function deleteTranslation(int $id)
    {
    
        return $this->repository->destroy($id);
    }

    /**
     * Export all translations.
     */
    public function exportTranslations()
    {
        return $this->repository->export();
    }
}
