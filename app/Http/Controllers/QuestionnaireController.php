<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function create()
    {
        return view('questionnaire');
    }

    public function store(Request $request)
    {
        // ตัวอย่าง validate (ปรับตามจริง)
        $data = $request->validate([
            'unit_interest' => ['required','array'],
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'contact_number' => ['required','string','max:50'],
            'country_of_residence' => ['required','string','max:255'],
            'remark' => ['nullable','string'],

            'consent_transfer' => ['required','boolean'],
            'consent_citydynamic_marketing' => ['required','boolean'],
            'consent_affiliate_marketing' => ['required','boolean'],

//            'signature' => ['required','string','max:255'],
//            'printed_name' => ['required','string','max:255'],
//            'signed_date' => ['required','date'],
        ]);

        //check is login
        if (auth()->check()) {
            $data['created_by'] = auth()->id();
        }


         Questionnaire::create($data);

        return back()->with('success', 'Thank you for submitting the questionnaire!');
    }
}
