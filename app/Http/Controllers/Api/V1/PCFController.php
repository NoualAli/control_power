<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PCF\StoreRequest;
use App\Http\Requests\PCF\UpdateRequest;
use App\Http\Resources\PCFResource;
use App\Models\Media;
use App\Models\Process;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PCFController extends Controller
{
    public function index()
    {
        $pcf = DB::table('media AS m')
            ->leftJoin('has_media AS hm', 'm.id', '=', 'hm.media_id')
            ->whereIn('m.category', ['circulaire', 'note', 'guide 1er niveau', 'lettre-circulaire'])
            ->select('m.id', 'm.size', 'm.category', 'm.hash_name', 'm.original_name', 'm.folder', DB::raw('COUNT(hm.media_id) AS relationship_count'))
            ->groupBy('m.id', 'm.size', 'm.category', 'm.hash_name', 'm.original_name', 'm.folder');

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        if ($filter) {
            $pcf = $this->filter($pcf, $filter);
        }

        if ($sort) {
            $pcf = $pcf->sortByMultiple($sort);
        }
        if ($search) {
            $pcf = $pcf->search(['m.original_name'], $search);
        }

        $pcf = $fetchAll ? formatForSelect($pcf->get()->toArray(), 'original_name') : PCFResource::collection($pcf->paginate($perPage)->onEachSide(1));

        return $pcf;
    }

    public function show(string $media)
    {
        $media = DB::table('media')->select('payload')->where('id', $media)->get()->first();
        $media->payload = json_decode($media->payload, true);
        $payload = $media->payload;
        $media->number = isset($payload['number']) ? $payload['number'] : null;
        $media->date = isset($payload['date']) ? Carbon::parse($payload['date'])->format('d-m-Y') : null;
        $media->object = isset($payload['object']) ? $payload['object'] : null;
        unset($media->payload);
        return $media;
    }

    public function store(StoreRequest $request)
    {
        try {
            $result = DB::transaction(function () use ($request) {
                $data = $request->validated();
                $processes = [];
                $media_id = $request->media;
                unset($data['media']);
                $payload = json_encode($data) ?: null;

                $media = Media::findOrFail($media_id);
                if (isset($data['pcf'])) {
                    $processes = pcfToProcesses($data['pcf']);
                    unset($data['pcf']);
                    foreach ($processes as $process) {
                        DB::table('has_media')->insert([
                            'media_id' => $media->id,
                            'attachable_type' => Process::class,
                            'attachable_id' => $process
                        ]);
                    }
                }

                return $media->update(['payload' => $payload, 'category' => $data['category']]);
            });

            return actionResponse($result, "Texte réglementaire ajouter avec succès", CREATE_ERROR, $result ? SERVER_SUCCESS : SERVER_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    public function info(?string $media_id = null)
    {
        $media_pcf = [];
        $media = null;
        $pcf = getPCF();
        if ($media_id) {
            $media = getSingleMedia($media_id);
            $media_pcf = DB::table('has_media')->where('media_id', $media_id)->where('attachable_type', Process::class)->get()->pluck('attachable_id')->toArray();
        }

        return compact('pcf', 'media_pcf', 'media');
    }

    public function update(UpdateRequest $request, string $media_id)
    {
        try {
            $result = DB::transaction(function () use ($request, $media_id) {
                $data = $request->validated();
                $processes = [];
                unset($data['media']);
                $payload = json_encode($data) ?: null;

                $media = Media::findOrFail($media_id);
                if (isset($data['pcf'])) {
                    $processes = pcfToProcesses($data['pcf']);
                    unset($data['pcf']);
                    foreach ($processes as $process) {
                        DB::table('has_media')->updateOrInsert([
                            'media_id' => $media->id,
                            'attachable_type' => Process::class,
                            'attachable_id' => $process
                        ]);
                    }
                }

                return $media->update(['payload' => $payload, 'category' => $data['category']]);
            });

            return actionResponse($result, "Texte réglementaire mis à jour avec succès", UPDATE_ERROR, $result ? SERVER_SUCCESS : SERVER_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    public function destroy(string $media_id)
    {
        try {
            $result = DB::transaction(function () use ($media_id) {
                $file = DB::table('media')->where('id', $media_id)->first();
                $path = storage_path('app\\public\\' . $file->folder . '\\' . $file->hash_name);
                $result = DB::table('media')->where('id', $media_id)->delete();
                $unlink = true;
                if (file_exists($path) && $result) {
                    $unlink = unlink($path);
                }
                return $result && $unlink;
            });

            return actionResponse($result, "Le texte réglementaire a été supprimer avec succès", DELETE_ERROR, $result ? SERVER_SUCCESS : SERVER_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * @param Builder $media
     * @param array $filter
     *
     * @return Builder
     */
    private function filter(Builder $media, array $filter): Builder
    {
        if (isset($filter['category'])) {
            $categories = explode(',', $filter['category']);
            $media = $media->whereIn('category', $categories);
        }
        return $media;
    }
}
