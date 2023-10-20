<?php

namespace Fintech\Bell\Commands;

use Illuminate\Console\Command;

class BellCommand extends Command
{
    public $signature = 'bell';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
