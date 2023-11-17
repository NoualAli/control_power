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
        return DB::transaction(function () use ($request) {
            $files = request()->file();
            $key = is_array($files) && count($files) ? array_keys($files)[0] : $files;
            $media = $request->validated()[$key];
            $uploadedFiles = is_array($media) ? [] : null;

            if (is_array($media)) {
                foreach ($media as $file) {
                    array_push($uploadedFiles, $this->storeInDatabase($request, $file));
                }
            } else {
                $uploadedFiles = [$this->storeInDatabase($request, $media)];
            }
            return $uploadedFiles;
        });
        try {
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
    private function uploadFile(UploadedFile $file, string $folder)
    {
        $hashName = $file->hashName();
        $originalName = $file->getClientOriginalName();
        $tmpFolder = 'uploads/tmp';
        $extension = strtolower($file->getClientOriginalExtension());
        $mimetype = $file->getClientMimeType();
        $size = $file->getSize();
        // $path = public_path($folder . '/' . $hashName);
        // $tmpPath = public_path($tmpFolder . '/' . $hashName);
        // if (!file_exists($folder)) {
        //     mkdir($folder);
        // }
        // $accepted = request()->has('accepted') && !empty(request()->accepted) ? request()->accepted : 'jpg,jpeg,png,doc,docx,xls,xlsx,pdf';
        // $mimes = $this->determineMimetypes(explode(',', $accepted));
        // if (in_array($file->getClientMimeType(), $mimes)) {
        //     $file->move($tmpFolder, $hashName);
        //     $img = Image::make($tmpPath)->orientate();
        //     // $watermark = Image::make(storage_path('images/brand.png'))->resize(250, 125);
        //     // $img = $img->insert($watermark, 'bottom-right', 10, 10);
        //     $img = $img->save($path, 60);
        //     $size = $img->filesize();
        //     File::delete($tmpPath);
        // }

        return compact('hashName', 'originalName', 'folder', 'extension', 'mimetype', 'size');
    }

    private function determineMimetypes(array $extensions)
    {
        $mimes = [];
        foreach ($extensions as $extension) {
            switch ($extension) {
                case 'jpg':
                    array_push($mimes, 'image/jpeg');
                    break;
                case 'jpeg':
                    array_push($mimes, 'image/jpeg');
                    break;
                case 'png':
                    array_push($mimes, 'image/png');
                    break;
                case 'doc':
                    array_push($mimes, 'application/msword');
                    break;
                case 'doc':
                    array_push($mimes, 'application/msword');
                    break;
                case 'docx':
                    array_push($mimes, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                    break;
                case 'xls':
                    array_push($mimes, 'application/vnd.ms-excel');
                    break;
                case 'xlsx':
                    array_push($mimes, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    break;
                case 'pdf':
                    array_push($mimes, 'application/pdf');
                    break;
                default:
                    abort(404, 'L\'extension ' . $extension . ' n\'est pas prise en charge.');
                    break;
            }
        }
        return $mimes;
    }

    private function storeInDatabase(StoreRequest $request, UploadedFile $file)
    {
        $folder = $request->folder;
        extract($this->uploadFile($file, $folder));
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

        return $uploadedFile;
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
                return response()->json([
                    'payload' => $media,
                    'message' => DELETE_ERROR,
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'message' => DELETE_ERROR,
                    'status' => false,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}