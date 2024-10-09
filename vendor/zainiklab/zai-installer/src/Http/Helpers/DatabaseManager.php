<?php

namespace Zainiklab\ZaiInstaller\Http\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\SQLiteConnection;
use Symfony\Component\Console\Output\BufferedOutput;

class DatabaseManager
{


    // public function migrateAndSeed()
    // {
    //     try {
    //         Artisan::call('migrate:fresh', ['--force'=> true]);
    //         Artisan::call('db:seed', ['--force' => true]);
    //         Artisan::call('storage:link');
    //     } catch (\Exception $e) {
    //         return $this->response($e->getMessage(), 'error');
    //     }
    //     return $this->response('Seed Complete', 'success');

    // }
    public function migrateAndSeed(){
        try {
            Artisan::call('migrate:fresh', ['--force'=> true]);
            Artisan::call('db:seed', ['--force' => true]);
            try {
                Artisan::call('storage:link');
            }catch (\Exception $ex){
                return $this->response('Seed Complete But storage link not work', 'success');
            }
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), 'error');
        }
        return $this->response('Seed Complete', 'success');

    }


    /**
     * Run the migration and call the seeder.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function migrate(BufferedOutput $outputLog)
    {
        try {
            Artisan::call('migrate:fresh', ['--force'=> true], $outputLog);
        } catch (\Exception $e) {
            return $this->response('Migration not Complete', 'error', $outputLog);
        }
        return $this->response('Seed Complete', 'success', $outputLog);

    }

    /**
     * Seed the database.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function seed(BufferedOutput $outputLog)
    {
        try {
            Artisan::call('db:seed', ['--force' => true], $outputLog);
        } catch (\Exception $e) {
            return $this->response('Seeding not Complete', 'error', $outputLog);
        }

        return $this->response('Seed Complete', 'success', $outputLog);
    }

    /**
     * Return a formatted error messages.
     *
     * @param string $message
     * @param string $status
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function response($message, $status)
    {
        return [
            'status' => $status,
            'message' => $message
        ];
    }

    /**
     * Check database type. If SQLite, then create the database file.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     */
    private function sqlite(BufferedOutput $outputLog)
    {
        if (DB::connection() instanceof SQLiteConnection) {
            $database = DB::connection()->getDatabaseName();
            if (! file_exists($database)) {
                touch($database);
                DB::reconnect(Config::get('database.default'));
            }
            $outputLog->write('Using SqlLite database: '.$database, 1);
        }
    }
}
