<?php

namespace App\Jobs;

use App\Models\Favorite;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AlbumJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $photo_id, $user_id;

    public function __construct($photo_id, $user_id)
    {
        $this->photo_id = $photo_id;
        $this->user_id = $user_id;
    }

    public function handle(Favorite $favorite)
    {
        $f = $favorite::create([
            "photo_id" => $this->photo_id,
            "user_id" => $this->user_id
        ]);
    }
}
