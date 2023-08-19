<?php

namespace App\Http\Controllers;

use App\Imports\ControlPointsImport;
use App\Imports\ReferencesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReaderController extends Controller
{
    public function loadPCF()
    {
        Excel::import(new ControlPointsImport, public_path('pcf.xlsx'));
    }

    public function loadReferences()
    {
        Excel::import(new ReferencesImport, public_path('references-list.xlsx'));
    }
}