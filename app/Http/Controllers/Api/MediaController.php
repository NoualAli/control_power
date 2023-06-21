<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\StoreRequest;
use App\Models\Media;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Image;

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
                    extract($this->uploadFile($file));
                    $attachable = $request->has('attachable') ? $request->attachable : [];
                    $attachableId = $attachable && isset($request->attachable['id']) && !empty($request->attachable['id']) ? $request->attachable['id'] : null;
                    $attachableType = $attachable && isset($request->attachable['type']) && !empty($request->attachable['type']) ? $request->attachable['type'] : null;

                    $uploadedFile = Media::create([
                        'original_name' => $originalName,
                        'hash_name' => $hashName,
                        'folder' => $folder,
                        'extension' => $extension,
                        'mimetype' => $mimetype,
                        'size' => $size,
                        'attachable_id' => $attachableId,
                        'attachable_type' => $attachableType,
                        'uploaded_by_id' => auth()->user()->id
                    ]);

                    array_push($uploadedFiles, $uploadedFile);
                }
                return $uploadedFiles;
            });
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Upload file to public storage (with support for image size optimization)
     *
     * @param UploadedFile $file
     *
     * @return array
     */
    private function uploadFile(UploadedFile $file)
    {
        $hashName = $file->hashName();
        $originalName = $file->getClientOriginalName();
        $folder = 'uploads';
        $tmpFolder = 'uploads/tmp';
        $extension = $file->getClientOriginalExtension();
        $mimetype = $file->getClientMimeType();
        $size = $file->getSize();

        $path = public_path($folder . '/' . $hashName);
        $tmpPath = public_path($tmpFolder . '/' . $hashName);

        if (in_array($extension, IMAGE_TYPES)) {
            $file->move($tmpFolder, $hashName);
            // $watermark = Image::make(public_path('images/brand.png'))->resize(250, 125);
            $img = Image::make($tmpPath);
            // $img = $img->insert($watermark, 'bottom-right', 10, 10);
            $img = $img->save($path, 60);
            $size = $img->filesize();
            File::delete($tmpPath);
        } else {
            $file->move($folder, $hashName);
        }

        return compact('hashName', 'originalName', 'folder', 'extension', 'mimetype', 'size');
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
            // delete file from database
            if ($media->delete()) {
                // delete file from storage
                if (File::exists(public_path($media->path))) {
                    File::delete(public_path($media->path));
                }
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
