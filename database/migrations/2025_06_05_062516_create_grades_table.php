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
        Schema::create('grades', function (Blueprint $table) {
            $table->id(); // ID
        $table->unsignedBigInteger('student_id'); // student_id (you need a students table for FK ideally)
        $table->unsignedBigInteger('subject_id'); // subject_id
        $table->integer('grade'); // grade
        $table->timestamp('date'); // date/timestamp
        $table->timestamps();

        // Foreign key constraint (optional but recommended)
        $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
