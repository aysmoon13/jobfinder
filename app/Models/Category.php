<?php

namespace App\Models;

use App\Models\JobListing;                                                                                         
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];  
    
    public function jobs()                                                                                         
    {                                                                                                              
        return $this->hasMany(JobListing::class);                                                                  
    }   

}
