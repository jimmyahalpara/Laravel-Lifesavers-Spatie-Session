<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SingalCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:signal-command';

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
        // read pid from cache 
        $pid = cache() -> get('test-command-pid');
        // signal list 
        $list = [
            'SIGHUP' => 1,
            'SIGINT' => 2,
            'SIGQUIT' => 3,
            'SIGILL' => 4,
            'SIGTRAP' => 5,
            'SIGABRT' => 6,
            'SIGBUS' => 7,
            'SIGFPE' => 8,
            'SIGKILL' => 9,
            'SIGUSR1' => 10,
            'SIGSEGV' => 11,
            'SIGUSR2' => 12,
            'SIGPIPE' => 13,
            'SIGALRM' => 14,
            'SIGTERM' => 15,
            'SIGSTKFLT' => 16,
            'SIGCHLD' => 17,
            'SIGCONT' => 18,
            'SIGSTOP' => 19,
            'SIGTSTP' => 20,
        ];

        // multi select
        $signal = $this -> choice('Select signal', $list);
        // if singal is string 
        if (is_string($signal)) {
            // get signal number
            $signal = $list[$signal];
        }
        // send signal
        posix_kill($pid, $signal);
    }
}
