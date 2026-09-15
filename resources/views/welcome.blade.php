@extends('layouts.app')

@section('title', 'Home - JobFinder')

@section('content')
<div class="min-h-[80vh]">
    {{-- Hero Section --}}
    <div class="hero bg-gradient-to-br from-primary/10 to-secondary/10">
        <div class="hero-content text-center">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-6xl mt-8 font-bold mb-4">
                    Find Your <span class="text-primary">Dream Job</span>
                </h1>
                <p class="text-xl py-6 text-base-content/70">
                    Browse thousands of job opportunities from top companies worldwide.
                    Your next career move starts here.
                </p>
                <div class="flex flex-wrap gap-4 justify-center mb-4 mt-6">
                    <a href="/jobs" class="btn btn-primary btn-lg">Browse Jobs</a>
                    <a href="/register" class="btn btn-outline btn-lg">Post a Job</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="px-4 py-16">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="card bg-base-100 shadow-lg">
                <div class="card-body items-center text-center">
                    <h2 class="text-4xl font-bold text-primary">1,200+</h2>
                    <p class="text-base-content/60">Active Jobs</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow-lg">
                <div class="card-body items-center text-center">
                    <h2 class="text-4xl font-bold text-secondary">350+</h2>
                    <p class="text-base-content/60">Companies</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow-lg">
                <div class="card-body items-center text-center">
                    <h2 class="text-4xl font-bold text-accent">10,000+</h2>
                    <p class="text-base-content/60">Job Seekers</p>
                </div>
            </div>
        </div>
    </div>

    {{-- How It Works --}}
    <div class="px-4 py-16 bg-base-100">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="circle-icon mx-auto mb-4">1</div>
                    <h3 class="text-xl font-bold mb-2">Create Account</h3>
                    <p class="text-base-content/60">Sign up in less than 2 minutes. No credit card required.</p>
                </div>
                <div class="text-center">
                    <div class="circle-icon mx-auto mb-4">2</div>
                    <h3 class="text-xl font-bold mb-2">Search Jobs</h3>
                    <p class="text-base-content/60">Filter by location, salary, and type to find your perfect
                        match.</p>
                </div>
                <div class="text-center">
                    <div class="circle-icon mx-auto mb-4">3</div>
                    <h3 class="text-xl font-bold mb-2">Apply & Get Hired</h3>
                    <p class="text-base-content/60">Apply with one click and track your applications.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .circle-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, hsl(var(--p)), hsl(var(--s)));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
    }
</style>
@endsection