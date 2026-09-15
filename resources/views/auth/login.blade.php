@extends('layouts.app')                                                                                            
                                                                                                                      
   @section('title', 'Login')                                                                                         
                                                                                                                      
   @section('content')                                                                                                
   <div class="min-h-[80vh] flex items-center justify-center">                                                        
       <div class="card w-96 bg-base-100 shadow-xl">                                                                  
           <form action="{{ route('login.post') }}" method="POST" class="card-body">                                  
               @csrf                                                                                                  
                                                                                                                      
               {{-- Error Message --}}                                                                                
               @if ($errors->any())                                                                                   
                   <div class="alert alert-error">                                                                    
                       {{ $errors->first() }}                                                                         
                   </div>                                                                                             
               @endif                                                                                                 
                                                                                                                      
               <div class="form-control">                                                                             
                   <label class="label">                                                                              
                       <span class="label-text">Email</span>                                                          
                   </label>                                                                                           
                   {{-- old('email') fills the input if it was filled before and failed --}}                          
                   <input type="email" name="email" value="{{ old('email') }}"                                        
                          class="input input-bordered" required>                                                      
               </div>                                                                                                 
                                                                                                                      
               <div class="form-control">                                                                             
                   <label class="label">                                                                              
                       <span class="label-text">Password</span>                                                       
                   </label>                                                                                           
                   <input type="password" name="password" class="input input-bordered" required>                      
               </div>                                                                                                 
                                                                                                                      
               <div class="form-control mt-6">                                                                        
                   <button type="submit" class="btn btn-primary">Login</button>                                       
               </div>                                                                                                 
               <div class="form-control mt-2">                                                                        
                   <a href="{{ route('register') }}" class="link link-hover">Don't have an account?</a>               
               </div>                                                                                                 
           </form>                                                                                                    
       </div>                                                                                                         
   </div>                                                                                                             
   @endsection        