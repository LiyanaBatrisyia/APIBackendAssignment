<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\User;

use App\Exports\CsvExport;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facades\Excel;

class CsvFile extends Controller
{
    function index(){
        $data = UserModel::latest()->paginate(10);
        return view('csv_file_pagination', compact('data'))
            -> with('i', (request()->input('page', 1) -1)*10);
    }

    public function csv_export(){
        return Excel::download(new CsvExport, 'sample.xlsx');
    }

    public function csv_import(){

        $import = new CsvImport();
        Excel::import($import, request()->file('file'));
        return $import->result;
    }
}
