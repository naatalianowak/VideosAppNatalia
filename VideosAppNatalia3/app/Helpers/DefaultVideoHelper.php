<?php

namespace App\Helpers;

use App\Models\Video;

class DefaultVideoHelper
{
    /**
     * Crea videos por defecto.
     *
     * @return void
     */
    public static function createDefaultVideos(): void
    {
        Video::query()->create([
            'title' => 'Video 1 - Fire - BTS',
            'description' => 'Video de la canción Fire de BTS.<br><iframe width="560" height="315" src="https://www.youtube.com/embed/4ujQOR2DMFM" frameborder="0" allowfullscreen></iframe>',
            'url' => 'https://www.youtube.com/watch?v=4ujQOR2DMFM',
            'published_at' => now(),
        ]);

        Video::query()->create([
            'title' => 'Video 2 - Mic Drop - BTS',
            'description' => 'Video de la canción Mic Drop de BTS.<br><iframe width="560" height="315" src="https://www.youtube.com/embed/kTlv5_Bs8aw" frameborder="0" allowfullscreen></iframe>',
            'url' => 'https://www.youtube.com/watch?v=kTlv5_Bs8aw',
            'published_at' => now(),
        ]);
    }
}
