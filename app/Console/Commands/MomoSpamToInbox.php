<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class MomoSpamToInbox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'momo:sti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Momo Spam To Inbox';

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
     * @return mixed
     */
    public function handle()
    {
        $request = Request::create(route('momo.spamtoinbox'),'GET');
        $response = app()->handle($request);
        $responseBody = $response->getContent();
        return $responseBody;
    }
}
