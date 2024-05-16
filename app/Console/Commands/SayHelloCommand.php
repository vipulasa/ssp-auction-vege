<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SayHelloCommand extends Command
{
    protected $signature = 'say:hello';

    protected $description = 'Command description';

    public function handle(): void
    {
        $this->line('Hello, World!');
    }
}
