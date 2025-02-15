<?php

namespace Tests\Feature;

use App\Domain\Translation\Models\Translation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TranslationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Set the default Authorization header for every test
        $this->withHeader('Authorization', 'Bearer ' . env('API_AUTH_TOKEN'));
    }

    public function testCreateTranslation()
    {
        $response = $this->postJson('/api/v1/translations', [
            'translation_key' => 'greeting',
            'locale' => 'en',
            'content' => 'Hello, World!',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'data' => ['id']]);
        $this->assertDatabaseHas('translations', ['translation_key' => 'greeting']);
    }

    public function testShowTranslation()
    {
        $translation = Translation::factory()->create();

        $response = $this->getJson('/api/v1/translations/' . $translation->id);
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $translation->id,
            'translation_key' => $translation->translation_key,
        ]);
    }

    // More tests for update, search, export, etc.
}
