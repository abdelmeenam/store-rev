<?php

namespace App\Models;

use Auth;
use App\Models\Store;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Vendor extends User
{
    use HasFactory, SoftDeletes, Notifiable;
    protected $fillable = ['name', 'email', 'password', 'phone', 'active', 'store_id'];

    protected static function booted()
    {
        // first method when i have to listen to single event
        static::creating(function (Vendor $vendor) {
            $vendor->password = Hash::make($vendor->password);
        });

        static::updating(function (Vendor $vendor) {
            $vendor->password = Hash::make($vendor->password);
        });
    }

    public static function rules($id = 0)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('vendors')->ignore($id)],
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'store_id' => 'required|exists:stores,id',
            'active' => 'boolean',
        ];
    }

    // Each vendor belongs to a store
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    // Accessor for the 'active' attribute
    public function getStatusAttribute()
    {
        return $this->active ? 'Active' : 'Inactive';
    }
}
