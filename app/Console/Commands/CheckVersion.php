<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class CheckVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-version';

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
        try {
            $firebase = App::make('firebase');
            $version = $firebase->getReference('web_version')->getValue();
            $this->info($version);
        } catch (\Throwable $th) {
            //throw $th;
            $this->error($th->getMessage());
        }
    }
}
