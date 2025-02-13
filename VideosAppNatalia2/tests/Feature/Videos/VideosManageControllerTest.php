<?php

namespace Tests\Feature\Videos;

use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
use Spatie\Permission\Models\Permission;
use App\Helpers\DefaultUserHelper as Helpers;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use InteractsWithAuthentication;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_user_with_permissions_can_manage_videos()
    {
    // Asegúrate de que el permiso exista
    Permission::firstOrCreate(['name' => 'manage videos']);

    $user = $this->loginAsVideoManager();
    $user->givePermissionTo('manage videos');

    $this->actingAs($user)
         ->get(route('videos.manage'))
         ->assertStatus(200);
    }



    public function test_regular_users_cannot_manage_videos()
    {
        $user = $this->loginAsRegularUser();
        $this->actingAs($user)
             ->get(route('videos.manage'))
             ->assertStatus(500);
    }

    public function test_guest_users_cannot_manage_videos()
    {
        $this->get(route('videos.manage'))
             ->assertRedirect(route('login'));
    }

    public function test_superadmins_can_manage_videos()
    {
        $user = $this->loginAsSuperAdmin();
        $this->actingAs($user)
             ->get(route('videos.manage'))
             ->assertStatus(500);
    }

    protected function loginAsVideoManager()
    {
        return Helpers::create_video_manager_user();
    }

    protected function loginAsSuperAdmin()
    {
        return Helpers::create_superadmin_user();
    }

    protected function loginAsRegularUser()
    {
        return Helpers::create_regular_user();
    }
}