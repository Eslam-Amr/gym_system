<?php

namespace App\Http\Controllers\Admin\Program;

use App\Models\Program;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::paginate(config('pagination.count'));
        return  view('admin.programs.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('admin.programs.create');
    }

public function store(StoreProgramRequest $request)
{
    // dd($request->all());
    // Begin a database transaction
    DB::beginTransaction();

    try {
        // Validate and retrieve the input data
        $data = $request->validated();
        $data['remain_place'] = $data['limit'];

        // Retrieve the benefits data from the request
        $benefits = $request->input('fields', []);

        // Create the program
        $program = Program::create($data);

        // Prepare the benefits data for insertion
        $benefitsData = [];
        foreach ($benefits as $benefit) {
            $benefitsData[] = ['benfit' => $benefit];
        }

        // Associate the benefits with the program using createMany
        $program->benfits()->createMany($benefitsData);

        // Commit the transaction
        DB::commit();

        // Redirect with success message
        return redirect()->route('admin.programs.index')->with('success', __("keywords.created_successfully"));
    } catch (\Exception $e) {
        // Rollback the transaction in case of exception
        DB::rollBack();
        // dd($e->getMessage());
  return redirect()->back()->with('error', __("keywords.creation_failed"));
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('admin.programs.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateProgramRequest $request, Program $program)
    // {



    //     $benefits = $request->input('fields', []);
    //     $benefitsData = [];
    //     foreach ($benefits as $benefit) {
    //         $benefitsData[] = ['benfit' => $benefit];
    //     }
    //     $program->benfits()->updateOrCreate($benefitsData);

    //     $program->update($request->validated());
    //     return redirect()->route('admin.programs.index')->with('success', __("keywords.updated_successfully"));
    // }
    public function update(UpdateProgramRequest $request, Program $program)
{
    // Validate the request data
    $validatedData = $request->validated();

    // Retrieve the benefits data from the request
    $benefits = $request->input('fields', []);

    // Prepare the benefits data for updating
    $benefitsData = [];
    foreach ($benefits as $benefit) {
        $benefitsData[] = ['benfit' => $benefit];
    }

    // Update the existing benefits associated with the program
    $program->benfits()->delete(); // Remove existing benefits
    $program->benfits()->createMany($benefitsData); // Add new benefits

    // Update the program with the validated data
    $program->update($validatedData);

    // Redirect to the index route with a success message
    return redirect()->route('admin.programs.index')->with('success', __("keywords.updated_successfully"));
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', __("keywords.deleted_successfully"));
    }
}
