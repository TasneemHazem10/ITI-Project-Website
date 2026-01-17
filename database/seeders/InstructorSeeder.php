<?php

namespace Database\Seeders;

use App\Models\Admin\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instructor::create([
            'national_id' => '12345678901111',
            'fname' => 'Ahmed',
            'lname' => 'Mohamed',
            'email' => 'ahmed.instructor@iti.gov.eg',
            'phone' => '01012345678',
            'job_tittle' => 'Senior Developer',
            'password' => bcrypt('123456'),
        ]);

        Instructor::create([
            'national_id' => '12345678902222',
            'fname' => 'Sara',
            'lname' => 'Ali',
            'email' => 'sara.instructor@iti.gov.eg',
            'phone' => '01123456789',
            'job_tittle' => 'AI Specialist',
            'password' => bcrypt('123456'),
        ]);

        Instructor::create([
            'national_id' => '12345678903333',
            'fname' => 'Mohamed',
            'lname' => 'Hassan',
            'email' => 'mohamed.instructor@iti.gov.eg',
            'phone' => '01234567890',
            'job_tittle' => 'Data Scientist',
            'password' => bcrypt('123456'),
        ]);
    }
}
