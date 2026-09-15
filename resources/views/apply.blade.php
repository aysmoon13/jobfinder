 @extends('layouts.app')                                                                                            
                                                                                                                      
   @section('title', 'Apply for ' . $job->title)                                                                      
                                                                                                                      
   @section('content')                                                                                                
   <div class="max-w-3xl mx-auto p-6">                                                                                
       <div class="card bg-base-100 shadow-xl">                                                                       
           <div class="card-body">                                                                                    
               <h2 class="card-title text-2xl">Apply for {{ $job->title }}</h2>                                       
               <p class="text-gray-500">at {{ $job->company->name }}</p>                                              
                                                                                                                      
               <form action="{{ route('jobs.store-application', $job->slug) }}" method="POST"                         
 enctype="multipart/form-data">                                                                                       
                   @csrf                                                                                              
                                                                                                                      
                   {{-- Cover Letter --}}                                                                             
                   <div class="form-control mb-4">                                                                    
                       <label class="label"><span class="label-text font-bold">Cover Letter</span></label>            
                       <textarea name="cover_letter" class="textarea textarea-bordered h-24" placeholder="Tell the    
 employer why you're a great fit..."></textarea>                                                                      
                   </div>                                                                                             
                                                                                                                      
                   {{-- Resume Upload --}}                                                                            
                   <div class="form-control mb-4">                                                                    
                       <label class="label"><span class="label-text font-bold">Resume (PDF/Word)</span></label>       
                       <input type="file" name="resume" class="file-input file-input-bordered w-full"                 
 accept=".pdf,.doc,.docx" required>                                                                                   
                   </div>                                                                                             
                                                                                                                      
                   {{-- Submit --}}                                                                                   
                   <div class="card-actions justify-end mt-6">                                                        
                       <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-ghost">Cancel</a>                
                       <button type="submit" class="btn btn-primary">Submit Application</button>                      
                   </div>                                                                                             
               </form>                                                                                                
           </div>                                                                                                     
       </div>                                                                                                         
   </div>                                                                                                             
   @endsection  