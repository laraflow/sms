<?php

namespace Fintech\Bell\Seeders;

use Illuminate\Database\Seeder;
use Fintech\Bell\Facades\Bell;

class TriggerActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->data();

        foreach (array_chunk($data, 200) as $block) {
            set_time_limit(2100);
            foreach ($block as $entry) {
                Bell::triggerAction()->create($entry);
            }
        }
    }

    private function data()
    {
        return array();
    }
}
