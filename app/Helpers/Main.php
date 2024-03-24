<?php

use App\Http\Resources\UserResource;
use App\Models\Domain;
use App\Models\Structures\Dre;
use App\Models\Family;
use App\Models\Structures\RegionalInspection;
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
    function hasRole(string|array $roles, User|string $user = null): bool
    {
        $user = $user ? $user : auth()->user();
        $role = is_string($user) ? $user : $user?->role?->code;
        if ($role) {
            if (is_array($roles)) {
                return in_array($role, $roles);
            } else {
                return $role == $roles;
            }
        }
        return false;
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
        $userDres = $user->dres->pluck('full_name')->toArray();
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
    function generateCDCRef(bool $validated = false, ?string $date = null, bool $isForTesting = false)
    {
        $reference = '';
        $date = $date ? Carbon::parse($date)->format('Y') : today()->format('Y');
        $cdc = DB::table('control_campaigns', 'cc')->whereYear('start_date', $date)->whereNull('deleted_at')->where('is_for_testing', $isForTesting);
        if ($validated) {
            $totalValidated = $cdc->whereNotNull('validated_at')->whereNotNull('validated_by_id')->count();
        } else {
            $totalNotValidated = $cdc->whereNull('validated_at')->whereNull('validated_by_id')->count() + 1 ?: 1;
        }
        if (!$isForTesting) {
            if ($validated) {
                $reference = 'CDC-' . $date . '-' . addZero($totalValidated + 1);
            } else {
                $reference = 'CDC-' . $date . '-' . addZero($totalNotValidated) . '-tmp';
            }
        } else {
            if ($validated) {
                $reference = 'CDC-' . $date . '-' . addZero($totalValidated + 1) . '-test';
            } else {
                $reference = 'CDC-' . $date . '-' . addZero($totalNotValidated) . '-test-tmp';
            }
        }
        return $reference;
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
                }
                if ($item[0] == 'ri') {
                    $ids = array_merge(RegionalInspection::findOrFail($item[1])->agencies->pluck('id')->toArray(), $ids);
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
        } elseif (is_string($data) && str_starts_with($data, 'ri-')) {
            $ids = [];
            $data = explode('-', $data);
            $data = array_merge(RegionalInspection::findOrFail($data[1])->agencies->pluck('id')->toArray(), $ids);
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
        foreach ($fields as $key => $field) {
            $maxLength = $field->max_length;
            $minLength = $field->min_length;
            $required = $field->required;
            $is_integer_or_float = $field->is_integer_or_float;
            $is_multiple = $field->is_multiple;
            $distinct = $field->distinct;
            $additional_rules = $field->additional_rules ?: null;
            $type = $field->type;
            $name = $field->name;
            $label = strtolower($field->label);
            $rules = [];
            $messages = [];
            $computedName = 'metadata.*.' . $key . '.' . $name;
            $computedNameWithoutKey = 'metadata.*.*.' . $name;

            if ($required) {
                $rules = array_merge($rules, ['required']);
                $messages[$computedNameWithoutKey . '.required'] = 'Le champ ' . __($label) . ' est obligatoire.';
            } else {
                $rules = array_merge($rules, ['nullable']);
            }

            if ($distinct) {
                $rules = array_merge($rules, ['distinct']);
                $messages[$computedNameWithoutKey . '.required'] = 'Le champ ' . __($label) . ' a une valeur en double.';
            }

            if ($type == 'number') {
                if (!$is_integer_or_float) {
                    $rules = array_merge($rules, ['regex:/^[0-9]+$/']);
                    $messages[$computedNameWithoutKey . '.regex'] = 'Le champ ' . __($label) . ' doit être un nombre entier.';
                } else {
                    $rules = array_merge($rules, ['numeric']);
                    $messages[$computedNameWithoutKey . '.numeric'] = 'Le champ ' . __($label) . ' doit être un nombre.';
                }

                if ($maxLength) {
                    $rules = array_merge($rules, ['max_digits:' . $maxLength]);
                    $messages[$computedNameWithoutKey . '.max_digits'] = 'Le champ ' . __($label) . ' ne doit pas dépasser ' . $maxLength . ' chiffres.';
                }

                if ($minLength) {
                    $rules = array_merge($rules, ['min_digits:' . $minLength]);
                    $messages[$computedNameWithoutKey . '.max_digits'] = 'Le champ ' . __($label) . ' doit pas contenir en moin ' . $maxLength . ' chiffres.';
                }
            }

            if ($type == 'select') {
                if ($is_multiple) {
                    $rules = array_merge($rules, ['array']);
                    $messages[$computedNameWithoutKey . '.array'] = 'Le champ ' . __($label) . ' doit pas être un tableau.';
                } else {
                    $rules = array_merge($rules, ['string']);
                    $messages[$computedNameWithoutKey . '.array'] = 'Le champ ' . __($label) . ' doit pas être une chaine de caractères.';
                }
            }

            if ($type == 'date') {
                $rules = array_merge($rules, ['date_format:Y-m-d']);
                $messages[$computedNameWithoutKey . '.date_format'] = 'Le champ ' . __($label) . ' ne correspond pas au format :format.';
            }

            if ($type == 'month') {
                $rules = array_merge($rules, ['date_format:Y-m']);
                $messages[$computedNameWithoutKey . '.date_format'] = 'Le champ ' . __($label) . ' ne correspond pas au format :format.';
            }

            if ($type == 'time') {
                $rules = array_merge($rules, ['date_format:H:i:s']);
                $messages[$computedNameWithoutKey . '.date_format'] = 'Le champ ' . __($label) . ' ne correspond pas au format :format.';
            }

            if ($type == 'datetime-local') {
                $rules = array_merge($rules, ['date_format:Y-m-d\TH:i:s']);
                $messages[$computedNameWithoutKey . '.date_format'] = 'Le champ ' . __($label) . ' ne correspond pas au format :format.';
            }

            if ($type == 'week') {
                $rules = array_merge($rules, ['date']);
                $messages[$computedNameWithoutKey . '.date'] = 'Le champ ' . __($label) . ' n\'est pas une date valide.';
            }

            if ($type == 'email') {
                $rules = array_merge($rules, ['email']);
                $messages[$computedNameWithoutKey . '.email'] = 'Le champ ' . __($label) . ' doit être une adresse e-mail valide.';
            }

            if ($type == 'tel') {
                $rules = array_merge($rules, [new IsAlgerianPhoneNumber]);
                $messages[$computedNameWithoutKey . '.tel'] = 'Le champ ' . __($label) . ' doit être un n° de téléphone algérien valide.';
            }

            if (in_array($type, ['text', 'textarea'])) {
                $rules = array_merge($rules, ['string']);
                $messages[$computedNameWithoutKey . '.string'] = 'Le champ ' . __($label) . ' doit être une chaine de caractère.';

                if ($maxLength) {
                    $rules = array_merge($rules, ['max:' . $maxLength]);
                    $messages[$computedNameWithoutKey . '.max'] = 'Le champ ' . __($label) . ' ne peut contenir plus de :max caractères';
                }
                if ($minLength) {
                    $rules = array_merge($rules, ['min:' . $maxLength]);
                    $messages[$computedNameWithoutKey . '.min'] = 'Le champ ' . __($label) . ' doit contenir au moins :min caractères';
                }
            }

            if ($additional_rules) {
                $customRules = explode(',', $additional_rules);
                foreach ($customRules as $rule) {
                    $normailizedName = preg_replace('/_/', ' ', $rule);
                    $normailizedName = preg_split('/[ ]/', ucwords($normailizedName));
                    $normailizedName = implode('', $normailizedName) . 'Rule';
                    $class = "\App\Rules\\" . $normailizedName;
                    if (class_exists($class)) {
                        array_push($rules, new $class($label));
                    }
                }
            }

            Validator::make($data, [$computedName => $rules], $messages)->validate();
        }
    }
}

if (!function_exists('getUserFullNameWithRole')) {
    /**
     * Display user fullname with role code and martial status or not
     *
     * @param User|string|int|null $user
     * @param bool $withMartial
     *
     * @return string
     */
    function getUserFullNameWithRole(User|string|int $user = null, bool $withMartial = true, bool $abbreviated = false)
    {
        if ($user instanceof stdClass) {
            $user = $user->id;
        }

        if (is_integer($user) || is_string($user)) {
            $user = User::findOrFail($user);
        }

        $user = $user ?: auth()->user();
        if ($abbreviated) {
            return $withMartial ? $user->martial_status . ' ' . $user->abbreviated_name : $user->abbreviated_name;
        }
        $fullName = $withMartial ? $user?->full_name_with_martial : $user->full_name;
        return $fullName . ' (' . strtoupper($user->role->code) . ')';
    }
}

if (!function_exists('normalizeFullName')) {
    /**
     * Sanitize user fullname and remove role code
     *
     * @param string|null $fullName
     *
     * @return string
     */
    function normalizeFullName(?string $fullName)
    {
        if ($fullName) {
            $fullName = str_replace([' (CDC)', ' (CDCR)', ' (CC)', ' (DCP)', ' (DA)', ' (CI)'], '', $fullName);
            $fullNameParts = explode(' ', $fullName);
            $fullNameParts = array_map(function ($part) {
                return ucfirst(strtolower($part));
            }, $fullNameParts);

            $fullName = implode(' ', $fullNameParts);
        }

        return $fullName;
    }
}

if (!function_exists('daysRemainingStr')) {
    /**
     * Format diff in days to human string
     *
     * @param string $from
     * @param string|null $to
     *
     * @return string
     */
    function daysRemainingStr(string $from, ?string $to = null)
    {
        if ($from && $to) {
            $daysRemaining = $from > 1 ? $from . ' jours' : $from . ' jour';
            if ($from < 0 && $to) {
                return 'En cours';
            }
            return $to ? $daysRemaining : '-';
        }
        $daysRemaining = $from > 1 ? abs($from) . ' jours' : abs($from) . ' jour';
        return $from ? $daysRemaining : '-';
    }
}

if (!function_exists('formatNumber')) {

    /**
     * Format number
     *
     * @param string|int|float|null $number
     *
     * @return int|float
     */
    function formatNumber(string|int|float|null $number)
    {
        // Check if the number contains a "."
        if (strpos($number, '.') !== false) {
            // Convert to float
            $floatNumber = (float) $number;
            // Check if the decimal part is equal to 0
            if (intval($floatNumber) == $floatNumber) {
                // Convert to integer
                return (int) $floatNumber;
            } else {
                return $floatNumber;
            }
        } else {
            // Convert to integer
            return (int) $number;
        }
    }
}
