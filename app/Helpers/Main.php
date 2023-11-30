<?php

use App\Models\ControlCampaign;
use App\Models\Domain;
use App\Models\Dre;
use App\Models\Family;
use App\Models\Mission;
use App\Models\User;
use App\Rules\IsAlgerianPhoneNumber;
use Carbon\Carbon;
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
        $role = $user->role->code;
        if (is_array($roles)) {
            return in_array($role, $roles);
        } else {
            return $role == $roles;
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
                if (is_array($item)) {
                    $id = isset($item[$id]) ? $item[$id] : $item;

                    $label = isset($item[$label]) ? $item[$label] : $item;
                } elseif ($item instanceof stdClass || gettype($item) == 'object') {
                    $id = isset($item->$id) ? $item->$id : $item;

                    $label = isset($item->$label) ? $item->$label : $item;
                }
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
     * @param Family|null $families
     *
     * @return array
     */
    function getPCF(?Family $families = null): array
    {
        $families = $families ? $families : new Family;
        $families = $families->orderBy('id', 'ASC')->with(['domains' => fn ($domain) => $domain->with(['processes' => fn ($process) => $process->without('control_points')])])->get()->toArray();
        return array_map(function ($family) {
            return [
                'id' => 'f-' . $family['id'] . '-' . $family['name'],
                'label' => $family['name'],
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
                }, $family['domains'])
            ];
        }, $families);
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
                    $ids = array_merge(Family::findOrFail($item[1])->processes->pluck('id')->toArray(), $ids);
                } else {
                    $ids = array_merge($ids, [intval($item[0])]);
                }
                return $ids;
            }, $pcf));
            $pcf = Validator::make($pcf, [
                '*' => 'exists:processes,id'
            ])->validated();
            // dd($pcf);

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
        $cdc = ControlCampaign::whereYear('start_date', $date);
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
            CASE WHEN COUNT(CASE WHEN md.major_fact > 0 THEN 1 ELSE NULL END) > 0 THEN 'Oui' ELSE 'Non' END AS major_fact,
            COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END) AS total_anomalies,
            COUNT(cp.id) as control_points_count,
            AVG(md.score) as avg_score,
            COUNT(md.id) AS total_mission_details,
            SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) AS scored_mission_details,
            (COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END) * 100) / NULLIF(COUNT(md.id), 0) AS anomalies_rate,
            (COUNT(md.score) * 100) / NULLIF(COUNT(md.id), 0) AS progress_status
        ");
        $processes = $processes->join('control_points as cp', 'p.id', '=', 'cp.process_id')
            ->join('domains as d', 'd.id', '=', 'p.domain_id')
            ->join('families as f', 'f.id', '=', 'd.family_id')
            ->join('mission_details as md', 'cp.id', '=', 'md.control_point_id')
            ->join('missions as m', 'm.id', '=', 'md.mission_id')
            ->groupBy('f.id', 'd.id', 'p.id', 'p.name', 'd.name', 'f.name')
            ->where('m.id', $mission->id);
        // dd($processes->get(), $mission->id);
        return $processes;
    }
}

if (!function_exists('loadAgencies')) {
    /**
     * @param array $data
     *
     * @return array
     */
    function loadAgencies(string|int|array $data)
    {
        if (is_array($data)) {
            $data = Arr::flatten(array_map(function ($item) {
                $item = explode('-', $item);
                $ids = [];
                if ($item[0] == 'd') {
                    $ids = array_merge(Dre::findOrFail($item[1])->agencies->pluck('id')->toArray(), $ids);
                } else {
                    $ids = array_merge($ids, [intval($item[0])]);
                }
                return $ids;
            }, $data));
        } elseif (is_integer($data)) {
            $ids = [];
            $data = array_merge($ids, [intval($data)]);
        } elseif (is_string($data) && str_starts_with($data, 'd-')) {
            $ids = [];
            $data = explode('-', $data);
            $data = array_merge(Dre::findOrFail($data[1])->agencies->pluck('id')->toArray(), $ids);
        }
        $data = Validator::make($data, [
            '*' => 'exists:agencies,id'
        ])->validated();
        return $data;
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
            } elseif ($item instanceof stdClass) {
                $item = json_decode(json_encode($item), true);
            }

            return $item;
        })->toArray();
    }
}

if (!function_exists('rememberKeyForCache')) {
    function rememberKeyForCache(?string $suffix = null)
    {
        return 'user_' . auth()->user()->id . '_' . $suffix;
        // $url = request()->url();
        // $queryParams = request()->query();
        // ksort($queryParams);
        // $queryString = http_build_query($queryParams);
        // $fullUrl = "{$url}?{$queryString}";
        // $rememberKey = sha1($fullUrl);
        // return $prefix ? $prefix . '_user_' . auth()->user()->id . '_' . $rememberKey : '_user_' . auth()->user()->id . $rememberKey;
    }
}

if (!function_exists('sanitizeString')) {
    function sanitizeString(?string $string)
    {
        $string = strip_tags($string);
        // $nbsp = html_entity_decode("&nbsp;");
        $string = str_replace('&nbsp;', " ", $string);
        return $string;
    }
}


if (!function_exists('flattenArray')) {
    function flattenArray($nestedArray)
    {
        $result = [];

        foreach ($nestedArray as $item) {
            foreach ($item as $key => $value) {
                if (array_key_exists($key, $result)) {
                    // If the key already exists, combine values into an array
                    if (!is_array($result[$key])) {
                        $result[$key] = [$result[$key]];
                    }
                    $result[$key][] = $value;
                } else {
                    // If the key doesn't exist, set the value
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }
}

if (!function_exists('validateFields')) {
    /**
     * @param mixed $fields
     * @param mixed $data
     * @param bool $multipleFields
     * @param string|int|null $rowKey
     *
     * @return void
     */
    function validateFields($fields, $data, bool $multipleFields = false, string|int $rowKey = null)
    {
        // dd($fields, $data, $multipleFields, $rowKey);
        foreach ($fields as $key => $field) {
            $maxLength = $field->max_length;
            $minLength = $field->min_length;
            $required = $field->required;
            $is_integer_or_float = $field->is_integer_or_float;
            $is_multiple = $field->is_multiple;
            $distinct = $field->distinct;
            $additional_rules = $field->additional_rules ?: [];
            $type = $field->type;
            $name = $field->name;

            if ($required) {
                $additional_rules = array_merge($additional_rules, ['required']);
            } else {
                $additional_rules = array_merge($additional_rules, ['nullable']);
            }

            if ($distinct) {
                $additional_rules = array_merge($additional_rules, ['distinct']);
            }

            if ($type == 'number') {
                if (!$is_integer_or_float) {
                    $additional_rules = array_merge($additional_rules, ['integer']);
                } else {
                    $additional_rules = array_merge($additional_rules, ['numeric']);
                }

                if ($maxLength) {
                    $additional_rules = array_merge($additional_rules, ['max_digits:' . $maxLength]);
                }

                if ($maxLength) {
                    $additional_rules = array_merge($additional_rules, ['min_digits:' . $maxLength]);
                }
            }

            if ($type == 'select') {
                if ($is_multiple) {
                    $additional_rules = array_merge($additional_rules, ['array']);
                } else {
                    $additional_rules = array_merge($additional_rules, ['string']);
                }
            }

            if ($type == 'date') {
                $additional_rules = array_merge($additional_rules, ['date_format:Y-m-d']);
            }

            if ($type == 'month') {
                $additional_rules = array_merge($additional_rules, ['date_format:Y-m']);
            }

            if ($type == 'time') {
                $additional_rules = array_merge($additional_rules, ['date_format:H:i:s']);
            }

            if ($type == 'datetime-local') {
                $additional_rules = array_merge($additional_rules, ['date_format:Y-m-d\TH:i:s']);
            }

            if ($type == 'week') {
                $additional_rules = array_merge($additional_rules, ['date']);
            }

            if ($type == 'email') {
                $additional_rules = array_merge($additional_rules, ['email']);
            }

            if ($type == 'tel') {
                $additional_rules = array_merge($additional_rules, [new IsAlgerianPhoneNumber]);
            }

            if (in_array($type, ['text', 'textarea'])) {
                $additional_rules = array_merge($additional_rules, ['string']);

                if ($maxLength) {
                    $additional_rules = array_merge($additional_rules, ['max:' . $maxLength]);
                }
                if ($minLength) {
                    $additional_rules = array_merge($additional_rules, ['min:' . $maxLength]);
                }
            }

            if ($minLength) {
                $additional_rules = array_merge($additional_rules, ['min:' . $maxLength]);
            }

            if ($multipleFields) {
                $computedName = 'rows.' . $rowKey . '.metadata.*.' . $key . '.' . $name;
            } else {
                $computedName = 'metadata.*.' . $key . '.' . $name;
            }

            // dd($data, $computedName, $additional_rules);
            Validator::make($data, [$computedName => $additional_rules])->validate();
        }
    }
}

if (!function_exists('parseMetadata')) {
    function parseMetadata(string|int $metadatableId, string $metadatableType)
    {
        // $model = new $metadatableType;
        // $tableName = $model->getTable();
        // $primaryKey = $model->getKeyName();
        // $metadata = DB::table('metadata', 'm')->select(['metadatable_id', 'metadatable_type', 'field_id', 'm.value', 'f.label', 'f.type'])
        //     ->leftJoin('fields as f', 'f.id', 'm.field_id')
        //     ->leftJoin($tableName, $tableName . '.' . $primaryKey, 'm.metadatable_id')
        //     ->where('metadatable_type', $metadatableType)
        //     ->where('metadatable_id', $metadatableId)
        //     ->get();

        // $headings = $metadata->groupBy('label')->keys();
        // $total_lines = $metadata->groupBy('field_id')->count() ? $metadata->groupBy('field_id')->count() / 2 : $metadata->groupBy('field_id')->count();

        // $lines = collect([]);
        // for ($i = 0; $i < $total_lines; $i++) {
        //     $line = new stdClass;
        //     for ($j = 0; $j < count($headings); $j++) {
        //         $heading = $j;
        //         $cursor = $i == 0 ? $i + $j : ($i * $j) + count($headings);
        //         $line->$heading = $metadata[$cursor]->value;
        //     }

        //     $lines->push($line);
        // }
        $headings = [];
        $total_lines = 0;
        $lines = [];
        return compact('headings', 'total_lines', 'lines');
    }
}
