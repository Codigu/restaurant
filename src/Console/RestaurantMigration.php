<?php

namespace CopyaRestaurant\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Exception;

class RestaurantMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copya-restaurant:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration for Copya Restaurant.';

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
        if ($this->makeMigration()) {
            $this->info('Migration successfully created!');

            return;
        }
        $this->error('[InvalidArgumentException]');
        $this->error('Migration already exists.');

        return;
    }

    protected function makeMigration()
    {
        $copya_restaurant_setup = __DIR__ . "/stubs/migration/CopyaRestaurantMigration.php";
        $copyaRestaurantMigrationFile = base_path("/database/migrations") . "/" . date('Y_m_d_His') . "_copya_restaurant_migration.php";


        try {
            if (!class_exists('CopyaPostMigration')) {
                if (!file_exists($copyaRestaurantMigrationFile) && $fs = fopen($copyaRestaurantMigrationFile, 'x')) {
                    fwrite($fs, file_get_contents($copya_restaurant_setup));
                    fclose($fs);
                }
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

}
