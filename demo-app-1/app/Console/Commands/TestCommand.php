<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\SignalAwareCommand\SignalAwareCommand;

class TestCommand extends SignalAwareCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this -> info('Test command executed');
        $pid = getmypid();
        $this -> info("PID: $pid");
        // store pid in cache 
        cache() -> put('test-command-pid', $pid);
        sleep(1000);
        
    }

    public function onSigint(): void
    {
        $this -> info('SIGINT received');
        sleep(10);
    }

    public function onSigterm(): void
    {
        $this -> info('SIGTERM received');
        sleep(10);
    }

    public function onSighup(): void
    {
        $this -> info('SIGHUP received');
        sleep(10);
    }
}
