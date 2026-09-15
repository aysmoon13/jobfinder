 @extends('layouts.app')                                                                                            
                                                                                                                      
   {{-- Use the job's actual title as the page title --}}                                                             
   @section('title', $job->title)                                                                                     
                                                                                                                      
   @section('content')                                                                                                
   <div class="max-w-7xl mx-auto p-4 md:p-8">                                                                         
       <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">                                                            
                                                                                                                      
           {{-- Main Content: The Description --}}                                                                    
           <div class="lg:col-span-2 space-y-6">                                                                      
                                                                                                                      
               {{-- Header --}}                                                                                       
               <div>                                                                                                  
                   <div class="flex items-center gap-4 mb-4">                                                         
                       {{-- Display Logo if it exists --}}                                                            
                       @if($job->logo)                                                                                
                           <img src="{{ asset('storage/' . $job->logo) }}"                                            
                                class="w-16 h-16 object-cover rounded-lg shadow border">                              
                       @endif                                                                                         
                                                                                                                      
                       <div>                                                                                          
                           <h1 class="text-3xl font-bold mb-1">{{ $job->title }}</h1>                                 
                           <div class="flex items-center gap-2 text-gray-600 text-lg">                                
                               <span class="font-semibold text-primary">{{ $job->company->name }}</span>              
                               <span>•</span>                                                                         
                               <span>{{ $job->company->location ?? 'Remote' }}</span>                                 
                           </div>                                                                                     
                       </div>                                                                                         
                   </div>                                                                                             
               </div>                                                                                                 
                                                                                                                      
               {{-- Badges --}}                                                                                       
               <div class="flex flex-wrap gap-2">                                                                     
                   <div class="badge badge-lg badge-primary">{{ $job->category->name }}</div>                         
                   <div class="badge badge-lg badge-secondary">{{ $job->work_mode }}</div>                            
                   <div class="badge badge-lg">{{ $job->job_type }}</div>                                             
                   @if($job->is_urgent)                                                                               
                       <div class="badge badge-lg badge-error">🔥 URGENT</div>                                        
                   @endif                                                                                             
               </div>                                                                                                 
                                                                                                                      
               <div class="divider"></div>                                                                            
                                                                                                                      
               {{-- Job Description --}}                                                                              
               <div class="prose max-w-none text-gray-100 leading-relaxed text-lg">                                   
                   {{ $job->description }}                                                                            
               </div>                                                                                                 
                                                                                                                      
               {{-- Experience Level --}}                                                                             
               @if($job->experience)                                                                                  
               <div class="bg-blue-50 p-4 text-black rounded-lg border border-blue-200">                                         
                   <strong>Experience Level:</strong> {{ ucfirst($job->experience) }}                                 
               </div>                                                                                                 
               @endif                                                                                                 
           </div>                                                                                                     
                                                                                                                      
           {{-- Sidebar: Job Details & Apply --}}                                                                     
           <div class="lg:col-span-1">                                                                                
               <div class="card bg-base-100 shadow-xl border border-gray-200 sticky top-8">                           
                   <div class="card-body">                                                                            
                       <h3 class="card-title text-lg mb-4">Job Details</h3>                                           
                                                                                                                      
                       <div class="space-y-4">                                                                        
                           {{-- Salary --}}                                                                           
                           <div class="flex justify-between border-b pb-2">                                           
                               <span class="text-gray-500">Salary</span>                                              
                               <span class="font-bold text-lg text-green-600">                                        
                                   {{ $job->salary_min ? '$'.number_format($job->salary_min) : 'Negotiable' }}        
                                   @if($job->salary_max) - ${{ number_format($job->salary_max) }} @endif              
                               </span>                                                                                
                           </div>                                                                                     
                                                                                                                      
                           {{-- Job Type --}}                                                                         
                           <div class="flex justify-between border-b pb-2">                                           
                               <span class="text-gray-500">Type</span>                                                
                               <span>{{ ucfirst($job->job_type) }}</span>                                             
                           </div>                                                                                     
                                                                                                                      
                           {{-- Work Mode --}}                                                                        
                           <div class="flex justify-between border-b pb-2">                                           
                               <span class="text-gray-500">Location</span>                                            
                               <span>{{ ucfirst($job->work_mode) }}</span>                                            
                           </div>                                                                                     
                                                                                                                      
                           {{-- Posted Date --}}                                                                      
                           <div class="flex justify-between border-b pb-2">                                           
                               <span class="text-gray-500">Posted</span>                                              
                               <span>{{ $job->created_at->diffForHumans() }}</span>                                   
                           </div>                                                                                     
                       </div>                                                                                         
                                                                                                                      
                       {{-- Apply Button --}}                                                                         
                       <div class="mt-6">                                                                             
                           <a href="{{ route('jobs.apply', $job->slug) }}" class="btn btn-primary btn-block text-lg"> 
                               Apply Now                                                                              
                           </a>                                                                                       
                       </div>                                                                                         
                                                                                                                      
                       <div class="mt-4">                                                                             
                           <a href="{{ route('jobs.index') }}" class="btn btn-link text-sm">← Back to all jobs</a>    
                       </div>                                                                                         
                   </div>                                                                                             
               </div>                                                                                                 
           </div>                                                                                                     
                                                                                                                      
       </div>                                                                                                         
   </div>                                                                                                             
   @endsection 