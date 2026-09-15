@extends('layouts.app')                                                                                            
                                                                                                                      
   @section('title', 'Profile Settings')                                                                              
                                                                                                                      
   @section('content')                                                                                                
   <div class="max-w-3xl mx-auto p-6">                                                                                
       <div class="card bg-base-100 shadow-xl">                                                                       
           <div class="card-body">                                                                                    
               <h2 class="card-title text-2xl mb-6">Edit Profile</h2>                                                 
                                                                                                                      
               {{-- Success Message --}}                                                                              
               @if (session('status'))                                                                                
                   <div class="alert alert-success mb-6">                                                             
                       {{ session('status') }}                                                                        
                   </div>                                                                                             
               @endif                                                                                                 
                                                                                                                      
               <form action="{{ route('profile.update') }}" method="POST">                                            
                   @csrf                                                                                              
                   @method('PATCH')                                                                                   
                                                                                                                      
                   {{-- Name --}}                                                                                     
                   <div class="form-control mb-4">                                                                    
                       <label class="label">                                                                          
                           <span class="label-text font-bold">Full Name</span>                                        
                       </label>                                                                                       
                       <input type="text" name="name" value="{{ old('name', $user->name) }}"                          
                              class="input input-bordered w-full" required>                                           
                   </div>                                                                                             
                                                                                                                      
                   {{-- Email --}}                                                                                    
                   <div class="form-control mb-6">                                                                    
                       <label class="label">                                                                          
                           <span class="label-text font-bold">Email Address</span>                                    
                       </label>                                                                                       
                       <input type="email" name="email" value="{{ old('email', $user->email) }}"                      
                              class="input input-bordered w-full" required>                                           
                       @if($user->hasVerifiedEmail())                                                                 
                           <p class="text-xs text-green-600 mt-1">✓ Email Verified</p>                                
                       @endif                                                                                         
                   </div>                                                                                             
                                                                                                                      
                   {{-- Role Info --}}                                                                                
                   <div class="bg-base-200 p-4 rounded-lg mb-6">                                                      
                       <p class="text-sm">                                                                            
                           <span class="font-bold">Your Role:</span>                                                  
                           <span class="capitalize">{{ $user->role }}</span>                                          
                       </p>                                                                                           
                       <p class="text-xs text-gray-500 mt-1">Contact support to change your role.</p>                 
                   </div>                                                                                             
                                                                                                                      
                   {{-- Buttons --}}                                                                                  
                   <div class="card-actions justify-end">                                                             
                       <a href="{{ route('dashboard') }}" class="btn btn-ghost">Cancel</a>                             
                       <button type="submit" class="btn btn-primary">Save Changes</button>                            
                   </div>                                                                                             
               </form>                                                                                                
           </div>                                                                                                     
       </div>                                                                                                         
   </div>                                                                                                             
   @endsection      