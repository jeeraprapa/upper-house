<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;

class QuestionnaireController extends Controller
{
    function index()
    {
        $questionnaires = Questionnaire::latest()->paginate(20);
        return view('admin.questionnaires.index', compact('questionnaires'));
    }

    function exportExcel()
    {
        $filename = 'questionnaires_' . now()->format('Ymd_His') . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\QuestionnaireExport(), $filename);
    }
}
