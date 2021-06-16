<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RestCord\DiscordClient;
use App\Models\Quote;
use App\Models\DiscordUser;

class DiscordUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('discord_users')->truncate();

        $quotes=DB::table('quotes')->get();

        $discord=new DiscordClient(['token' => env('DISCORD_BOT_SECRET')]);

        DiscordUser::upsert(['id'=>0,'name'=>"Null"], ['id'], ['name']);

        foreach ($quotes as $quote) {
            if ($quote->author_id!=0 and DiscordUser::where('id', $quote->author_id)->doesntExist()) {
                DiscordUser::upsert([
                    'id' => $quote->author_id,
                    'name' => $discord->user->getUser(["user.id" => intval($quote->author_id)])->username
                ], ['id'], ['name']);
                sleep(0.1);
            }
        }

        // $guild=$discord->guild->getGuild(['guild.id' => $server]);

        // $users=App\Models\DiscordUser::all();

        // foreach ($quotes as $quote) {
        //     if (App\DiscordUser::find(intval($quote["author_id"]))==null) {
        //         $user=new App\DiscordUser;
        //         $user->id=intval($quote["author_id"]);
        //         if (intval($quote["author_id"])!=0) {
        //             $user->name=$discord->user->getUser(
        //                 ["user.id" => intval($quote["author_id"])]
        //             )->username;
        //         } else {
        //             $user->name="";
        //         }
        //         $user->save();
        //     }
        // }

    }
}
