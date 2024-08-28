<?php

namespace App\Jobs;

use App\DTO\Chat\ChatConversationInput;
use App\Models\Conversation;
use App\Service\Chat\MessageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected ChatConversationInput $input,
        protected Conversation $conversation
    ) { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = resolve(MessageService::class);
        $service->sendMessage($this->input, $this->conversation);
    }
}
