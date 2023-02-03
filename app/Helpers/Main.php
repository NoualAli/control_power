<?php

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
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

if (!function_exists('abort_role')) {
    /**
     * Check if user has specific role with throw exception
     *
     * @param string|array $roles
     *
     * @return void
     */
    function abort_role(string|array $roles): void
    {
        abort_if(!hasRole($roles), 401, __('Whoops! You are not authorized to access this resource'));
    }
}

if (!function_exists('onlyRoot')) {
    function onlyRoot()
    {
        return abort_role('root');
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
    function formatForSelect(array $array = [], string $label = 'name', string $id = 'id')
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