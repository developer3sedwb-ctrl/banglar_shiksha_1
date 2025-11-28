<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsIssueCategoryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_issue_category_master')->insert([
            ['name' => 'Issues regarding Bulk Upload', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Bank Details Mismatch',       'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Add Section/Class',           'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Add School under this circle','created_at' => $now, 'updated_at' => $now],
            ['name' => 'Delete School under this Circle','created_at' => $now, 'updated_at' => $now],
            ['name' => 'Delete Duplicate entry data', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Change School Name',         'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Add Teacher Name',           'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Data mismatch',               'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Others',                     'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Password Reset',             'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
