<?php

namespace App\Traits;

trait IsSearchable
{
    public function scopeSearch($query, $search)
    {
        if (property_exists($this, 'searchable')) {
            if ($this->searchable == '*') {
                $searchable = $this->fillable;
            } else {
                $searchable = $this->searchable;
            }
            $i = 0;
            foreach ($searchable as $column) {
                if (strpos($column, '.')) {
                    $exploded = explode('.', $column);
                    $relation = $exploded[0];
                    $column = $exploded[1];
                    $tableName = $this->$relation()->getRelated()->getTable();
                    $clause = $i > 0 ? 'orWhereRelation' : 'whereRelation';
                    $query = $query->$clause($relation, $tableName . '.' . $column, 'LIKE', '%' . $search . '%');
                } else {
                    if ($column !== 'password') {
                        $clause = $i > 0 ? 'orWhere' : 'where';
                        $query = $query->$clause($column, 'LIKE', '%' . $search . '%');
                        // dd($query->toSql());
                    }
                }
                $i += 1;
            }
        }

        return $query;
    }
}