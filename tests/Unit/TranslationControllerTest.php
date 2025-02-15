<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Translation\Models\Translation;
use App\Domain\Translation\Services\TranslationService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;

class TranslationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected TranslationService $service;

    public function setUp(): void
    {
        parent::setUp();
    
        // Create a test user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);
    
        // Mocking TranslationService
        $this->service = Mockery::mock(TranslationService::class);
        $this->app->instance(TranslationService::class, $this->service);
    }

    /** @test */
    public function it_can_get_all_translations()
    {
        $translations = Translation::factory()->count(5)->create();

        $this->service
            ->shouldReceive('getAll')
            ->once()
            ->andReturn($translations);

        $response = $this->getJson(route('translations.index'));

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function it_can_create_a_translation()
    {
        $data = [
            'translation_key' => 'hello',
            'language_id' => 1,
            'content' => 'Hello World',
            'tags' => 'greeting'
        ];

        $this->service
            ->shouldReceive('createTranslation')
            ->once()
            ->with($data)
            ->andReturn(new Translation($data));

        $response = $this->postJson(route('translations.store'), $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['translation_key' => 'hello']);
    }

    /** @test */
    public function it_can_update_a_translation()
    {
        $translation = Translation::factory()->create();
        $updatedData = [
            'translation_key' => 'hello_updated',
            'content' => 'Hello Updated',
            'tags' => 'common'
        ];

        $this->service
            ->shouldReceive('updateTranslation')
            ->once()
            ->with($translation->id, $updatedData)
            ->andReturn(new Translation($updatedData));

        $response = $this->putJson(route('translations.update', $translation->id), $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment(['translation_key' => 'hello_updated']);
    }

    /** @test */
    public function it_can_show_a_translation()
    {
        $translation = Translation::factory()->create();

        $this->service
            ->shouldReceive('getTranslation')
            ->once()
            ->with($translation->id)
            ->andReturn($translation);

        $response = $this->getJson(route('translations.show', $translation->id));

        $response->assertStatus(200)
            ->assertJsonFragment(['translation_key' => $translation->translation_key]);
    }

    /** @test */
    public function it_can_delete_a_translation()
    {
        $translation = Translation::factory()->create();

        $this->service
            ->shouldReceive('deleteTranslation')
            ->once()
            ->with($translation->id);

        $response = $this->deleteJson(route('translations.destroy', $translation->id));

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_export_translations()
    {
        $translations = Translation::factory()->count(10)->create();

        $this->service
            ->shouldReceive('exportTranslations')
            ->once()
            ->andReturn($translations);

        $response = $this->getJson(route('translations.export'));

        $response->assertStatus(200);
    }
}
