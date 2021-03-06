<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'users_access',
            ],
            [
                'id'    => 2,
                'title' => 'tryouts_access',
            ],
            [
                'id'    => 3,
                'title' => 'support_access',
            ],
            [
                'id'    => 4,
                'title' => 'register-to_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
