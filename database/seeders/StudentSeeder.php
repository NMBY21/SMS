<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'name' => 'student 1',
            'email' => 'student1@gmail.com',
            'password' => bcrypt('password'),
            'teacher_id' => 1, 
        ]);
    }
}