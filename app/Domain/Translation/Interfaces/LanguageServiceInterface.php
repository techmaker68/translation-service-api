<?php

namespace App\Domain\Translation\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface LanguageServiceInterface
{
    public function getAll();
    public function createLanguage(array $data);
    public function updateLanguage(int $id, array $data): bool;
    public function getLanguage(int $id);
    public function exportLanguages(): Collection;

}
