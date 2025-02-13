<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase; 
use App\Helpers\DefaultUserHelper as Helpers;

class UserTest extends BaseTestCase 
{
    public function test_isSuperAdmin()
    {
        $user = Helpers::create_superadmin_user();
        $this->assertTrue($user->isSuperAdmin());
    }
}

