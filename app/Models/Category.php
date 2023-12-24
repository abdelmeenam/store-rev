<?php

namespace App\Models;

use App\Rules\FilterForbiddenWords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'parent_id'];


    //local scopes for filtering
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }
    public function scopeStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }
    public function scopeFilter( Builder $query, $filters)
    {
        //dd($filters['name'] , $filters['status']);                            // query parameters
        // if (isset($filters['name']) && $filters['name'] != '') {
        //     $query->where('name', 'LIKE', '%'. $filters['name']. '%');
        // }
        // if (isset($filters['status']) && $filters['status']!= '') {
        //     $query->where('status', $filters['status']);
        // }
        // return $query;

        // another method using when() method , when ( if this condition true the 2nd argument will fire , closure function )
        $query->when($filters['name'] ?? false , function($query , $name){
            $query->where('categories.name', 'LIKE', '%'. $name. '%');
        });
        $query->when($filters['status']?? false, function($query, $status){
            $query->where('categories.status', $status);
        });

        return $query;
    }




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
