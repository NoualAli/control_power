<?php

namespace App\Http\Controllers;

use App\Imports\ControlPointsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReaderController extends Controller
{
    public function __invoke()
    {
        Excel::import(new ControlPointsImport, public_path('pcf.xlsx'));
    }
}
