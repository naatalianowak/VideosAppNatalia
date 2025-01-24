<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;  

class VideosController extends Controller
{
    /**
     * Muestra un video específico.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id): View
    {
        $video = Video::query()->findOrFail($id); 
        
        return view('videos.show', compact('video')); 
    }

    /**
     * Devuelve el nombre de quien probó la funcionalidad.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function testedBy(): JsonResponse
    {
        return response()->json(['tested_by' => 'Natalia Nowak']); 
    }
}
