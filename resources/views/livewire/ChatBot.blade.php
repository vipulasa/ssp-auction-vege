<?php

use function Livewire\Volt\{state, mount};
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Product;

state([
    'toggleChat' => true,
    'messages' => [],
    'chat' => [],
    'query' => null,
]);

mount(function () {

});

$askQuestion = function () {

    $this->messages[] = [
        'role' => 'user',
        'content' => $this->query
    ];

    $openai_query = "You are a call centre assistant working at AuctionVegi, an auction company specialised in selling vegetables.
Following products are available in stock.
- ";

    // get all the products
    $products = Product::all();

    // loop through the products and add them to the openai query
    foreach ($products as $product) {
        $openai_query .= $product->name . " at LKR " . $product->price . " per kg, ";
    }

    $openai_query = $openai_query.' Q: '.$this->query;

    $this->chat[] = [
        'role' => 'user',
        'content' => $openai_query
    ];

    $result = OpenAI::chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => $this->chat,
    ]);

    $this->query = null;

    if(!empty($result->choices)){
        // loop through the messages and add them to the messages array
        foreach ($result->choices as $message) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $message->message->content,
            ];

            $this->chat[] = [
                'role' => 'assistant',
                'content' => $message->message->content,
            ];
        }
    }
};

?>

<div x-data="{
    toggleChat : @entangle('toggleChat')
}">

    // tailwind chat window with chat icon
    <div class="fixed bottom-10 right-10 z-50">
        <div class="flex flex-col items-end">
            <div class="flex items center">
                <button x-on:click="toggleChat = !toggleChat"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="fixed bottom-20 right-10 bg-white min-h-[500px] min-w-[300px] border-4 border-green-500"
             x-show="toggleChat">
            <ul>
                @foreach($messages as $message)
                    <li>{{ $message['role'] }} : {{ $message['content'] }}</li>
                @endforeach
            </ul>

            <div class="flex">
                <form wire:submit.prevent="askQuestion">
                    <input type="text" wire:model="query">
                    <button type="submit">Ask</button>
                </form>
            </div>
        </div>
    </div>

</div>
