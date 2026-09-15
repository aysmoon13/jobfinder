@extends('layouts.app')                                                                                            
                                                                                                                      
   @section('title', 'Application: ' . $application->jobListing->title)                                               
                                                                                                                      
   @section('content')                                                                                                
   <div class="max-w-3xl mx-auto p-6">                                                                                
       <a href="{{ route('dashboard')}}" class="btn btn-ghost mb-4">← Back to Dashboard</a>                           
                                                                                                                      
       <div class="card bg-base-100 shadow-xl">                                                                       
           <div class="card-body">                                                                                    
               <div class="flex justify-between items-start">                                                         
                   <div>                                                                                              
                       <h2 class="card-title">Application for: {{ $application->jobListing->title }}</h2>             
                       <p class="text-gray-500">Company: {{ $application->jobListing->company->name }}</p>            
                   </div>                                                                                             
                   <span class="badge badge-{{ $application->status == 'pending' ? 'warning' : 'success' }} text-lg"> 
                       {{ ucfirst($application->status) }}                                                            
                   </span>                                                                                            
               </div>                                                                                                 
                                                                                                                      
               <div class="divider"></div>                                                                            
                                                                                                                      
               <div class="grid grid-cols-2 gap-4">                                                                   
                   <div>                                                                                              
                       <h3 class="font-bold">Applicant Info</h3>                                                      
                       <p>Name: {{ $application->user->name }}</p>                                                    
                       <p>Email: {{ $application->user->email }}</p>                                                  
                   </div>                                                                                             
                   <div>                                                                                              
                       <h3 class="font-bold">Resume</h3>                                                              
                       <a href="{{ asset('storage/' . $application->resume_path) }}"                                  
                          target="_blank"                                                                             
                          class="btn btn-primary btn-sm">                                                             
                           View / Download Resume                                                                     
                       </a>                                                                                           
                   </div>                                                                                             
               </div>                                                                                                 
                                                                                                                      
               <div class="mt-6">                                                                                     
                   <h3 class="font-bold mb-2">Cover Letter</h3>                                                       
                   <div class="bg-gray-100 text-black p-4 rounded-lg">                                                           
                       @if($application->cover_letter)                                                                
                           {{ $application->cover_letter }}                                                           
                       @else                                                                                          
                           <p class="text-gray-400 italic">No cover letter provided.</p>                              
                       @endif                                                                                         
                   </div>                                                                                             
               </div>                                                                                                 
                                                                                                                      
               <div class="card-actions justify-end mt-6">                                                            
                    <!-- Quick Status Update -->                                                                      
                    <form action="{{ route('applications.update-status', $application->id) }}" method="POST">         
                       @csrf                                                                                          
                       @method('PATCH')                                                                               
                       <select name="status" class="select select-bordered" onchange="this.form.submit()">            
                           <option value="pending" {{ $application->status == 'pending' ? 'selected' : ''             
 }}>Pending</option>                                                                                                  
                           <option value="interviewed" {{ $application->status == 'interviewed' ? 'selected' : ''     
 }}>Interviewed</option>                                                                                              
                           <option value="hired" {{ $application->status == 'hired' ? 'selected' : ''                 
 }}>Hired</option>                                                                                                    
                           <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : ''           
 }}>Rejected</option>                                                                                                 
                       </select>                                                                                      
                    </form>                                                                                           
               </div>                                                                                                 
           </div>                                                                                                     
       </div>                                                                                                         
   </div>                                                                                                             
   @endsection         