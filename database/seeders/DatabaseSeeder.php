<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create a test user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'employer',
        ]);

        // 2. Create categories
        $categories = [
            'Software Engineering',
            'Design',
            'Marketing',
            'Sales',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }

        // 3. Create companies belonging to the test user
        $techCorp = Company::create([
            'name' => 'TechCorp',
            'slug' => 'techcorp',
            'location' => 'New York, USA',
            'user_id' => $user->id,
        ]);

        $designStudio = Company::create([
            'name' => 'DesignStudio',
            'slug' => 'design-studio',
            'location' => 'London, UK',
            'user_id' => $user->id,
        ]);

        // 4. Get categories
        $softwareCategory = Category::where(
            'slug',
            'software-engineering'
        )->first();

        // 5. Create a sample job
        JobListing::create([
            'company_id' => $techCorp->id,
            'category_id' => $softwareCategory->id,
            'title' => 'Senior React Developer',
            'slug' => 'senior-react-developer',
            'description' => 'We are looking for a senior developer to build amazing web apps.',
            'salary_min' => 90000,
            'salary_max' => 120000,
            'job_type' => 'full-time',
            'work_mode' => 'remote',
            'experience' => 'Senior',
            'status' => 'active',
        ]);
    }
}
