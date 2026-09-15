<?php                                                                                                              
                                                                                                                      
   namespace App\Http\Controllers;                                                                                    
                                                                                                                      
   use Illuminate\Http\Request;                                                                                       
   use Illuminate\Support\Facades\Auth;                                                                               
   use App\Models\JobListing;                                                                                         
                                                                                                                      
   class DashboardController extends Controller                                                                       
   {                                                                                                                  
       public function index()                                                                                        
       {                                                                                                              
           // Get the currently logged-in user                                                                     
           $user = Auth::user();                                                                                      
                                                                                                                      
           // Get all companies that belong to THIS user                                                           
           $companies = $user->companies;                                                                             
                                                                                                                      
           // Get ALL jobs for those companies                                                                     
           $jobs = JobListing::whereIn('company_id', $companies->pluck('id'))->get();                                 
                                                                                                                      
           // Send this data to the 'dashboard' view                                                               
           return view('dashboard', compact('jobs', 'companies'));                                                    
       }                                                                                                              
   }     