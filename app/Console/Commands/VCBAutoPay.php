<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VCBAutoPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vcb:ap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vietcombank AutoPay';

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
        $request = Request::create(route('bank'), 'POST');
        $response = app()->handle($request);
        $responseBody = $response->getContent();
        return $responseBody;
    }
}
