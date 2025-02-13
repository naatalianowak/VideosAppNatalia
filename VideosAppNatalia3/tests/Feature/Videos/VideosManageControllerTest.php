<?php

namespace Tests\Feature\Videos;

use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;


class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Video Manager']);
        Role::create(['name' => 'Regular User']);
        Permission::create(['name' => 'update videos']);
    }


    public function test_user_with_permissions_can_manage_videos()
    {
        $user = User::factory()->create(['is_superadmin' => false]);
        $user->givePermissionTo('update videos');
        $this->actingAs($user);

        $video = Video::factory()->create();

        $response = $this->get('/videos/' . $video->id . '/edit');

        $response->assertStatus(200);
        if (!empty(auth()->user()->name)) {
            $response->assertSee(auth()->user()->name);
        }
    }

    public function test_superadmins_can_manage_videos()
    {
        $superadmin = User::factory()->create(['is_superadmin' => true]);
        $this->actingAs($superadmin);

        $video = Video::factory()->create();

        $response = $this->get('/videos/' . $video->id . '/edit');

        $response->assertStatus(200);
    }

    protected function loginAsVideoManager(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Video Manager');
        $this->actingAs($user);
    }

    public function test_regular_users_cannot_manage_videos()
    {
        $this->loginAsRegularUser(); // Ya inicia sesión con un usuario regular

        $video = Video::factory()->create(); // Crea un video

        $response = $this->get('/videos/' . $video->id . '/edit');

        $response->assertStatus(403);
    }


    public function test_guest_users_cannot_manage_videos()
    {
        $this->logout();

        $video = Video::factory()->create();

        $response = $this->get('/videos/' . $video->id . '/edit');
        $response->assertRedirect('/login');
    }

    protected function logout()
    {
        auth()->logout();
    }

    protected function loginAsSuperAdmin(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Super Admin');
        $this->actingAs($user);
    }

    protected function loginAsRegularUser(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Regular User');
        $this->actingAs($user);
    }
    protected array $casts = [
        'published_at' => 'datetime',
    ];
}
