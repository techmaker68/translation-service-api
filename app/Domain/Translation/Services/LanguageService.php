<?php

namespace App\Domain\Translation\Services;

use App\Domain\Translation\Interfaces\LanguageServiceInterface;
use App\Domain\Translation\Repositories\LanguageRepository;
use Illuminate\Database\Eloquent\Collection;

class LanguageService implements LanguageServiceInterface
{
    protected LanguageRepository $repository;

    public function __construct(LanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * Create a new Language.
     */
    public function createLanguage(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing Language.
     */
    public function updateLanguage(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Retrieve a Language by ID.
     */
    public function getLanguage(int $id)
    {
        return $this->repository->find($id);
    }


    /**
     * Export all Languages.
     */
    public function exportLanguages(): Collection
    {
        return $this->repository->export();
    }
}
