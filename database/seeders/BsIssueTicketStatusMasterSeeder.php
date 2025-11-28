<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsIssueTicketStatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();

        DB::table('bs_issue_ticket_status_master')->insert([
            ['name' => 'New',                      'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Awaiting Feedback',        'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Feedback Received',        'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pending with Department',  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pending with Technical Team','created_at' => $now, 'updated_at' => $now],
            ['name' => 'Solved',                   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Closed',                   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Reopened',                 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Other',                    'created_at' => $now, 'updated_at' => $now],
        ]);

    }
}
