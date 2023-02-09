<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\StoreRequest;
use App\Models\Media;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $files = explode(',', request()->media);
        return Media::whereIn('id', $files)->get();
    }

    /**
     * Store files into database and storage
     *
     * @param App\Requests\Media\StoreRequest $request
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $uploadedFiles = [];
                $media = $request->validated()['media'];
                foreach ($media as $file) {
                    $fileName = $file->hashName();
                    $folder = 'uploads';
                    $attachable = $request->has('attachable') ? $request->attachable : [];
                    $attachableId = $attachable && isset($request->attachable['id']) && !empty($request->attachable['id']) ? $request->attachable['id'] : null;
                    $attachableType = $attachable && isset($request->attachable['type']) && !empty($request->attachable['type']) ? $request->attachable['type'] : null;
                    $uploadedFile = Media::create([
                        'original_name' => $file->getClientOriginalName(),
                        'hash_name' => $fileName,
                        'folder' => $folder,
                        'extension' => $file->getClientOriginalExtension(),
                        'mimetype' => $file->getClientMimeType(),
                        'size' => $file->getSize(),
                        'attachable_id' => $attachableId,
                        'attachable_type' => $attachableType
                    ]);
                    $file->move($folder, $fileName);
                    array_push($uploadedFiles, $uploadedFile);
                }
                return $uploadedFiles;
            });
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], $th->getCode());
        }
    }

    /**
     * Destroy media from storage and database
     *
     * @param Media $media
     *
     * @return Illuminate\Http\JsonResponse|
     */
    public function destroy(Media $media)
    {
        try {
            if ($media->delete()) {
                return $media;
            } else {
                return response()->json([
                    'message' => DELETE_ERROR,
                ], 500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], $th->getCode());
        }
    }
}
