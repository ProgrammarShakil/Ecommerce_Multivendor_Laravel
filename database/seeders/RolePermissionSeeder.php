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


        // ## Permission list ##
        // Write route names, I have multi guard,
        // I am using web guard for user and need role permission for user or web guard
        // User access able route write here for seed.

        $all_permissions = [
            [
                'group_name' => 'blog',
                'permissions' => [
                    'user_dashboard.blog.create',
                    'user_dashboard.blog.index',
                    'user_dashboard.blog.edit',
                    'user_dashboard.blog.update',
                    'user_dashboard.blog.delete'
                ]
            ],

        ];


        // Create and Assign Permission
        for ($index = 0; $index < count($all_permissions); $index++) {

            // Group Name
            $group_name = $all_permissions[$index]['group_name'];

            // Permission Name
            $permissions = $all_permissions[$index]['permissions'];

            for ($nested_index = 0; $nested_index < count($permissions); $nested_index++) {

                // Give Permission
                $give_permission = Permission::create(
                    [
                        'name' => $permissions[$nested_index],
                        'group_name' => $group_name
                    ]
                );
                $blog_writer->givePermissionTo($give_permission);

            }
        }
    }
}
