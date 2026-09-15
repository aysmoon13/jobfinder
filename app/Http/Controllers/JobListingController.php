<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Support\Str; 
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobListingController extends Controller
{

    public function index()                                                                                            
   {                                                                                                                  
       $query = \App\Models\JobListing::with(['company', 'category'])                                                 
           ->where('status', 'active')                                                                                
           ->latest();                                                                                                
                                                                                                                      
       //  Handle Search Text                                                                                       
       if (request('search')) {                                                                                       
           $query->where(function($q) {                                                                               
               $q->where('title', 'like', '%' . request('search') . '%')                                              
                 ->orWhere('description', 'like', '%' . request('search') . '%');                                     
           });                                                                                                        
       }                                                                                                              
                                                                                                                      
       // Handle Category Filter                                                                                   
       if (request('category_id')) {                                                                                  
           $query->where('category_id', request('category_id'));                                                      
       }                                                                                                              
                                                                                                                      
       $jobs = $query->get();                                                                                         
                                                                                                                      
       return view('jobs', compact('jobs'));                                                                         
   }  

   public function show($slug){
    $job = JobListing::with(['company','category'])
    ->where('slug',$slug)
    ->firstOrFail();

    return view('job', compact('job'));                                                                            

   }

   public function create(){
    return view('post-job');                                                                                       

   }


  public function store(Request $request)
{

if ($request->hasFile('logo')) {
    $file = $request->file('logo');

    if (!$file->isValid()) {
        dd([
            'error_code' => $file->getError(),
            'error_message' => $file->getErrorMessage(),
        ]);
    }
}

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',

        'company_name' => 'required|string|max:255',

        'category_id' => 'required|exists:categories,id',

        'job_type' => 'required|in:full-time,part-time,contract,freelance',
        'work_mode' => 'required|in:remote,onsite,hybrid',

        'salary_min' => 'nullable|numeric|min:0',
        'salary_max' => 'nullable|numeric|min:0',
        'experience' => 'nullable|string|max:50',                                                                          


        'logo' => 'nullable|mimetypes:image/*,application/pdf|max:5120',                                                   
    ]);

    
    // Upload logo
    $logoPath = null;

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');

        }

    // Find or create company
    $company = \App\Models\Company::firstOrCreate(
        [
            'name' => $validated['company_name'],
            'user_id' => Auth::id(),

        ],
        [
            'slug' => Str::slug($validated['company_name']),
        ]
    );

    // Create job
    JobListing::create([
        'title' => $validated['title'],
        'description' => $validated['description'],

        'company_id' => $company->id,
        'category_id' => $validated['category_id'],

        'job_type' => $validated['job_type'],
        'work_mode' => $validated['work_mode'],

        'salary_min' => $validated['salary_min'] ?? null,
        'salary_max' => $validated['salary_max'] ?? null,

        'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
        'experience' => $validated['experience'],                                                                          

        'logo' => $logoPath,

        'status' => 'active',
    ]);

    return redirect()
        ->route('jobs.index')
        ->with('success', 'Job posted successfully!');
}


public function edit($id){
    $job = JobListing::findOrFail($id);

    return view('edit-job', compact('job'));                                                                       

}

public function update(Request $request,$id){
    $job = JobListing::findOrFail($id);  

    $request->validate([                                                                                           
            'title' => 'required|string|max:255',                                                                      
            'description' => 'required|string',                                                                        
            'job_type' => 'required|in:full-time,part-time,contract,freelance',                                        
            'work_mode' => 'required|in:remote,onsite,hybrid',                                                         
            'salary_min' => 'nullable|numeric',                                                                        
            'salary_max' => 'nullable|numeric',                                                                        
            'logo' => 'nullable|mimetypes:image/*,application/pdf|max:5120',                                                   
        ]);   

        if($request->hasFile('logo')){
            if($job->logo){
                Storage::disk('public')->delete($job->logo);
            }

            $job->logo = $request->file('logo')->store('logos','public');

        }

        $job->update([                                                                                                 
           'title' => $request->title,                                                                                
           'description' => $request->description,                                                                    
           'job_type' => $request->job_type,                                                                          
           'work_mode' => $request->work_mode,                                                                        
           'salary_min' => $request->salary_min,                                                                      
           'salary_max' => $request->salary_max,                                                                      
       ]);  
       
    return redirect()->route('dashboard')->with('success', 'Job updated successfully!');                           

    }

    public function destroy($id)                                                                                       
   {                                                                                                                  
       $job = JobListing::findOrFail($id);                                                                            
       $job->delete();                                                                                                
                                                                                                                      
       return redirect()->route('dashboard')->with('success', 'Job deleted.');                                        
   }     

    public function apply($slug)                                                                                       
    {                                                                                                                  
        $job = JobListing::where('slug', $slug)->firstOrFail();                                                        
        return view('apply', compact('job'));                                                                          
    }                                                                                                                  
       

    public function storeApplication(Request $request, $slug)                                                          
    {                                                                                                                  
        $validated = $request->validate([                                                                              
            'cover_letter' => 'nullable|string|max:1000',                                                              
            'resume' =>                                                                                                
            'required|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessing 
            ml.document|max:2048',                                                                                               
                ]);                                                                                                            
                                                                                                                        
        // Handle Resume Upload                                                                                        
        $resumePath = $request->file('resume')->store('resumes', 'public');                                            
                                                                                                                        
        // Save Application                                                                                            
        $application = JobApplication::create([                                                            
            'user_id' => auth()->id(),                                                                                 
            'job_listing_id' => JobListing::where('slug', $slug)->first()->id,                             
            'cover_letter' => $validated['cover_letter'],                                                              
            'resume_path' => $resumePath,                                                                              
            'status' => 'pending',                                                                                     
        ]);                                                                                                            
                                                                                                                        
        return redirect()->route('jobs.show', $slug)->with('success', 'Application submitted successfully!');          
    } 


    public function showApplication($id)                                                                               
    {                                                                                                                  
        // Find the application and load user and job details                                                          
        $application = \App\Models\JobApplication::with(['user', 'jobListing'])->findOrFail($id);                      
        return view('application-show', compact('application'));                                                       
    }                                                                                                                  
                                                                                                                        
    public function updateStatus($id)                                                                                  
    {                                                                                                                  
        // Update the status from the dropdown                                                                         
        $application = \App\Models\JobApplication::findOrFail($id);                                                    
        $application->update(['status' => request('status')]);                                                         
        return back()->with('success', 'Status updated!');                                                             
    }    

  public function myApplications()                                                                                   
   {                                                                                                                  
       // Get only the applications submitted by THIS user                                                            
       $applications = \App\Models\JobApplication::where('user_id', auth()->id())                                     
           ->with(['jobListing', 'jobListing.company']) // Load job & company details                                 
           ->latest()                                                                                                 
           ->get();                                                                                                   
                                                                                                                      
       return view('my-applications', compact('applications'));                                                       
   }       

    }

