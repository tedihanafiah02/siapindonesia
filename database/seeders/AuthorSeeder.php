<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::updateOrCreate(
            ['name' => 'Admin Siap Indonesia'],
            [
                'occupation' => 'Internal Editor',
                'avatar' => 'avatars/admin.png',
                'slug' => 'admin-siap-indonesia'
            ]
        );
    }
}