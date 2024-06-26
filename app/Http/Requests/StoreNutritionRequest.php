<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNutritionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $maxDate;
    protected $createdAt;

    // Custom setter methods to allow passing parameters
    public function setMaxDate($maxDate)
    {
        $this->maxDate = $maxDate;
        // dd($this->maxDate);
    }

    public function setCreatedAt($createdAt)
    {
        // dd(2);
        $this->createdAt = $createdAt;
        }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this->maxDate,$this->createdAt);
        // dd(3);
        return [
            // 'date' => 'required|date|before_or_equal:2024-12-09 |after_or_equal:2024-12-06',
            'date' => 'required|date|before_or_equal:' . $this->maxDate .'after_or_equal:' . $this->createdAt,
            'fields'=>'required',
            'meals'=>'required',
            // 'meals.name'=>'required',
            // 'meals.item'=>'required',
            // 'date' => 'required|date|before_or_equal:' . $this->maxDate .'after_or_equal:' . $this->createdAt,
            // 'calories' => 'numeric',
            // 'carbs' => 'numeric',
            // 'protein' => 'numeric',
            // 'fat' => 'numeric',
            // 'sodium' => 'numeric',
            // 'sugar' => 'numeric',
            // 'saturated_fat' => 'numeric',
            // 'fiber' => 'numeric',
            // 'cholesterol' => 'numeric',
            // 'potassium' => 'numeric',

        ];
    }
}
