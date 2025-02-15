<?php

namespace App\Domain\Translation\Controllers\API;

use App\Domain\Translation\Services\TranslationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Info(
 *     title="Translation Management API",
 *     version="1.0.0",
 *     description="API for managing translations with CRUD operations"
 * )
 *
 * @OA\Tag(
 *     name="Translations",
 *     description="API Endpoints for managing translations"
 * )
 */
class TranslationController extends Controller
{
    protected TranslationService $service;

    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/translations",
     *     summary="Get all translations",
     *     tags={"Translations"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function index(): mixed
    {
        return $this->tryCatch(function () {
            $translations = $this->service->getAll();
            return TranslationResource::collection($translations);
        });
    }

    /**
     * @OA\Post(
     *     path="/api/translations",
     *     summary="Create a new translation",
     *     tags={"Translations"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"translation_key", "language_id", "content"},
     *             @OA\Property(property="translation_key", type="string", example="hello"),
     *             @OA\Property(property="language_id", type="integer", example=1),
     *             @OA\Property(property="content", type="string", example="Hello World"),
     *             @OA\Property(property="tags", type="string", example="greeting")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Translation created successfully"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function store(StoreTranslationRequest $request): TranslationResource
    {
        return $this->tryCatch(function () use ($request) {
            $translation = $this->service->createTranslation($request->validated());
            return new TranslationResource($translation);
        });
    }

    /**
     * @OA\Put(
     *     path="/api/translations/{id}",
     *     summary="Update a translation",
     *     tags={"Translations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"translation_key", "content"},
     *             @OA\Property(property="translation_key", type="string", example="hello"),
     *             @OA\Property(property="content", type="string", example="Hello Updated"),
     *             @OA\Property(property="tags", type="string", example="common")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Translation updated successfully"),
     *     @OA\Response(response=404, description="Translation not found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
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

     /**
     * @OA\Delete(
     *     path="/api/translations/{id}",
     *     summary="Delete a translation",
     *     tags={"Translations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Translation deleted successfully"),
     *     @OA\Response(response=404, description="Translation not found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function destroy(int $id)
    {
        return $this->tryCatch(function () use ($id) {
            $this->service->deleteTranslation($id);
            $translations = $this->service->getAll();
            return TranslationResource::collection($translations);
        });
    }

      /**
     * @OA\Get(
     *     path="/api/translations/export",
     *     summary="Export all translations",
     *     tags={"Translations"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function export(): mixed
    {
        return $this->tryCatch(function () {
            return $this->service->exportTranslations();
        });
    }
}
