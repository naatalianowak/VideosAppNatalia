<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Helpers\DefaultVideoHelper;
use Database\Seeders\PermissionSeeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\DefaultUserHelper as Helpers;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $videoManager = Role::firstOrCreate(['name' => 'video_manager']);
        
        $regularUser = Role::firstOrCreate(['name' => 'regular_user']);

        Permission::firstOrCreate(['name' => 'manage videos']);

        $videoManager->givePermissionTo('manage videos');
        $superAdmin->givePermissionTo('manage videos');

        if (!User::where('email', 'default@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Usuari per Defecte',
                'email' => 'default@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $user1 = Helpers::create_superadmin_user();
        $user2 = Helpers::create_video_manager_user();
        $user3 = Helpers::create_regular_user();

        $user1->assignRole('super_admin');
        $user2->assignRole('video_manager');
        $user3->assignRole('regular_user');

        $this->call(PermissionSeeder::class);


        DefaultVideoHelper::createDefaultVideos();
    }
}
