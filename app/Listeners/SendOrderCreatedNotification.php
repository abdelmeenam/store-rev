<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCreated;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order =  $event->order;
        $user = User::where('store_id' ,$order->store_id)->first();
        // dd($order);
        $user->notify(new OrderCreatedNotification($order));

        // if i have more than user
        // $users = User::where('store_id' ,$order->store_id)->get();
        // Notification::send($users , new OrderCreatedNotification($order));


    }
}
