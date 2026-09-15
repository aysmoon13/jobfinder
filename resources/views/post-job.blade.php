 @extends('layouts.app')                                                                                            
                                                                                                                      
   @section('title', 'Post a New Job')                                                                                
                                                                                                                      
   @section('content')                                                                                                
   <div class="max-w-3xl mx-auto p-6">                                                                                
       <div class="card bg-base-100 shadow-xl">                                                                       
           <form action="{{ route('post-job.store') }}" method="POST" class="card-body"                               
 enctype="multipart/form-data">                                                                                       
               @csrf    
               {{-- If there were errors, show them here --}}                                                                     
                @if ($errors->any())                                                                                               
                    <div class="alert alert-error shadow-lg mb-4">                                                                 
                        <div>                                                                                                      
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"       
                viewBox="0 0 24 24">                                                                                                 
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2     
                2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />                                                                   
                            </svg>                                                                                                 
                            <span><b>Whoops!</b> Something went wrong.</span>                                                      
                        </div>                                                                                                     
                    </div>                                                                                                         
                    <ul class="list-disc ml-6">                                                                                    
                        @foreach ($errors->all() as $error)                                                                        
                            <li>{{ $error }}</li>                                                                                  
                        @endforeach                                                                                                
                    </ul>                                                                                                          
                @endif                                                                                                
                                                                                                                                    
               {{-- Success Message --}}                                                                              
               @if (session('success'))                                                                               
                   <div class="alert alert-success">                                                                  
                       {{ session('success') }}                                                                       
                   </div>                                                                                             
               @endif                                                                                                 
                                                                                                                      
               {{-- Title --}}                                                                                        
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text font-bold">Job Title</span></label>                   
                   <input type="text" name="title" placeholder="e.g. Senior Developer"                                
                          class="input input-bordered" required>                                                      
               </div>                                                                                                 
                                                                                                                      
               {{-- Company & Category (Using Select) --}}                                                            
               <div class="grid grid-cols-1 md:grid-cols-2 gap-4">                                                    
                    <div class="form-control">                                                                                         
                        <label class="label"><span class="label-text font-bold">Company Name</span></label>                            
                        <input type="text" name="company_name" value="{{ old('company_name') }}"                                       
                                placeholder="e.g. Google, Tesla, Local Cafe"                                                            
                                class="input input-bordered" required>                                                                  
                    </div>                                                                                           
                                                                                                                      
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Category</span></label>                
                       <select name="category_id" class="select select-bordered" required>                            
                           <option disabled selected>Select Category</option>                                         
                           @foreach(\App\Models\Category::all() as $category)                                         
                               <option value="{{ $category->id }}">{{ $category->name }}</option>                     
                           @endforeach                                                                                
                       </select>                                                                                      
                   </div>                                                                                             
               </div>                                                                                                 
                                                                                                                      
               {{-- Job Type & Work Mode --}}                                                                         
               <div class="grid grid-cols-1 md:grid-cols-2 gap-4">                                                    
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Job Type</span></label>                
                       <select name="job_type" class="select select-bordered" required>                               
                           <option value="full-time">Full Time</option>                                               
                           <option value="part-time">Part Time</option>                                               
                           <option value="contract">Contract</option>                                                 
                           <option value="freelance">Freelance</option>                                               
                       </select>                                                                                      
                   </div>                                                                                             
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Work Mode</span></label>               
                       <select name="work_mode" class="select select-bordered" required>                              
                           <option value="remote">Remote</option>                                                     
                           <option value="onsite">Onsite</option>                                                     
                           <option value="hybrid">Hybrid</option>                                                     
                       </select>                                                                                      
                   </div>                                                                                             
               </div>  
               {{-- Experience Level --}}                                                                                         
                <div class="form-control">                                                                                         
                    <label class="label"><span class="label-text font-bold">Experience Level</span></label>                        
                    <select name="experience" class="select select-bordered">                                                      
                        <option value="" disabled selected>Select Experience</option>                                              
                        <option value="entry-level">Entry Level</option>                                                           
                        <option value="mid-level">Mid Level</option>                                                               
                        <option value="senior-level">Senior Level</option>                                                         
                        <option value="director">Director / Executive</option>                                                     
                        <option value="any">Any Experience</option>                                                                
                    </select>                                                                                                      
                </div>                                                                                                 
                                                                                                                      
               {{-- Salary --}}                                                                                       
               <div class="grid grid-cols-2 gap-4">                                                                   
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Min Salary</span></label>              
                       <input type="number" name="salary_min" class="input input-bordered" placeholder="50000">       
                   </div>                                                                                             
                   <div class="form-control">                                                                         
                       <label class="label"><span class="label-text font-bold">Max Salary</span></label>              
                       <input type="number" name="salary_max" class="input input-bordered" placeholder="100000">      
                   </div>                                                                                             
               </div>                                                                                                 
                                                                                                                      
               {{-- Description --}}                                                                                  
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text font-bold">Description</span></label>                 
                   <textarea name="description" class="textarea textarea-bordered h-32" placeholder="Describe the     
 role..." required></textarea>                                                                                        
               </div>                                                                                                 
                                                                                                                      
               {{-- Logo Upload --}}                                                                                  
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text font-bold">Company Logo (Optional)</span></label>     
                   <input type="file" name="logo" class="file-input file-input-bordered w-full" accept="image/*">     
               </div>        
               
               {{-- Is Urgent --}}                                                                                                
                <div class="form-control">                                                                                         
                    <label class="label cursor-pointer justify-start gap-3">                                                       
                        <input type="checkbox" name="is_urgent" value="1" class="checkbox checkbox-error" />                       
                        <span class="label-text">Mark as Urgent (Requires immediate hire)</span>                                   
                    </label>                                                                                                       
                </div>   
                                                                                                                      
               {{-- Submit --}}                                                                                       
               <div class="card-actions justify-end mt-6">                                                            
                   <a href="{{ route('jobs.index') }}" class="btn btn-ghost">Cancel</a>                               
                   <button type="submit" class="btn btn-primary">Post Job</button>                                    
               </div>                                                                                                 
           </form>                                                                                                    
       </div>                                                                                                         
   </div>                                                                                                             
   @endsection                                              