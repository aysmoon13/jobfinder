<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JobFinder')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-base-200">
    {{-- Navbar --}}
     <div class="navbar bg-base-100 shadow-md px-4 lg:px-8">                                                            
       {{-- Left Side: Logo/Title --}}                                                                                
       <div class="flex-1">                                                                                           
           <a href="/" class="btn btn-ghost text-xl text-primary">JobFinder</a>                                       
       </div>                                                                                                         
                                                                                                                      
       {{-- Right Side: Links & Auth --}}                                                                             
       <div class="flex-none gap-2">                                                                                  
           <a href="/" class="btn btn-ghost btn-sm">Home</a>                                                          
           <a href="/jobs" class="btn btn-ghost btn-sm">Browse Jobs</a>                                               
                                                                                                                      
           @auth                                                                                                      
               {{-- Role-Based Navigation --}}                                                                        
               @if(auth()->user()->role === 'employer')                                                               
                   <a href="/dashboard" class="btn btn-ghost btn-sm">Dashboard</a>                                    
                   <a href="/post-job" class="btn btn-outline btn-sm">Post a Job</a>                                  
                    <a href="/profile" class="btn btn-ghost btn-sm">Profile</a> 

                @else                                                                                                  
                    <a href="{{ route('my-applications') }}" class="btn btn-ghost btn-sm">My Applications</a>                          
                                       
               @endif                                                                                                 
                                                                                                                      
               <form method="POST" action="/logout" class="btn btn-ghost btn-sm">                                     
                   @csrf                                                                                              
                   <button type="submit">Logout</button>                                                              
               </form>                                                                                                
           @else                                                                                                      
               <a href="/login" class="btn btn-ghost btn-sm">Login</a>                                                
               <a href="/register" class="btn btn-primary btn-sm">Register</a>                                        
           @endauth                                                                                                   
       </div>                                                                                                         
   </div>  

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer footer-center p-6 bg-base-100 text-base-content mt-10">
        <aside>
            <p>&copy; {{ date('Y') }} JobFinder. All rights reserved.</p>
        </aside>
    </footer>

    @stack('scripts')
</body>

</html>