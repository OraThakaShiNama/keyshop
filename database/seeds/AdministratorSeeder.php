<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->truncate();
        
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "keyshop";
        $administrator->email = "administrator@keyshop.com";
        $administrator->phone = "085238363336";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("keyshop");
        $administrator->avatar = "no-image.png";
        $administrator->address = "kragan, gedangan, sidoarjo";

        $administrator->save();

        $this->command->info("user berhasil di input");
    }
}
