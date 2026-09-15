@extends('layouts.app')

@section('title', 'Browse Jobs')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-8">
    
    {{-- Header --}}
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold">Find Your Next Dream Job</h1>
        <p class="text-gray-500 mt-2">Browse thousands of opportunities from top companies.</p>
    </div>

    {{-- SEARCH BAR --}}
    <div class="card bg-base-100 shadow-md mb-6">
        <div class="card-body p-4">
            <form action="{{ route('jobs.index') }}" method="GET">
                <div class="flex flex-col md:flex-row gap-4">
                    {{-- Search Input --}}
                    <div class="form-control flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="input input-bordered w-full" placeholder="Search jobs, keywords...">
                    </div>
                    
                    {{-- Filter by Category --}}
                    <div class="form-control w-full md:w-1/4">
                        <select name="category_id" class="select select-bordered">
                            <option value="">All Categories</option>
                            @foreach(\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>

    {{-- The Grid of Jobs --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jobs as $job)
            <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-200 hover:-translate-y-1">
                <div class="card-body">
                    {{-- Job Header with Logo --}}
                    <div class="flex items-center gap-3 mb-2">
                        @if($job->logo)
                            <img src="{{ asset('storage/' . $job->logo) }}" class="w-10 h-10 object-cover rounded shadow-sm border">
                        @endif
                        <div>
                            <h2 class="card-title text-primary">{{ $job->title }}</h2>
                            <p class="text-sm font-medium text-gray-600">{{ $job->company->name }}</p>
                        </div>
                    </div>
                    {{-- Location & Type Badges --}}
                    <div class="flex flex-wrap gap-2 my-2">
                        <div class="badge badge-outline badge-primary">{{ $job->work_mode }}</div>
                        <div class="badge badge-outline badge-secondary">{{ $job->job_type }}</div>
                        <div class="badge badge-outline">{{ $job->category->name }}</div>
                    </div>
                    {{-- Salary --}}
                    @if($job->salary_min)
                        <div class="text-lg font-bold text-white-800">
                            ${{ number_format($job->salary_min) }}
                            @if($job->salary_max) - ${{ number_format($job->salary_max) }} @endif
                        </div>
                    @endif
                    {{-- Action Button --}}
                    <div class="card-actions justify-end mt-4">
                        <a href="/jobs/{{ $job->slug }}" class="btn btn-primary btn-sm w-full">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10">
                <p class="text-xl text-gray-500">No jobs found right now.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection