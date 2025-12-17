<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsReasonMasterNotTransferredInMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('bs_reason_master_not_transferred_in_master')->insert([
            [
                'id' => 1,
                'name' => 'Admitted in SSK',
                'status' => 2, // O
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Admitted in MSK',
                'status' => 2, // O
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'Admitted in Madrasah',
                'status' => 2, // O
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Admitted in Private School',
                'status' => 1, // N
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'Admitted in Central School (JNV/ KV/ Railway Board etc.)',
                'status' => 1, // N
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'name' => 'Not yet admitted in any school',
                'status' => 1, // N
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'name' => 'Died',
                'status' => 1, // N
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'name' => 'Migrated',
                'status' => 1, // N
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'name' => 'Admitted in other Dept. School',
                'status' => 1, // N
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

    }
}
