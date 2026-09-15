@extends('layouts.app')                                                                                            
                                                                                                                      
   @section('title', 'My Applications')                                                                               
                                                                                                                      
   @section('content')                                                                                                
   <div class="max-w-7xl mx-auto p-4 md:p-8">                                                                         
       <h1 class="text-3xl font-bold mb-8">My Applications 📩</h1>                                                    
                                                                                                                      
       @if($applications->isEmpty())                                                                                  
           <div class="card bg-base-100 shadow-lg text-center py-12">                                                 
               <div class="card-body">                                                                                
                   <h3 class="text-xl font-bold">No Applications Yet</h3>                                             
                   <p class="text-gray-500 mb-4">Start exploring jobs and apply to get started!</p>                   
                   <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse Jobs</a>                        
               </div>                                                                                                 
           </div>                                                                                                     
       @else                                                                                                          
           <div class="space-y-6">                                                                                    
               @foreach($applications as $app)                                                                        
                   <div class="card bg-base-100 shadow-md border border-gray-200">                                    
                       <div class="card-body">                                                                        
                           <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">            
                               <div>                                                                                  
                                   <h2 class="card-title text-lg text-primary">{{ $app->jobListing->title }}</h2>     
                                   <p class="text-gray-600 font-medium">{{ $app->jobListing->company->name }}</p>     
                                   <p class="text-sm text-gray-400 mt-1">Applied {{ $app->created_at->diffForHumans() 
 }}</p>                                                                                                               
                               </div>                                                                                 
                                                                                                                      
                               {{-- Status Badge --}}                                                                 
                               <div class="flex flex-col items-end gap-2">                                            
                                   <span class="badge badge-lg badge-{{                                               
                                       $app->status == 'pending' ? 'warning' :                                        
                                       ($app->status == 'interviewed' ? 'info' :                                      
                                       ($app->status == 'hired' ? 'success' : 'error'))                               
                                   }}">                                                                               
                                       {{ ucfirst($app->status) }}                                                    
                                   </span>                                                                            
                                   <a href="{{ asset('storage/' . $app->resume_path) }}"                              
                                      target="_blank"                                                                 
                                      class="btn btn-sm btn-outline btn-primary">                                     
                                       View Resume                                                                    
                                   </a>                                                                               
                               </div>                                                                                 
                           </div>                                                                                     
                                                                                                                      
                           {{-- Cover Letter Preview --}}                                                             
                           @if($app->cover_letter)                                                                    
                               <div class="mt-4 pt-4 border-t border-gray-200">                                       
                                   <p class="text-sm font-semibold text-gray-700">Cover Letter:</p>                   
                                   <p class="text-sm text-gray-600 mt-1 bg-base-200 p-3 rounded-lg max-h-24           
 overflow-y-auto">                                                                                                    
                                       {{ $app->cover_letter }}                                                       
                                   </p>                                                                               
                               </div>                                                                                 
                           @endif                                                                                     
                       </div>                                                                                         
                   </div>                                                                                             
               @endforeach                                                                                            
           </div>                                                                                                     
       @endif                                                                                                         
   </div>                                                                                                             
   @endsection                                         