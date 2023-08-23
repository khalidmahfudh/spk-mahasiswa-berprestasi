<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->id = 1;
        $user->name = "khalid mahfudz";
        $user->username = "khalidmahfudh";
        $user->email = "khalid@gmail.com";
        $user->image = "default.jpg";
        $user->role = "admin";
        $user->password = '$2a$12$HSaPv4D7L2rE57vBfFQ/oOraU7pUl/.FGnoIlcoNX3aS9AXENDFqy';
        $user->is_active = true;
        $user->save();

        $user = new User();
        $user->id = 2;
        $user->name = "john doe";
        $user->username = "johndoe";
        $user->email = "john@gmail.com";
        $user->image = "default.jpg";
        $user->role = "user";
        $user->password = '$2a$12$HSaPv4D7L2rE57vBfFQ/oOraU7pUl/.FGnoIlcoNX3aS9AXENDFqy';
        $user->is_active = true;
        $user->save();
    }
}
