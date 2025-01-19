<?php

namespace App\Listeners;

use App\Events\ModelCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogModelCreated
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
    public function handle(ModelCreated $event)
    {
        DB::table('activity_log')->insert([
            'user_id' => Auth::id(),
            'action' => 'created',
            'model' => get_class($event->model),
            'model_id' => $event->model->id,
            'created_at'=>now()->timezone('America/Lima'),
        ]);
    }
}
