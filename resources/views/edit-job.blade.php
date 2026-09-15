@extends('layouts.app')                                                                                            
                                                                                                                      
   @section('title', 'Edit Job')                                                                                      
                                                                                                                      
   @section('content')                                                                                                
   <div class="max-w-3xl mx-auto p-6">                                                                                
       <div class="card bg-base-100 shadow-xl">                                                                       
           {{-- Notice action uses PUT route --}}                                                                     
           <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="card-body"                        
 enctype="multipart/form-data">                                                                                       
               @csrf                                                                                                  
               @method('PUT') {{-- SPOOFING PUT METHOD --}}                                                           
                                                                                                                      
               <h2 class="text-2xl font-bold mb-4">Edit Listing</h2>                                                  
                                                                                                                      
               {{-- Title --}}                                                                                        
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text font-bold">Job Title</span></label>                   
                   {{-- Pre-fill with old input or $job->title --}}                                                   
                   <input type="text" name="title" value="{{ old('title', $job->title) }}"                            
                          class="input input-bordered" required>                                                      
               </div>                                                                                                 
                                                                                                                      
               {{-- Description --}}                                                                                  
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text font-bold">Description</span></label>                 
                   <textarea name="description" class="textarea textarea-bordered h-32" required>{{                   
 old('description', $job->description) }}</textarea>                                                                  
               </div>                                                                                                 
                                                                                                                      
               {{-- Job Type & Work Mode (Using Select) --}}                                                          
               <div class="grid grid-cols-1 md:grid-cols-2 gap-4">                                                    
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Job Type</span></label>                
                       <select name="job_type" class="select select-bordered" required>                               
                           <option value="full-time" {{ $job->job_type == 'full-time' ? 'selected' : '' }}>Full       
 Time</option>                                                                                                        
                           <option value="part-time" {{ $job->job_type == 'part-time' ? 'selected' : '' }}>Part       
 Time</option>                                                                                                        
                           <option value="contract" {{ $job->job_type == 'contract' ? 'selected' : ''                 
 }}>Contract</option>                                                                                                 
                           <option value="freelance" {{ $job->job_type == 'freelance' ? 'selected' : ''               
 }}>Freelance</option>                                                                                                
                       </select>                                                                                      
                   </div>                                                                                             
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Work Mode</span></label>               
                       <select name="work_mode" class="select select-bordered" required>                              
                           <option value="remote" {{ $job->work_mode == 'remote' ? 'selected' : '' }}>Remote</option> 
                           <option value="onsite" {{ $job->work_mode == 'onsite' ? 'selected' : '' }}>Onsite</option> 
                           <option value="hybrid" {{ $job->work_mode == 'hybrid' ? 'selected' : '' }}>Hybrid</option> 
                       </select>                                                                                      
                   </div>                                                                                             
               </div>                                                                                                 
                                                                                                                      
               {{-- Salary --}}                                                                                       
               <div class="grid grid-cols-2 gap-4">                                                                   
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Min Salary</span></label>              
                       <input type="number" name="salary_min" value="{{ old('salary_min', $job->salary_min) }}"       
 class="input input-bordered">                                                                                        
                   </div>                                                                                             
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Max Salary</span></label>              
                       <input type="number" name="salary_max" value="{{ old('salary_max', $job->salary_max) }}"       
 class="input input-bordered">                                                                                        
                   </div>                                                                                             
               </div>                                                                                                 
                                                                                                                      
               {{-- Current Logo (if exists) --}}                                                                     
               @if($job->logo)                                                                                        
               <div class="mb-4">                                                                                     
                   <p class="text-sm text-gray-500">Current Logo:</p>                                                 
                   <img src="{{ asset('storage/' . $job->logo) }}" class="w-16 h-16 object-cover rounded">            
               </div>                                                                                                 
               @endif                                                                                                 
                                                                                                                      
               {{-- Logo Upload --}}                                                                                  
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text font-bold">Change Logo (Optional)</span></label>      
                   <input type="file" name="logo" class="file-input file-input-bordered w-full" accept="image/*">     
               </div>                                                                                                 
                                                                                                                      
               {{-- Submit --}}                                                                                       
               <div class="card-actions justify-end mt-6">                                                            
                   <a href="{{ route('dashboard') }}" class="btn btn-ghost">Cancel</a>                                
                   <button type="submit" class="btn btn-primary">Update Job</button>                                  
               </div>                                                                                                 
           </form>                                                                                                    
       </div>                                                                                                         
   </div>                                                                                                             
   @endsection                             