<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SettingController;


class dbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create library_manucop backup';

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
    public function handle()
    {
        $controller = new SettingController();
        $controller->exportDB();

        // $dir = 'D:/library_manucop_backups/' . date('Y-m-d') . '/';
        // if (!file_exists($dir)) {
        //     mkdir($dir, 0777, true);
        // }
        // $filename = $dir . env('DB_DATABASE') . '_' . time() . '.sql';
        // $command = "C:/xampp/mysql/bin/mysqldump.exe --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " > " . $filename;
        // exec($command);
    }
}