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
            $keep_current_pagination = boolVal(intVal($keep_current_pagination));

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
