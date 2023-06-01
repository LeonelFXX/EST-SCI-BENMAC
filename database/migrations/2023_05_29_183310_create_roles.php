<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role1 = Role::create(['name' => 'administrador']); // Crea un rol
        $role2 = Role::create(['name' => 'manager']);

        $user = User::find(1); // Buscamos por ID
        $user->assignRole($role1); // Asignamos el rol

        $user2 = User::find(2); 
        $user2->assignRole($role2);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
