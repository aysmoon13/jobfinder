<?php

namespace App\Models;


use App\Models\JobListing;  
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
     protected $fillable = [                                                                                        
           'user_id',                                                                                                 
           'job_listing_id',                                                                                          
           'cover_letter',                                                                                            
           'resume_path',                                                                                             
           'status'                                                                                                   
       ];                                                                                                             
                                                                                                                      
       public function user() {                                                                                       
           return $this->belongsTo(User::class);                                                                      
       }                                                                                                              
                                                                                                                      
       public function jobListing() {                                                                                 
           return $this->belongsTo(JobListing::class);                                                                
       }   
}
