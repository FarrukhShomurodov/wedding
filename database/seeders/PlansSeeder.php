<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            'title' => 'Basic',
            'price' => 549.0,
            'description' =>
                'Invite card for 60 people,
                 Can add more invite  cards,
                 Can add wedding date,
                 Can add info about couples
                '
        ]);
        DB::table('plans')->insert([
            'title' => 'Standard',
            'price' => 759.0,
            'description' =>
                'Invite card for 80 people,
                 Can add more invite  cards,
                 Can add wedding date,
                 Can add info about couples,
                 Add more events info,
                 Add love history
                '
        ]);
        DB::table('plans')->insert([
            'title' => 'Premium',
            'price' => 1069.0,
            'description' =>
                'Invite card for 100 people,
             	Can add more invite  cards,
             	Can add wedding date,
             	Can add info about couples,
             	Add more events info,
             	Add love history,
             	Get friends wishes ( People can write comments),
             	Gallery (You can add your photos and videos)
            '
        ]);
    }
}
