<?php

namespace App\Models;

use App\Models\JobListing;  
use App\Models\User;                                                                                         
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [                                                                                        
           'name',                                                                                                    
           'logo',                                                                                                    
           'website',                                                                                                 
           'location',                                                                                                
           'slug',                                                                                                    
           'description',
           'user_id'                                                                                             
       ];      

    public function jobs()                                                                                         
    {                                                                                                              
        return $this->hasMany(JobListing::class);                                                                  
    } 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
