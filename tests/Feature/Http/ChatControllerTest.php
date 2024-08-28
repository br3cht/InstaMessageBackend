<?php

namespace Tests\Feature\Http;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        User::factory()->count(2)->create();
    }

    public function test_send_message()
    {
        $dataRequest = [
            'sender_id' => User::find(1)->id,
            'receiver_id' => User::find(2)->id,
            'content' => 'Ola Senhor'
        ];

        $this->post('api/message/send', $dataRequest)->assertOk();

        $this->assertDatabaseCount('conversations', 1);
        $this->assertDatabaseCount('messages',1);
    }

    public function test_get_messages()
    {
        $conversation = Conversation::create([
            'sender_id' => User::find(3)->id,
            'receiver_id' => User::find(4)->id
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sended_by_id'  => User::find(3)->id,
            'content' => 'Hello',
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sended_by_id'  => User::find(3)->id,
            'content' => 'how are you',
        ]);


        $this->get('api/messages?page=1&sender_id='.User::find(3)->id.'&receiver_id='.User::find(4)->id)->assertOk();
    }
}
