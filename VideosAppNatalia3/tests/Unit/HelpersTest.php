<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Team;
use App\Models\Video;
use App\Helpers\DefaultVideoHelper;
use App\Helpers\DefaultUserHelper;
use Illuminate\Support\Facades\Hash;
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

    public function test_default_user_creation(): void
    {
        $user = User::factory()->create([
            'name' => 'Taco',
            'email' => 'taco12@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $this->assertNotNull($user);
        $this->assertEquals('Taco', $user->name);
        $this->assertEquals('taco12@gmail.com', $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    public function test_default_teacher_creation(): void
    {
        $profe = User::factory()->create([
            'name' => 'Kumy',
            'email' => 'kumy12@gmail.com',
            'password' => Hash::make('passwordprofe'),
            'is_superadmin' => true,
        ]);

        $this->assertNotNull($profe);
        $this->assertEquals('Kumy', $profe->name);
        $this->assertEquals('kumy12@gmail.com', $profe->email);
        $this->assertTrue(Hash::check('passwordprofe', $profe->password));
        $this->assertTrue($profe->isSuperAdmin());
    }

    public function test_users_associated_with_team(): void
    {
        $team = Team::factory()->create();
        $user = User::factory()->create([
            'name' => 'Haru',
            'email' => 'Haru03@gmail.com',
            'password' => Hash::make('passwordharu'),
        ]);
        $user->teams()->attach($team);

        $this->assertTrue($user->teams->contains($team));
    }

    public function test_default_video_check(): void
    {
        $video = Video::factory()->create([
            'title' => 'Video de exemple',
            'description' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/CbEst0K063c" frameborder="0" allowfullscreen></iframe>',
            'url' => 'https://www.youtube.com/watch?v=CbEst0K063c',
        ]);

        $this->assertNotNull($video);
        $this->assertEquals('Video de exemple', $video->title);
        $this->assertEquals('<iframe width="560" height="315" src="https://www.youtube.com/embed/CbEst0K063c" frameborder="0" allowfullscreen></iframe>', $video->description);
        $this->assertEquals('https://www.youtube.com/watch?v=CbEst0K063c', $video->url);
    }
}
