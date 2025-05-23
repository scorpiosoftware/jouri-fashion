<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreSections extends Model
{
    protected $fillable = ['name','name_ar'];


    public function products():HasMany{
       return $this->hasMany(Product::class,'section_id');
    }

    public function branches():HasMany{
        return $this->hasMany(Branch::class,'section_id');
     }
}
