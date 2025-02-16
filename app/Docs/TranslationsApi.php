<?php

namespace App\Docs;

/**
 * --------------------------------------------------------------------------
 * OpenAPI Annotations for Translation Management API
 * --------------------------------------------------------------------------
 * * @OA\OpenApi(
 *   security={{"sanctum":{}}}
 * )
 * 
 * @OA\Info(
 *     title="Translation Management API",
 *     version="1.0.0",
 *     description="API for managing translations with CRUD operations"
 * )
 *
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="Local API Server"
 * )
 *
 * @OA\Tag(
 *     name="Translations",
 *     description="API Endpoints for managing translations"
 * )
 *
 * --------------------------------------------------------------------------
 * Schema Definitions
 * --------------------------------------------------------------------------
 *
 * @OA\Schema(
 *   schema="TranslationResource",
 *   type="object",
 *   title="Translation Resource",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="key", type="string", example="hello"),
 *   @OA\Property(property="language_id", type="integer", example=1),
 *   @OA\Property(property="content", type="string", example="Hello World"),
 *   @OA\Property(
 *       property="tags",
 *       type="array",
 *       @OA\Items(type="string"),
 *       example={"greeting","common"}
 *   ),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2023-01-01T12:00:00Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2023-01-02T12:00:00Z"),
 *   @OA\Property(
 *       property="lang",
 *       type="object",
 *       description="Language object",
 *       @OA\Property(property="id", type="integer", example=1),
 *       @OA\Property(property="name", type="string", example="English")
 *   )
 * )
 *
 * @OA\Schema(
 *   schema="StoreTranslationRequest",
 *   type="object",
 *   required={"translation_key", "language_id", "content"},
 *   @OA\Property(property="translation_key", type="string", maxLength=255, example="hello"),
 *   @OA\Property(property="language_id", type="integer", example=1),
 *   @OA\Property(property="content", type="string", example="Hello World"),
 *   @OA\Property(property="tags", type="string", nullable=true, example="greeting")
 * )
 *
 * @OA\Schema(
 *   schema="UpdateTranslationRequest",
 *   type="object",
 *   required={"translation_key", "language_id", "content"},
 *   @OA\Property(property="translation_key", type="string", maxLength=255, example="hello"),
 *   @OA\Property(property="language_id", type="integer", example=1),
 *   @OA\Property(property="content", type="string", example="Hello Updated"),
 *   @OA\Property(property="tags", type="string", nullable=true, example="common")
 * )
 *
 * --------------------------------------------------------------------------
 * Translation Endpoints
 * --------------------------------------------------------------------------
 *
 * @OA\Get(
 *   path="/api/v1/translations",
 *   summary="Get all translations",
 *   tags={"Translations"},
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/TranslationResource")
 *     )
 *   ),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Post(
 *   path="/api/v1/translations",
 *   summary="Create a new translation",
 *   tags={"Translations"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/StoreTranslationRequest")
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Translation created successfully",
 *     @OA\JsonContent(ref="#/components/schemas/TranslationResource")
 *   ),
 *   @OA\Response(response=400, description="Bad Request"),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Put(
 *   path="/api/v1/translations/{id}",
 *   summary="Update an existing translation",
 *   tags={"Translations"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="Translation ID",
 *     required=true,
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/UpdateTranslationRequest")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Translation updated successfully",
 *     @OA\JsonContent(ref="#/components/schemas/TranslationResource")
 *   ),
 *   @OA\Response(response=404, description="Translation not found"),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Get(
 *   path="/api/v1/translations/{id}",
 *   summary="Get a single translation by ID",
 *   tags={"Translations"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="Translation ID",
 *     required=true,
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(ref="#/components/schemas/TranslationResource")
 *   ),
 *   @OA\Response(response=404, description="Translation not found"),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Get(
 *   path="/api/v1/translations/search",
 *   summary="Search translations by filters",
 *   tags={"Translations"},
 *   @OA\Parameter(
 *     name="translation_key",
 *     in="query",
 *     required=false,
 *     description="Filter by translation key",
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     name="language_id",
 *     in="query",
 *     required=false,
 *     description="Filter by language ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Parameter(
 *     name="tags",
 *     in="query",
 *     required=false,
 *     description="Filter by tags (comma-separated)",
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="List of matching translations",
 *     @OA\JsonContent(
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/TranslationResource")
 *     )
 *   ),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Delete(
 *   path="/api/v1/translations/{id}",
 *   summary="Delete a translation",
 *   tags={"Translations"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="Translation ID",
 *     required=true,
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Translation deleted successfully",
 *     @OA\JsonContent(
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/TranslationResource")
 *     )
 *   ),
 *   @OA\Response(response=404, description="Translation not found"),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Get(
 *   path="/api/v1/translations/export",
 *   summary="Export all translations",
 *   tags={"Translations"},
 *   @OA\Response(
 *     response=200,
 *     description="File or data containing all translations"
 *   ),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 */
class TranslationsApi
{

}
