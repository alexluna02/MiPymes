<?php

namespace App\Listeners;

use App\Events\ModelUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogModelUpdated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ModelUpdated $event)
    {
        $parts = explode('\\', get_class($event->model));
        DB::table('activity_log')->insert([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model' => end($parts),
            'model_id' => $event->model->id,
            'old_value' => json_encode($event->old_value, JSON_PRETTY_PRINT),
            'new_value' => json_encode($event->new_value, JSON_PRETTY_PRINT),
            'created_at' => now()->timezone('America/Lima'),
        ]);
    }
}
