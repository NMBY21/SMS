<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        Teacher::create([
            'name' => 'Teaher 1',
            'email' => 'teacher1@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}