<?php

namespace Tests\Feature\Http;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_get_user_no_search()
    {
        $this->get('api/user?page=1')->assertOk();
    }

    public function test_get_user_with_search()
    {
        $this->get('api/user?page=1&name='.$this->user->name)->assertOk();
    }

    public function test_store_user()
    {
        $dataRequest = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'password',
        ];

        $this->post('api/user',$dataRequest)->assertOk();
    }

    public function test_update_user()
    {
        $dataRequest = [
            'name' => 'test',
            'email' => 'test2@gmail.com',
        ];

        $this->put('api/user/' . $this->user->id,$dataRequest)->assertOk();
    }
}
