<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

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
            'super_admin' => true,
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

    public function testedBy(): string
    {
        return get_class($this); 
    }
}
