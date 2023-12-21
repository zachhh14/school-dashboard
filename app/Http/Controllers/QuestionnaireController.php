<?php

namespace App\Http\Controllers;

use App\Imports\QuestionnaireImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionnaireController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new QuestionnaireImport($request->quiz_id), $request->file);

        return response()->json([
            'message' => 'File imported successfully',
        ]);
    }
}
