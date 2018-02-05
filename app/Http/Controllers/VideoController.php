<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use App\Video;

class VideoController extends Controller
{
    public function store(StoreVideoRequest $request)
    {
        $video = Video::create([
            'disk'          => 'videos_disk',
            'original_name' => $request->video->getClientOriginalName(),
            'path'          => $request->video->store('videos', 'videos_disk'),
            'title'         => $request->title,
        ]);

        $this->dispatch(new ConvertVideoForStreaming($video));
        $streamUrl = Storage::disk('streamable_videos')->url($video->id . '.m3u8');
        return response()->json([
            'id' => $video->id,
        ], 201);
    }
}