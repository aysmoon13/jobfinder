@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-8">
    
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Welcome back, {{ auth()->user()->name }}! 👋</h1>
        <a href="/post-job" class="btn btn-primary">+ Post New Job</a>
    </div>

    {{-- Stats Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="stats shadow bg-base-100">
            <div class="stat place-items-center">
                <div class="stat-title">Total Jobs</div>
                <div class="stat-value text-primary">{{ $jobs->count() }}</div>
            </div>
        </div>
        <div class="stats shadow bg-base-100">
            <div class="stat place-items-center">
                <div class="stat-title">Companies</div>
                <div class="stat-value text-secondary">{{ $companies->count() }}</div>
            </div>
        </div>
        <div class="stats shadow bg-base-100">
            <div class="stat place-items-center">
                <div class="stat-title">Role</div>
                <div class="stat-value text-accent">{{ auth()->user()->role }}</div>
            </div>
        </div>
    </div>
    
    {{-- Applications Section --}}
    <div class="card bg-base-100 shadow-xl mb-8">
        <div class="card-body">
            <h2 class="card-title mb-4">Recent Applications</h2>
            @php
                $applications = \App\Models\JobApplication::whereIn('job_listing_id', $jobs->pluck('id'))
                    ->with(['user', 'jobListing'])
                    ->latest()
                    ->limit(5)
                    ->get();
            @endphp

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Applied For</th>
                            <th>Status</th>
                            <th>View</th> {{-- FIXED: This header is correct --}}
                        </tr>
                    </thead>
                    <tbody> {{-- FIXED: Now we are in the body --}}
                        @foreach($applications as $app)
                        <tr>
                            <td>{{ $app->user->name }}</td>
                            <td>{{ $app->jobListing->title }}</td>
                            <td>
                                <div class="dropdown dropdown-hover">
                                    <div tabindex="0" role="button" class="btn m-1 badge badge-{{ $app->status == 'pending' ? 'warning' : 'success' }}">
                                        {{ ucfirst($app->status) }}
                                    </div>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                        <li><a onclick="changeStatus({{ $app->id }}, 'pending')">Pending</a></li>
                                        <li><a onclick="changeStatus({{ $app->id }}, 'interviewed')">Interview</a></li>
                                        <li><a onclick="changeStatus({{ $app->id }}, 'hired')">Hired</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td> {{-- FIXED: View button is now inside the row --}}
                                <a href="{{ route('applications.show', $app->id) }}" class="btn btn-sm btn-link">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function changeStatus(id, status) {
            if(!confirm('Update status to ' + status + '?')) return;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/applications/${id}/status`;
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PATCH';
            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = '{{ csrf_token() }}';
            form.appendChild(methodInput);
            form.appendChild(tokenInput);
            document.body.appendChild(form);
            form.submit();
        }
    </script>         

    {{-- Recent Jobs Table --}}
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title mb-4">Active Job Listings</h2>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->company->name }}</td>
                            <td>{{ $job->job_type }}</td>
                            <td>
                                @if($job->status === 'active')
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-ghost">Closed</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection