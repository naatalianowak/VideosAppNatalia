<?php

namespace Tests\Feature;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para verificar que los usuarios pueden ver videos existentes.
     *
     * @return void
     */
    public function test_users_can_view_videos()
    {
        $video = Video::factory()->create();

        $response = $this->get(route('videos.show', $video));

        $response->assertStatus(200);

        $response->assertViewIs('videos.show');

        $response->assertViewHas('video', $video);
    }

    /**
     * Test para verificar que los usuarios no pueden ver videos inexistentes.
     *
     * @return void
     */
    public function test_users_cannot_view_not_existing_videos()
    {
        // ID de un video que no existe
        $nonExistentVideoId = 999;

        $response = $this->get(route('videos.show', ['video' => $nonExistentVideoId]));

        $response->assertStatus(404);
    }
}
