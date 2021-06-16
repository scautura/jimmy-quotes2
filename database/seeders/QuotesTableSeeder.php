<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Quote;
// use RestCord\DiscordClient;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quotes')->truncate();

        $json=Storage::disk('local')->get("quotes.json");
        $json=json_decode($json, true);

        $server=intval(env('DISCORD_SERVER'));

        $quotes=$json[$server];

        foreach ($quotes as $quote) {
            Quote::create(array(
                'added_by' => $quote["added_by"],
                'author_id' => $quote["author_id"],
                'author_name' => $quote["author_name"],
                'text' => $quote["text"]
            ));
        }
    }
}
