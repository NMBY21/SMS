<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        $permissions = [
            // Admin Permissions
            'manage_teachers',           // Manage teachers
            'manage_students',           // Manage students
            'manage_subjects',           // Manage subjects
            'manage_grades',             // Manage grades
            'assign_grades_to_students', // Assign grades to students
            'assign_grades_to_teachers', // Assign grades to teachers
            'view_grades',               // View grades
            'view_students',             // View students
            'view_teachers',             // View teachers
            'assign_roles',              // Assign roles to users
            'assign_subjects_to_teachers', // Assign subjects to teachers

            // Teacher Permissions
            'view_own_grades',           // View own grades
            'assign_marks_to_students',  // Assign marks to students
            'view_students_grades',      // View students' grades

            // Student Permissions
            'view_own_grades',           // View own grades
            'view_their_marks',          // View their marks
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            // Check if the permission already exists
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);

        // Assign Permissions to Roles

        // Admin has all permissions
        $adminRole->givePermissionTo(Permission::all());

        // Teacher role permissions
        $teacherRole->givePermissionTo([
            'view_own_grades',
            'assign_marks_to_students',
            'view_students_grades',
        ]);

        // Student role permissions
        $studentRole->givePermissionTo([
            'view_own_grades',
            'view_their_marks',
        ]);

        // Optionally create a default Admin user with admin role
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@school.com',
            'password' => bcrypt('password123'), // Change password as needed
        ]);

        // Assign the admin role to the created user
        $adminUser->assignRole('admin');
    }
}
