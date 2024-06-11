<?php


namespace App\Http\Controllers\Admin\Nutrition;

use Carbon\Carbon;
use App\Models\Nutrition;
use App\Models\Subscribe;
use App\Http\Requests\Upd;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNutritionRequest;
use App\Http\Requests\UpdateNutritionRequest;

class NutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $nutritions = NULL;
        $currentDate = Carbon::now();
        $subscribers = Subscribe::where('to', '>', $currentDate)->paginate();
        $nutritions = Nutrition::paginate(config('pagination.count'));
        return  view('admin.nutrition.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Nutrition $nutrition)
    {
        return  view('admin.nutrition.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNutritionRequest $request, Nutrition $nutrition)
    {
        $plan = json_decode($nutrition['plan'], true);
        foreach ($plan as $val) {
            if ($val['date'] == $request->date)
                return redirect()->back()->with('error', 'this date is already exist');
        }
        dd($request->all());
        dd($plan, $request->all(), $nutrition);
        $data = $request->validated();
        Nutrition::create($data);

        return redirect()->route('.index')->with('success', __("keywords.created_successfully"));
    }
    // public function store(){
    //     dd('asdf');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Nutrition $nutrition)
    {
        return view('admin.nutrition.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nutrition $nutrition)
    {
        return view('admin.nutrition.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNutritionRequest $request, Nutrition $nutrition)
    {
        $nutrition->update($request->validated());
        return redirect()->route('admin.nutrition.index')->with('success', __("keywords.updated_successfully"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nutrition $nutrition)
    {
        $nutrition->delete();
        return redirect()->route('admin.nutrition.index')->with('success', __("keywords.deleted_successfully"));
    }
}
