<?php

namespace App\Domain\Translation\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface TranslationServiceInterface
{
    public function getAll();
    public function createTranslation(array $data);
    public function updateTranslation(int $id, array $data);
    public function getTranslation(int $id);
    public function deleteTranslation(int $id);
    public function searchTranslations(Request $request): Collection;
    public function exportTranslations();

}
