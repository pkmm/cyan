<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\User::class, 1)->create()->each(function ($u) {
            $role = factory(App\Model\Role::class)->make();
            $role->save();
            $u->roles()->attach($role->id);
        });
    }
}
