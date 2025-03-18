<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:subjects',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:subjects,code,' . $subject->id,
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}