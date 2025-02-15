<?php

namespace App\Domain\Translation\Interfaces;
use Illuminate\Database\Eloquent\Collection;

interface LanguageRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function update(int $id, array $data): bool;
    public function find(int $id);
    public function search(array $filters): Collection;
    // public function export();
    // public function delete($id);
}
