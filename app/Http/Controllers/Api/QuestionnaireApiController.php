<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $validated = $request->validated();

        Questionnaire::create([
            'quiz_id' => $validated['quiz_id'],
            'question' => $validated['question'],
            'answer' => $validated['answer'],
        ]);

        return response()->json([
            'message' => 'Questionnaire created succesfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Questionnaire $questionnaire)
    {
        return response()->json($questionnaire);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Questionnaire::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $question->update($validated);

        return response()->json([
            'message' => 'Question updated succesfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Questionnaire::destroy($id);

        return response()->json([
            'message' => 'Questionnaire deleted succesfully',
        ]);
    }
}
