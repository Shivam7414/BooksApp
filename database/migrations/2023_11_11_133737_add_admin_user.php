<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

return new class extends Migration
{
    public function up()
    {
        $admin = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
        ];

        Admin::insert($admin);
    }

    public function down()
    {
        Admin::where('email', 'admin@example.com')->delete();
    }
};
