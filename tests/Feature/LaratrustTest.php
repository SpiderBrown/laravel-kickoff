<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaratrustTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuperAdminPermission()
    {
        $superadmin=User::find(1);

        $this->assertTrue($superadmin->can('read-profile'));
    }
}
