<?php

namespace App\Http\Controllers;

use App\DTO\Chat\ChatConversationInput;
use App\DTO\Chat\GetChatMessageInput;
use App\Http\Requests\Chat\GetMessageRequest;
use App\Http\Requests\Chat\SendMessageRequest;
use App\Http\Resources\Chat\MessageResource;
use App\Jobs\SendMessage;
use App\Models\Conversation;
use App\Service\Chat\ConversationService;
use App\Service\Chat\MessageService;
use Exception;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(
        protected MessageService $messageService,
        protected ConversationService $conversationService,
    ) {}

    public function getMessages(GetMessageRequest $request)
    {
        $dataRequest = $request->validated();
        $input = new GetChatMessageInput(
            $dataRequest['sender_id'],
            $dataRequest['receiver_id'],
            $dataRequest['page']
        );

        $message = $this->messageService->getMessage($input);

        return MessageResource::collection($message);
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $dataRequest = $request->validated();
        $conversation = optional($dataRequest)['conversation_id'] ? Conversation::find($dataRequest['converation_id']) : null;
        $input = new ChatConversationInput(
            $dataRequest['sender_id'],
            $dataRequest['receiver_id'],
            $dataRequest['content'],
        );
        if (
            !optional($dataRequest)['conversation_id'] &&
            !$this->conversationService->conversationStarted($input)
        ) {
            $conversation = $this->conversationService->start($input);
        }

        if(empty($conversation)) throw new Exception('impossivel de enviar mensagem');

        SendMessage::dispatch($input,$conversation);
    }
}
