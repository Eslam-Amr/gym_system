<?php


namespace App\Http\Controllers\Admin\Nutrition;

use Carbon\Carbon;
use App\Models\Nutrition;
use App\Models\Subscribe;
use App\Http\Requests\Upd;
// use Flasher\Laravel\Http\Request;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
    public function create(Subscribe $subscribe)
    {
        $nutrition=$subscribe->nutrition;
        return  view('admin.nutrition.create', get_defined_vars());
    }


    public function store(Request $request, Subscribe $subscribe)
    {
        $nutrition = $subscribe->nutrition;
         $validated = $request->validate([
            'date' => 'required|date|before_or_equal:' . $subscribe->to . '|after_or_equal:' . $subscribe->created_at->format('Y-m-d'),
            'fields' => 'required',
            'meals' => 'required|array',  // Ensure meals is an array
            'meals.*.name' => 'required', // Ensure each meal has a name
            'meals.*.items.*' => 'required', // Ensure each meal has an item
        ]);

        $plan = json_decode($nutrition['plan'], true);
        foreach ($plan as $val) {
            if ($val['date'] == $validated['date']) {
                return redirect()->back()->with('error', 'This date already exists');
                }
        }
// dd($validated );
        $fields = json_decode($request->fields, true);
        $newFields = ['date' => $request->date, 'meal' => $fields];
        $plan[] = $newFields;
        $newPlan = json_encode($plan);
        $nutrition->plan = $newPlan;
        $nutrition->save();

        return redirect()->route('admin.nutritions.index')->with('success', __("keywords.created_successfully"));
    }





    /**
     * Display the specified resource.
     */
    public function show(Nutrition $nutrition)
    {
        // dd($nutrition);
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
