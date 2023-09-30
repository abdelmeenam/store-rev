<?php

namespace App\Models;

use App\Rules\FilterForbiddenWords;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'parent_id'];

    // category validation rules
    public static function rules($id = 0)
    {
        return [
            //'name' => 'required|string|max:255|unique:categories,name,$id',
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('categories')->ignore($id),

                /**
                 * The field under validation must not be included in the given list of values.
                 * $attribute: The field under validation.
                 * $value: The value that is being validated.
                 * $fail: The Illuminate\Contracts\Validation\Validator instance.
                 */
                // function ($attribute, $value, $fail) {
                //     if ($value == 'forbidden word' || $value == 'another forbidden word') {
                //         $fail('The ' . $attribute . ' is forbidden.');
                //     }
                // }

                new FilterForbiddenWords(['forbidden', 'another forbidden word']),
            ],
            'description' => 'nullable|string|max:255|min:5',
            'parent_id' => ['int', 'nullable', 'exists:categories,id',],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'status' => 'required|in:active,archived',
        ];
    }
}
