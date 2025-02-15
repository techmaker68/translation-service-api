<?php

namespace App\Domain\Translation\Repositories;

use App\Domain\Translation\Interfaces\TranslationRepositoryInterface;
use App\Domain\Translation\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository implements TranslationRepositoryInterface
{   
    // initiate the modal instance once
    private function modalInstance()
    {
        return new Language();
    }
    /**
     * Create a new Language.
     */
    public function create(array $data): Language
    {
        return $this->modalInstance()->create($data);
    }
  /**
     * Get all records.
     */
    public function getAll(): Collection
    {
        return $this->modalInstance()->all();
    }

    /**
     * Update an existing Language.
     */
    public function update(int $id, array $data): bool
    {
        $Language = $this->modalInstance()->findOrFail($id);
        return $Language->update($data);
    }

    /**
     * Find a Language by its ID.
     */
    public function find(int $id): ?Language
    {
        return $this->modalInstance()->find($id);
    }

    /**
     * Get all Languages for export.
     */
    public function export(): Collection
    {
        return $this->modalInstance()->all();
    }
}
