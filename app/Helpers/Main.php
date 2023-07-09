<?php

use App\Models\ControlCampaign;
use App\Models\Domain;
use App\Models\Familly;
use App\Models\Mission;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

if (!function_exists('isRoot')) {
    function isRoot()
    {
        return hasRole('root');
    }
}

if (!function_exists('isAbleTo')) {
    /**
     * Check if user has specific abilities
     * @param string|null $user
     * @param string|array $abilities
     *
     * @return bool
     */
    function isAbleTo(string|array $abilities): bool
    {
        $user = auth()->user();
        return $user->isAbleTo($abilities);
    }
}

if (!function_exists('isAbleOrAbort')) {
    /**
     * Check if user has specific abilities or abort
     *
     * @param string|array $abilities
     *
     * @return void
     */
    function isAbleOrAbort(string|array $abilities)
    {
        return abort_if(!isAbleTo($abilities), 401, __('unauthorized'));
    }
}

if (!function_exists('hasRole')) {
    /**
     * Check if user has specific role
     *
     * @param string|array $roles
     *
     * @return bool
     */
    function hasRole(string|array $roles, ?User $user = null): bool
    {
        $user = $user ? $user : auth()->user();
        $userRoles = $user->roles->pluck('code')->toArray();
        if (is_array($roles)) {
            $hasRole = [];
            foreach ($roles as $role) {
                array_push($hasRole, in_array($role, $userRoles));
            }
            return in_array(true, $hasRole);
        } else {
            return in_array($roles, $userRoles);
        }
    }
}

if (!function_exists('hasDre')) {
    /**
     * Check if user has specific dre
     *
     * @param string|array $dres
     *
     * @return bool
     */
    function hasDre(string|array $dres): bool
    {
        $user = auth()->user();
        $userDres = $user->dres->pluck('name')->toArray();
        if (is_array($dres)) {
            $hasDre = [];
            foreach ($dres as $dre) {
                array_push($hasDre, in_array($dre, $userDres));
            }
            return in_array(true, $hasDre);
        } else {
            return in_array($dres, $userDres);
        }
    }
}

if (!function_exists('hasRoleOrAbort')) {
    /**
     * Check if user has specific role with throw exception
     *
     * @param string|array $roles
     *
     * @return void
     */
    function hasRoleOrAbort(string|array $roles): void
    {
        abort_if(!hasRole($roles), 401, __('Whoops! You are not authorized to access this resource'));
    }
}

if (!function_exists('onlyRoot')) {
    function onlyRoot()
    {
        return hasRoleOrAbort('root');
    }
}


if (!function_exists('addZero')) {
    /**
     * Add 0 if number lower than 10
     *
     * @param string|integer $num
     *
     * @return string
     */
    function addZero($num)
    {
        return $num < 10 ? '0' . $num : $num;
    }
}

if (!function_exists('formatForSelect')) {
    /**
     * Formats a data table to make it usable directly at the <select> level
     *
     * @param array $array
     * @param string $label
     * @param string $id
     *
     * @return array
     */
    function formatForSelect(array $array = [], string $label = 'name', string $id = 'id'): array
    {
        if (!empty($array)) {
            $array = array_map(function ($item) use ($label, $id) {
                $id = isset($item[$id]) ? $item[$id] : $item;
                $label = isset($item[$label]) ? $item[$label] : $item;
                return [
                    'id' => $id,
                    'label' => $label,
                ];
            }, $array, $array);
        }
        return $array;
    }
}

if (!function_exists('paginate')) {

    /**
     * Wrapper to paginate data with LengthAwarePaginator
     *
     * @param Object $data
     * @param string $url
     * @param int $perPage
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    function paginate(Object $data, string $url, int $perPage = 10)
    {
        $data = collect($data);
        $url = env('APP_URL') . $url;
        $page = request()->has('page') ? request()->page : 1;
        return (new LengthAwarePaginator($data->forPage($page, $perPage), $data->count(), $perPage))->setPath($url)->onEachSide(1);
    }
}

if (!function_exists('getValidationRules')) {
    function getValidationRules()
    {
        $validator = Validator::make(array(), array());

        //
        $r = new ReflectionClass($validator);
        $methods = $r->getMethods();

        //filter down to just the rules
        $methods = array_filter($methods, function ($v) {
            if ($v->name == 'validate') {
                return false;
            }
            return strpos($v->name, 'validate') === 0;
        });

        //get the rule name, also if it has parameters
        return array_map(function ($v) {
            $value = preg_replace('%^validate%', '', $v->name);
            $value = Str::snake($value);

            $params = $v->getParameters();
            $last   = array_pop($params);
            if ($last && $last->name == 'parameters') {
                $value .= ':[params]';
            }
            return Str::snake($value);
        }, $methods);
    }
}

if (!function_exists('formatBytes')) {
    /**
     * Convet bytes to KB, MB, GB, TB
     *
     * @param int $size
     * @param bool $withSuffix
     * @param int $precision
     *
     * @return float|string
     */
    function formatBytes(int $size, bool $withSuffix = true, int $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
        $result = round(pow(1024, $base - floor($base)), $precision);
        return $withSuffix ? $result . ' ' . $suffixes[floor($base)] : $result;
    }
}

if (!function_exists('getPCF')) {
    /**
     * Fetch and format PCF array
     *
     * @param Familly|null $famillies
     *
     * @return array
     */
    function getPCF(?Familly $famillies = null): array
    {
        $famillies = $famillies ? $famillies : new Familly;
        $famillies = $famillies->orderBy('id', 'ASC')->with(['domains' => fn ($domain) => $domain->with(['processes' => fn ($process) => $process->without('control_points')])])->get()->toArray();
        return array_map(function ($familly) {
            return [
                'id' => 'f-' . $familly['id'] . '-' . $familly['name'],
                'label' => $familly['name'],
                'children' => array_map(function ($domain) {
                    return [
                        'id' => 'd-' . $domain['id'] . '-' . $domain['name'],
                        'label' => $domain['name'],
                        'children' => array_map(function ($process) {
                            return [
                                'id' => $process['id'],
                                'label' => $process['name'],
                            ];
                        }, $domain['processes'])
                    ];
                }, $familly['domains'])
            ];
        }, $famillies);
    }
}

if (!function_exists('pcfToProcesses')) {
    /**
     * Sanitize PCF array to extract and load only processes ids
     *
     * @param array|null $pcf
     *
     * @return array
     */
    function pcfToProcesses(?array $pcf = null): array
    {
        if ($pcf) {
            $pcf = Arr::flatten(array_map(function ($item) {
                $item = explode('-', $item);
                $ids = [];
                if ($item[0] == 'd') {
                    $ids = array_merge(Domain::findOrFail($item[1])->processes->pluck('id')->toArray(), $ids);
                } elseif ($item[0] == 'f') {
                    $ids = array_merge(Familly::findOrFail($item[1])->processes->pluck('id')->toArray(), $ids);
                } else {
                    $ids = array_merge($ids, [intval($item[0])]);
                }
                return $ids;
            }, $pcf));
            $pcf = Validator::make($pcf, [
                '*' => 'exists:processes,id'
            ])->validated();

            return $pcf;
        }
        return [];
    }
}

if (!function_exists('generateCDCRef')) {
    /**
     * Generate a new reference for control campaign
     *
     * @param bool $validate
     * @param string|null $date
     *
     * @return string
     */
    function generateCDCRef(bool $validate = false, ?string $date = null)
    {
        $reference = '';
        $date = $date ? Carbon::parse($date)->format('Y') : today()->format('Y');
        $cdc = ControlCampaign::whereYear('start', $date);
        if ($validate) {
            $reference = 'CDC-' . $date . '-' . addZero($cdc->validated()->count() + 1);
        } else {
            $reference = 'CDC-' . $date . '-' . addZero($cdc->max('id') + 1) . '-tmp';
        }
        return $reference;
    }
}

if (!function_exists('getMissionProcesses')) {
    /**
     * Load mission processes
     *
     * @param Mission $mission
     *
     * @return Illuminate\Database\Query\Builder
     */
    function getMissionProcesses(Mission $mission)
    {
        $processes = DB::table('processes as p');
        $processes = $processes->selectRaw("
            p.id as process_id,
            p.name as process,
            d.name as domain,
            f.name as family,
            f.id as family_id,
            d.id as domain_id,
            COUNT(cp.id) as control_points_count,
            AVG(md.score) as avg_score,
            FORMAT(MAX(md.controlled_at), 'dd-MM-yyyy') AS controlled_at,
            COUNT(md.id) AS total_mission_details,
            SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) AS scored_mission_details,
            (count(md.score) * 100) / COUNT(md.id) AS progress_status
        ");
        return $processes->join('control_points as cp', 'p.id', '=', 'cp.process_id')
            ->join('domains as d', 'd.id', '=', 'p.domain_id')
            ->join('famillies as f', 'f.id', '=', 'd.familly_id')
            ->join('mission_details as md', 'cp.id', '=', 'md.control_point_id')
            ->join('missions as m', 'm.id', '=', 'md.mission_id')
            ->groupBy('f.id', 'd.id', 'p.id', 'p.name', 'd.name', 'f.name')
            ->where('m.id', $mission->id);
    }
}

if (!function_exists('recursive_collect')) {
    function recursive_collect(array $array)
    {
        return collect($array)->map(function ($item) {
            if (is_array($item)) {
                return recursive_collect($item);
            }
            return $item;
        });
    }
}

if (!function_exists('recursivelyToArray')) {
    function recursivelyToArray($collection)
    {
        return $collection->map(function ($item) {
            if ($item instanceof Illuminate\Support\Collection) {
                $item = is_integer($item->keys()->first()) ?  recursivelyToArray($item->values()) : recursivelyToArray($item);
            } elseif (is_array($item)) {
                $item = recursivelyToArray(collect($item));
            }

            return $item;
        })->toArray();
    }
}
