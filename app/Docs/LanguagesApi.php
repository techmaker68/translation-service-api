<?php

namespace App\Docs;

/**
 * 
 * @OA\Tag(
 *   name="Languages",
 *   description="API Endpoints for managing languages"
 * )
 *
 * @OA\Schema(
 *   schema="LanguageResource",
 *   type="object",
 *   title="Language Resource",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="code", type="string", example="en"),
 *   @OA\Property(property="name", type="string", example="English")
 * )
 *
 * @OA\Schema(
 *   schema="StoreLanguageRequest",
 *   type="object",
 *   required={"code", "name"},
 *   @OA\Property(property="code", type="string", maxLength=10, example="en"),
 *   @OA\Property(property="name", type="string", maxLength=255, example="English")
 * )
 *
 * @OA\Schema(
 *   schema="UpdateLanguageRequest",
 *   type="object",
 *   required={"code", "name"},
 *   @OA\Property(property="code", type="string", maxLength=10, example="en"),
 *   @OA\Property(property="name", type="string", maxLength=255, example="English")
 * )
 *
 * @OA\Get(
 *   path="/api/v1/language",
 *   summary="Get all languages",
 *   tags={"Languages"},
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/LanguageResource")
 *     )
 *   ),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Post(
 *   path="/api/v1/language",
 *   summary="Create a new language",
 *   tags={"Languages"},
 *   @OA\RequestBody(
 *     required=true,
 *     description="Language data",
 *     @OA\JsonContent(ref="#/components/schemas/StoreLanguageRequest")
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Language created successfully",
 *     @OA\JsonContent(ref="#/components/schemas/LanguageResource")
 *   ),
 *   @OA\Response(response=400, description="Bad Request"),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Put(
 *   path="/api/v1/language/{id}",
 *   summary="Update an existing language",
 *   tags={"Languages"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="Language ID",
 *     required=true,
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     description="Language data",
 *     @OA\JsonContent(ref="#/components/schemas/UpdateLanguageRequest")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Language updated successfully",
 *     @OA\JsonContent(ref="#/components/schemas/LanguageResource")
 *   ),
 *   @OA\Response(response=404, description="Language not found"),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 *
 * @OA\Get(
 *   path="/api/v1/language/{id}",
 *   summary="Get a language by ID",
 *   tags={"Languages"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="Language ID",
 *     required=true,
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(ref="#/components/schemas/LanguageResource")
 *   ),
 *   @OA\Response(response=404, description="Language not found"),
 *   @OA\Response(response=500, description="Internal Server Error")
 * )
 */
class LanguagesApi
{
    // This class is intentionally empty.
    // It only contains OpenAPI annotations for language endpoints.
}
