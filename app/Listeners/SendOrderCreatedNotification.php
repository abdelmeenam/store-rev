<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use App\Models\Vendor;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreatedNotification;

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
        $order = $event->order;

        // Send the notification to the user
        if (Auth::check()) {
            $user = User::where('store_id', $order->store_id)->get();
            $user->notify(new OrderCreatedNotification($order));
        } else {
            // Send the notification to the Guest
            $orderData = $order->addresses()->get();
            Notification::route('mail', $orderData[0]['email'])->notify(new OrderCreatedNotification($order));
        }

        // Send the notification to the vendors
        $vendors = Vendor::where('store_id', $order->store_id)->get();
        Notification::send($vendors, new OrderCreatedNotification($order));


        // Send the notification to the Admins
        $admins = Admin::get();  //send notifiaction to all admins
        Notification::send($admins, new OrderCreatedNotification($order));
    }
}