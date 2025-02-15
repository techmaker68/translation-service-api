<?php

namespace App\Domain\Translation\Controllers\API;

use App\Domain\Translation\Services\LanguageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Resources\languageresource;
class LanguagesController extends Controller
{
    protected LanguageService $service;

    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }

    /**
     * Export all languages as JSON.
     */
    public function index()
    {
        return $this->tryCatch(function () {
            $languages = $this->service->getAll();
            return languageresource::collection($languages);
        });
    }

    /**
     * Create a new translation.
     */
    public function store(StoreLanguageRequest $request): LanguageResource
    {
        return $this->tryCatch(function () use ($request) {
            $translation = $this->service->createLanguage($request->validated());
            return new LanguageResource($translation);
        });
    }

    /**
     * Update an existing translation.
     */
    public function update(UpdateLanguageRequest  $request, int $id): LanguageResource
    {
        return $this->tryCatch(function () use ($request, $id) {
            $result = $this->service->updateLanguage($id, $request->validated());
            return new LanguageResource($result);
        });
    }

    /**
     * Retrieve a translation by ID.
     */
    public function show(int $id): LanguageResource
    {
        return $this->tryCatch(function () use ($id) {
            $translation = $this->service->getLanguage($id);
            return new LanguageResource($translation);
        });
    }
}
