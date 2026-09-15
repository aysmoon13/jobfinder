@extends('layouts.app')                                                                                            
                                                                                                                      
   @section('title', 'Register')                                                                                      
                                                                                                                      
   @section('content')                                                                                                
   <div class="min-h-[80vh] flex items-center justify-center">                                                        
       <div class="card w-96 bg-base-100 shadow-xl">                                                                  
           <form action="{{ route('register.post') }}" method="POST" class="card-body">                               
               @csrf                                                                                                  
                                                                                                                      
               @if ($errors->any())                                                                                   
                   <div class="alert alert-error">                                                                    
                       {{ $errors->first() }}                                                                         
                   </div>                                                                                             
               @endif                                                                                                 
                                                                                                                      
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text">Name</span></label>                                  
                   <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered" required>    
               </div>                                                                                                 
                                                                                                                      
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text">Email</span></label>                                 
                   <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered" required> 
               </div>                                                                                                 
                                                                                                                      
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text">Password</span></label>                              
                   <input type="password" name="password" class="input input-bordered" required>                      
               </div>                                                                                                 
                                                                                                                      
               <div class="form-control">                                                                             
                   <label class="label"><span class="label-text">Confirm Password</span></label>                      
                   <input type="password" name="password_confirmation" class="input input-bordered" required>         
               </div>     
               
               <div class="form-control">                                                                                         
                <label class="label"><span class="label-text font-bold">I am a:</span></label>                                 
                <select name="role" class="select select-bordered" required>                                                   
                    <option value="job_seeker">Job Seeker</option>                                                             
                    <option value="employer">Employer</option>                                                                 
                </select>                                                                                                      
            </div>  
                                                                                                                      
               <div class="form-control mt-6">                                                                        
                   <button type="submit" class="btn btn-primary">Register</button>                                    
               </div>                                                                                                 
           </form>                                                                                                    
       </div>                                                                                                         
   </div>                                                                                                             
   @endsection                         