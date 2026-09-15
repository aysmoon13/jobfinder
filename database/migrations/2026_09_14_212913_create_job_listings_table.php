<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();                                                                                                  
            $table->foreignId('company_id')->constrained()->onDelete('cascade');                                           
            $table->foreignId('category_id')->constrained()->onDelete('cascade');                                          
            $table->string('title');                                                                                       
            $table->string('slug')->unique();                                                                              
            $table->text('description');                                                                                   
            $table->decimal('salary_min', 10, 2)->nullable();                                                              
            $table->decimal('salary_max', 10, 2)->nullable();                                                              
            $table->enum('job_type', ['full-time', 'part-time', 'contract', 'freelance'])->default('full-time');           
            $table->enum('work_mode', ['remote', 'onsite', 'hybrid'])->default('onsite');                                  
            $table->string('experience')->nullable();                                                                      
            $table->boolean('is_urgent')->default(false);                                                                  
            $table->enum('status', ['active', 'closed'])->default('active');                                               
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
