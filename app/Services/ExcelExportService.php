<?php

namespace App\Services;

use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExportService
{

    private $model;

    private $excelClass;

    private $filename;

    private $config;

    public function __construct($model, string $excelClass, string $filename = 'export_excel.xlsx', array $config = [])
    {
        $this->model = $model;
        $this->excelClass = $excelClass;
        $this->filename = $filename;
        $this->config = $config;
    }

    public function download()
    {
        $model = $this->model;
        $config = $this->config;
        $excelClass = $this->excelClass;
        $filename = $this->filename;

        if (count($config)) {
            extract($config);
            $keep_filters = boolVal(intVal($keep_filters));
            $keep_sorting = boolVal(intVal($keep_sorting));
            $keep_search = boolVal(intVal($keep_search));
            $keep_current_page = boolVal(intVal($keep_current_page));
            $keep_current_pagination = boolVal(intVal($keep_current_pagination));
            $search_columns = isset($search_columns) ? $search_columns : [];

            if ($keep_filters) {
                $filters = request('filter');
                $model = $model->filter($filters);
            }

            if ($keep_sorting) {
                $sorting = request('sort');
                if ($sorting) {
                    $model = $model->sortByMultiple($sorting);
                }
            } else {
                $model = $model->reorder();
            }

            if ($keep_search) {
                $search = request('search');
                if ($search) {
                    $model = $model->search($search_columns, $search);
                }
            }

            if ($keep_current_pagination) {
                $perPage = request('perPage', 10);
                $page = request('page', 1);
                $model = $model->paginate($perPage, ['*'], 'page', $page);
                Paginator::currentPageResolver(function () use ($page) {
                    return (int) $page;
                });
            } else {
                $model = $model->get();
            }
        } else {
            $model = $model->get();
        }
        return Excel::download(new $excelClass($model), $filename);
    }
}
