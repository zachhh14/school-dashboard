<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectPostRequest;
use App\Models\Subject;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('subject/Index',[
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('subject/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function soldtore(Request $request)
    {
        Subject::create([
            'user_id' => $request->userId,
            'subject_code' => $request->subjectCode,
            'subject_name' => $request->subjectName,
        ]);

        return redirect()->route('subjects.index');
    }

    public function store(SubjectPostRequest $request)
    {
        $validated = $request->validated();

        Subject::create([
            'user_id' => $validated['userId'],
            'subject_code' => $validated['subjectCode'],
            'subject_name' => $validated['subjectName'],
        ]);

        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
