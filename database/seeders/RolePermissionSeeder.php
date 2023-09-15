<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Follow Spatie Official Documentation

        // create roles
        $blog_writer = Role::create(['name' => 'blog_writer']);
        $review_writer = Role::create(['name' => 'review_writer']);


        // permission list
        $permissions = [

            // write route names, I have multiguard,
            // I am using web guard for user and need role permission for user or web guard

            // User accessable route write here for seed.

            'user_dashboard.index',

            'user_dashboard.blog.create',
            'user_dashboard.blog.index',
            'user_dashboard.blog.edit',
            'user_dashboard.blog.update',
            'user_dashboard.blog.delete',

        ];


        // create and assign permission
        for ($i = 0; $i < count($permissions); $i++) {
            // create permission
            $permission = Permission::create(['name' => $permissions[$i]]);

            // give permission
            $blog_writer->givePermissionTo($permission);

        }



    }
}
