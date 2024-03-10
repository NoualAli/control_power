<?php

namespace App\DB\Repositories;

use Exception;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use stdClass;

abstract class BaseRepository
{
    /**
     * @var \Illuminate\Database\Query\Builder
     */
    protected $query;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $idKey = 'id';

    /**
     * @var bool
     */
    protected $withTrash = false;

    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @var array
     */
    protected $default_sorting = [];

    /**
     * @var App\Models\User
     */
    protected $active_user;

    /**
     * BaseRepository constructor.
     */
    public function __construct(?string $table = null, ?string $alias = null)
    {
        if (!$table) {
            $table = Str::snake(Str::pluralStudly(str_replace('Repository', '', class_basename($this))));
        }
        $this->alias = $alias ?: implode('', array_map(fn ($item) => $item[0], explode(' ', $table)));
        $table = !empty($this->alias) ? $table . ' AS ' . $this->alias : $table;

        $this->query = DB::table($table);
        $this->active_user = auth()->user();
    }

    public function multiple(): Builder
    {
        return $this->query;
    }

    public function single(int|string $id, string $attribute = 'id', bool $first = true, string $latestAttribute = 'created_at'): stdClass
    {
        $this->query = $this->query->where($attribute, $id);

        if ($first) {
            return $this->query->first();
        }
        return $this->query->latest($latestAttribute);
    }

    public function sort($sort)
    {
        extract($sort);

        if ($sort) {
            $this->query->sortByMultiple($sort);
        } else {
            if (isset($default)) {
                foreach ($default as $key => $value) {
                    $this->query = $this->query->orderBy($key, $value);
                }
            }
        }
    }

    public function search($search)
    {
        extract($search);
        $this->query->search($columns, $value);
    }

    public function all(): Collection
    {
        return $this->query->get();
    }

    public function create(array $attributes, $id = 'id'): stdClass
    {
        $this->query->insert($attributes);
        if (isset($attributes[$id])) {
            $this->query = $this->query->where($id, $attributes[$id]);
        } else {
            foreach ($attributes as $key => $value) {
                $this->query = $this->query->where($key, $value);
            }
        }
        return $this->query->get()->first();
    }

    public function delete(int $id, ?string $key = null)
    {
        $key = $key ?: $this->idKey;
        if (!$key) {
            throw new Exception("Aucune clé d'identifiant n'a été mentionée");
        }
        return $this->query->where($key, $id)->delete();
    }
}
