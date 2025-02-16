<?php

namespace App\Docs;

/**
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="apiKey",
 *     in="header",
 *     name="Authorization",
 *     description="Enter your API token in the format: Bearer {token}"
 * )
 *
 * @OA\Security(
 *     security={{"sanctum":{}}}
 * )
 * @OA\Tag(
 *   name="Authentication",
 *   description="User authentication endpoints"
 * )
 *
 * @OA\Schema(
 *   schema="LoginRequest",
 *   type="object",
 *   required={"email", "password"},
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     format="email",
 *     example="admin@example.com"
 *   ),
 *   @OA\Property(
 *     property="password",
 *     type="string",
 *     format="password",
 *     example="admin"
 *   )
 * )
 *
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="name", type="string", example="John Doe"),
 *   @OA\Property(property="email", type="string", format="email", example="user@example.com")
 * )
 *
 * @OA\Post(
 *   path="/api/v1/auth/login",
 *   summary="User Login",
 *   tags={"Authentication"},
 *   @OA\RequestBody(
 *     required=true,
 *     description="Pass user credentials",
 *     @OA\JsonContent(ref="#/components/schemas/LoginRequest")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Login successful",
 *     @OA\JsonContent(
 *       @OA\Property(property="user", ref="#/components/schemas/User"),
 *       @OA\Property(property="token", type="string", example="a_valid_api_token")
 *     )
 *   ),
 *   @OA\Response(
 *     response=422,
 *     description="Validation error or incorrect credentials",
 *     @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="The provided credentials are incorrect.")
 *     )
 *   )
 * )
 *
 * @OA\Post(
 *   path="/api/v1/auth/logout",
 *   summary="User Logout",
 *   tags={"Authentication"},
 *   security={{"sanctum":{}}},
 *   @OA\Response(
 *     response=200,
 *     description="Logout successful",
 *     @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Logged out successfully")
 *     )
 *   )
 * )
 */
class AuthApi
{
    // This class is intentionally empty.
    // It only contains OpenAPI annotations for authentication endpoints.
}
