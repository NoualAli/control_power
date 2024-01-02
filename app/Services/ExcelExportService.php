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

            if ($keep_filters) {
                $filters = request('filter');
                $model = $model->filter($filters);
            }

            if ($keep_sorting) {
                $sorting = request('sort');
                $model = $model->sortByMultiple($sorting);
            }

            if ($keep_search) {
                $search = request('search');
                $model = $model->search($search);
            }

            if ($keep_current_pagination) {
                $perPage = request('perPage');
                if ($keep_current_page) {
                    $page = request('page');
                    $model = $model->paginate($perPage, ['*'], 'page', $page);
                    Paginator::currentPageResolver(function () use ($page) {
                        return (int) $page;
                    });
                } else {
                    $model = $model->paginate($perPage);
                }
            } else {
                $model = $model->get();
            }
        } else {
            $model = $model->get();
        }
        return Excel::download(new $excelClass($model), $filename);
    }
}
