<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;                                                                                            
use App\Models\Category;                                                                                           
                           

class JobListing extends Model
{
    protected $fillable = [                                                                                            
       'company_id',                                                                                                  
       'category_id',                                                                                                 
       'title',                                                                                                       
       'slug',                                                                                                        
       'description',                                                                                                 
       'salary_min',                                                                                                  
       'salary_max',                                                                                                  
       'job_type',                                                                                                    
       'work_mode',                                                                                                   
       'experience',                                                                                                  
       'is_urgent',                                                                                                   
       'status',                                                                                                      
       'logo',   
   ];     

       public function company()                                                                                      
       {                                                                                                              
           return $this->belongsTo(Company::class);                                                                   
       }                                                                                                              
                                                                                                                      
       public function category()                                                                                     
       {                                                                                                              
           return $this->belongsTo(Category::class);                                                                  
       }   
}
