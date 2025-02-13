<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VideosController extends Controller
{
    use AuthorizesRequests;

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

    public function edit(int $id): View
    {
        $video = Video::findOrFail($id);

        $this->authorize('update', $video);

        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $video->update($request->only(['title', 'description']));

        return redirect()->route('videos.index')->with('success', 'Video actualizado correctamente.');
    }

    /**
     * Devuelve el nombre de quien probó la funcionalidad.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function testedBy(): JsonResponse
    {
        return response()->json(['tested_by' => HelpersTest::class]);
    }
}
