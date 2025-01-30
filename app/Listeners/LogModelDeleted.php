<?php

namespace App\Listeners;

use App\Events\ModelDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogModelDeleted
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
    public function handle(ModelDeleted $event)
    {
        DB::table('activity_log')->insert([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'model' => get_class($event->model),
            'model_id' => $event->model->id,
            'created_at'=>now()->timezone('America/Lima'),
        ]);
    }
}