<?php

namespace Database\Seeders;

use App\Models\Job;
use Bouncer;
use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $others = Job::factory(20)->create();
    }
}
