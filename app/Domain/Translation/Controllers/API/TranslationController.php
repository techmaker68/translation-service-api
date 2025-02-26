<?php

namespace App\Domain\Translation\Controllers\API;

use App\Domain\Translation\Services\TranslationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class TranslationController extends Controller
{
    public function __construct(protected TranslationService $service)
    {
        $this->service = $service;
    }

    public function index(): mixed
    {
        return $this->tryCatch(function () {
            $translations = $this->service->getAll();
            return TranslationResource::collection($translations);
        });
    }

    public function store(StoreTranslationRequest $request): TranslationResource
    {
        return $this->tryCatch(function () use ($request) {
            $translation = $this->service->createTranslation($request->validated());
            return new TranslationResource($translation);
        });
    }

    public function update(UpdateTranslationRequest  $request, int $id): TranslationResource
    {
        return $this->tryCatch(function () use ($request, $id) {
            $result = $this->service->updateTranslation($id, $request->validated());
            return new TranslationResource($result);
        });
    }

    /**
     * Retrieve a translation by ID.
     */
    public function show(int $id): TranslationResource
    {
        return $this->tryCatch(function () use ($id) {
            $translation = $this->service->getTranslation($id);
            return new TranslationResource($translation);
        });
    }

    /**
     * Search translations by filters.
     */
    public function search(Request $request): AnonymousResourceCollection
    {
        return $this->tryCatch(function () use ($request) {
            $results = $this->service->searchTranslations($request);
            return TranslationResource::collection($results);
        });
    }

    public function destroy(int $id)
    {
        return $this->tryCatch(function () use ($id) {
            $this->service->deleteTranslation($id);
            $translations = $this->service->getAll();
            return TranslationResource::collection($translations);
        });
    }

    public function export()
    {
        return  $this->service->exportTranslations();
    }
}
