<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        Subject::create(['name' => 'Mathematics']);
        Subject::create(['name' => 'Science']);
    }
}