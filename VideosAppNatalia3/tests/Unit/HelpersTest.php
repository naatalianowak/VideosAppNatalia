<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use App\Helpers\DefaultVideoHelper;
use App\Helpers\DefaultUserHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_video_creation(): void
    {
        DefaultVideoHelper::createDefaultVideos();

        $video1 = Video::query()->where('title', 'Video 1 - Fire - BTS')->first();
        $video2 = Video::query()->where('title', 'Video 2 - Mic Drop - BTS')->first();

        $this->assertNotNull($video1);
        $this->assertEquals('Video de la canción Fire de BTS.<br><iframe width="560" height="315" src="https://www.youtube.com/embed/4ujQOR2DMFM" frameborder="0" allowfullscreen></iframe>', $video1->description);
    }

    public function test_create_regular_user(): void
    {
        $user = DefaultUserHelper::create_regular_user();

        $this->assertNotNull($user);
        $this->assertEquals('Regular', $user->name);
        $this->assertEquals('regular@videosapp.com', $user->email);
    }

    public function test_create_video_manager_user(): void
    {
        $user = DefaultUserHelper::create_video_manager_user();

        $this->assertNotNull($user);
        $this->assertEquals('Video Manager', $user->name);
        $this->assertEquals('videosmanager@videosapp.com', $user->email);
    }

    public function test_create_superadmin_user(): void
    {
        $user = DefaultUserHelper::create_superadmin_user();

        $this->assertNotNull($user);
        $this->assertEquals('Super Admin', $user->name);
        $this->assertEquals('superadmin@videosapp.com', $user->email);
    }

    public function test_add_personal_team(): void
    {
        $user = User::factory()->create();
        DefaultUserHelper::add_personal_team($user);

        $this->assertNotNull($user->currentTeam);
        $this->assertEquals($user->name . "'s Team", $user->currentTeam->name);
    }

    public function test_define_gates(): void
    {
        DefaultUserHelper::define_gates();

        $user = User::factory()->create();
        $superAdmin = User::factory()->create(['super_admin' => true]);
    }
}
