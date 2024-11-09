<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = new Department;
        return view('department.form', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'nullable',
            'status' => 'required|in:1,0',
        ],[
            'name.required' => 'Department name is required.',
            'name.min' => 'Department name must be at least 5 chars.',
        ]);

        //$department = new Department;
        //$department->name = $request['name'];
        //$department->description = $request['description'];
        //$department->status = $request['status'];

        //$department = new Department;
        //$department->fill($request->all());

        $department = Department::create($request->all());
        $department->save();

        return redirect()->route('department.index')->with('message', 'New department has been created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('department.form', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'nullable',
            'status' => 'required|in:1,0',
        ],[
            'name.required' => 'Department name is required.',
            'name.min' => 'Department name must be at least 5 chars.',
        ]);

        $department->fill($request->all());
        $department->save();

        return redirect()->route('department.index')->with('message', 'Department has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('department.index')->with('message', 'Department has been deleted!');
    }
}
