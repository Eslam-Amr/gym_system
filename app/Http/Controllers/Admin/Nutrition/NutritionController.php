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
        // dd($request->all());
        $nutrition = $subscribe->nutrition;

        // Instantiate the custom request with parameters
        $customRequest = app(StoreNutritionRequest::class);

        // Set the dynamic parameters
        $customRequest->setMaxDate($subscribe->to);
        $customRequest->setCreatedAt($subscribe->created_at->format('Y-m-d'));
        // Manually validate the request
        $validator = Validator::make($request->all(), $customRequest->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = (object) $validator->validated();

        $plan = json_decode($nutrition['plan'], true);
        foreach ($plan as $val) {
            if ($val['date'] == $validated->date) {
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
     * Store a newly created resource in storage.
     */
    // public function store(StoreNutritionRequest $request, Subscribe $subscribe)
    // public function store(Request $request, Subscribe $subscribe)
    // {
    //     $nutrition=$subscribe->nutrition;

    //     // $request = $request->validated();
    // $customRequest = new StoreNutritionRequest($subscribe->to, $subscribe->created_at->format('y-d-m'));

    // // Manually validate the request
    // $validator = \Validator::make($request->all(), $customRequest->rules());

    // if ($validator->fails()) {
    //     return redirect()->back()->withErrors($validator)->withInput();
    // }
    // $validated = $validator->validated();

    // $plan = json_decode($nutrition['plan'], true);
    // foreach ($plan as $val) {
    //     if ($val['date'] == $validated->date)
    //         return redirect()->back()->with('error', 'this date is already exist');
    // }

    // $fields = json_decode($validated->fields, true);
    //     $newFields=['date'=>$validated->date,'meal'=>$fields];
    //     $plan[]=$newFields;
    //     $newPlan = json_encode($plan);
    //     $nutrition->plan=$newPlan;
    //     $nutrition->save();

    //     return redirect()->route('admin.nutritions.index')->with('success', __("keywords.created_successfully"));
    //     }
    // $test2 = json_decode($test,True);
        // dd($subscribe,$subscribe->created_at->format('y-d-m'));
    //     $request = (new StoreNutritionRequest($subscribe->to,$subscribe->created_at->format('y-d-m')));
    //      // Manually validate the request
    // $request = \Validator::make($request->all(), $request->rules());

    // if ($request->fails()) {
    //     return redirect()->back()->withErrors($request)->withInput();
    // }
        // dd($test,$test2);
        // dd($z=json_decode($request->fields,true)[0],$request->all());
        // $y=['meal'=>$z['name']];
        // $plan[count($plan)] = [
        //     'date' => $request->date,
        //     // 'plan' => (json_decode($request->field,true))[0]
        // ];
        //         dd($plan, $request->all(), $nutrition);
        // $newPlan=$plan +json_decode($request->fields,true);
        // dd($newPlan);
        // $decodedFields = json_decode($request->fields, true);

// Create a new entry in the $plan array
// $plan[] = [
//     'date' => $request->date,
//     // You might want to define 'plan' here based on your requirements
// ];

// Debugging

// Merge $plan with the decoded fields
// $newPlan = array_merge($plan, $decodedFields);
// dd($newPlan,$plan, $request->all(), $nutrition);

        // $data = $request->validated();
        // Nutrition::createOrUpdate($data);
        // $nutrition->createOrUpdate($data);
        // public function store(){
            //     dd('asdf');
    // }

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
