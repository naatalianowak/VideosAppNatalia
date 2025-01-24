<?php

namespace App\Helpers;

use App\Models\Video;

class DefaultVideoHelper
{
    /**
     * Crea videos per defecte.
     *
     * @return void
     */
    public static function createDefaultVideos(): void
    {
        // Crear el primer video
        Video::query()->create([
            'title' => 'Video 1 - Fire - BTS',
            'description' => 'Video de la canción Fire de BTS.',
            'url' => 'https://www.youtube.com/watch?v=4ujQOR2DMFM',
            'published_at' => now(),
        ]);

        // Crear el segundo video
        Video::query()->create([
            'title' => 'Video 2 - Mic Drop - BTS',
            'description' => 'Video de la canción Mic Drop de BTS.',
            'url' => 'https://www.youtube.com/watch?v=kTlv5_Bs8aw',
            'published_at' => now(),
        ]);
    }
}
