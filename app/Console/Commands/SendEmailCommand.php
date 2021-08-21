<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailJob;
use Illuminate\Console\Command;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send simple email via Queue!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $user = 'vinh@mail.com';

        dispatch(new SendEmailJob($user));

        return 0;
    }
}
