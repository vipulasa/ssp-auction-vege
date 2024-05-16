<?php

use function Livewire\Volt\{state, mount};

state([
    'notifications' => [],
]);

mount(function () {
    $this->notifications = auth()->user()->notifications;
});

$markAsRead = function ($notificationId) {

    // find the notification by id and mark it as read
    $notification = $this->notifications->find($notificationId);

    $notification->markAsRead();

    // update the notifications list
    $this->notifications = auth()->user()->notifications;
};



?>

<div>
    @foreach($notifications as $notification)
        <div class="block px-4 py-2 text-xs text-gray-400 relative">

            {{ $notification->data['icon'] }}
            <a href="{{ $notification->data['link'] }}">
                {{ $notification->data['message'] }}
            </a>
            {{ $notification->data['type'] }}


            <a class=""
                    wire:click="markAsRead('{{ $notification->id }}')">
                Mark as read
            </a>

        </div>
    @endforeach
</div>
