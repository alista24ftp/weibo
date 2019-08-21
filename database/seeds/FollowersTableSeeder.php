<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // retrieve all user ids except for id=1
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        // Follow all users except user with id=1 (self)
        $user->follow($follower_ids);

        // All users (except user with id=1) follow user with id=1
        foreach($followers as $follower){
            $follower->follow($user_id);
        }
    }
}
