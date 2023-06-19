<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ManageProductImages
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
    public function handle($event)
    {
        $images = [ $event->data['base_image'] => ['img_type' => 'base'] ];
        foreach($event->data['additional_images'] ?? [] as $additional_image) {
            $additional_image != $event->data['base_image'] && (
                $images[$additional_image] = ['img_type' => 'additional']
            );
        }

        $event->product->images()->sync($images);
    }
}
