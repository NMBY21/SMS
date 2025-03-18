<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('teacher_grades', function (Blueprint $table) {
        $table->id();
        $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade'); // Reference to users table
        $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // Reference to subjects table
        $table->integer('evaluation_score');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('teacher_grades');
    }
};
