<?php

namespace Zainiklab\ZaiInstaller\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Zainiklab\ZaiInstaller\Events\EnvironmentSaved;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Zainiklab\ZaiInstaller\Http\Helpers\DatabaseManager;

class InstallController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;
    private $logger;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->logger = new Logger(storage_path() . '/logs/' . 'install.log');
        $this->databaseManager = $databaseManager;
    }

    public function preInstall()
    {
        $route_value = 0;
        $resource_value = 0;
        $public_value = 0;
        $storage_value = 0;
        $env_value = 0;
        //        $route_perm = substr(sprintf('%o', fileperms(base_path('routes'))), -4);
        //        if($route_perm == '0777') {
        //            $route_value = 1;
        //        }
        $resource_prem = substr(sprintf('%o', fileperms(base_path('resources'))), -4);
        if ($resource_prem == '0777' || $resource_prem == '0775') {
            $resource_value = 1;
        }
        $public_prem = substr(sprintf('%o', fileperms(base_path('public'))), -4);
        if ($public_prem == '0777' || $public_prem == '0775' || $public_prem == '0750') {
            $public_value = 1;
        }
        $storage_prem = substr(sprintf('%o', fileperms(base_path('storage'))), -4);
        if ($storage_prem == '0777' || $storage_prem == '0775') {
            $storage_value = 1;
        }
        $env_prem = substr(sprintf('%o', fileperms(base_path('.env'))), -4);
        if ($env_prem == '0777' || $env_prem == '0666' || $env_prem == '0644' || $env_prem == '0775' || $env_prem == '0664') {
            $env_value = 1;
        }
        if (file_exists(storage_path('installed'))) {
            return redirect('/');
        }
        return view('zainiklab.installer.pre-install', compact('route_value', 'resource_value', 'public_value', 'storage_value', 'env_value'));
    }

    public function configuration()
    {
        if (file_exists(storage_path('installed'))) {
            return redirect('/');
        }
        if (session()->has('validated')) {
            $data['is_active'] = true;
            return view('zainiklab.installer.config', $data);
        }
        return redirect(route('ZaiInstaller::pre-install'));
    }

    public function serverValidation(Request $request)
    {
        if ($this->phpversion() > 7.0 && $this->mysqli() == 1 && $this->curl_version() == 1 && $this->allow_url_fopen() == 1 && $this->openssl() == 1 && $this->pdo() == 1 && $this->bcmath() == 1 && $this->ctype() == 1 && $this->fileinfo() == 1 && $this->mbstring() == 1 && $this->tokenizer() == 1 && $this->xml() == 1 && $this->json() == 1) {
            session()->put('validated', 'Yes');
            return redirect(route('ZaiInstaller::config'));
        }
        session()->forget('validated');
        return redirect(route('ZaiInstaller::pre-install'));
    }

    public function phpversion()
    {
        return phpversion();
    }

    public function mysqli()
    {
        return extension_loaded('mysqli');
    }

    public function curl_version()
    {
        return function_exists('curl_version');
    }

    public function allow_url_fopen()
    {
        return ini_get('allow_url_fopen');
    }

    public function openssl()
    {
        return extension_loaded('openssl');
    }

    public function pdo()
    {
        return extension_loaded('pdo');
    }

    public function bcmath()
    {
        return extension_loaded('bcmath');
    }

    public function ctype()
    {
        return extension_loaded('ctype');
    }

    public function fileinfo()
    {
        return extension_loaded('fileinfo');
    }

    public function mbstring()
    {
        return extension_loaded('mbstring');
    }

    public function tokenizer()
    {
        return extension_loaded('tokenizer');
    }

    public function xml()
    {
        return extension_loaded('xml');
    }

    public function json()
    {
        return extension_loaded('json');
    }

    public function final(Request $request)
    {
        if (config('app.app_code')) {
            $isValidDomain = $this->is_valid_domain_name($request->fullUrl());

            if ($isValidDomain) {
                $rules = [
                    'app_name' => 'bail|required',
                ];
            } else {
                $rules = [
                    'purchase_code' => 'required',
                    'email' => 'bail|required|email',
                    'app_name' => 'bail|required',
                ];
            }

            $request->validate($rules, [
                'purchase_code.required' => 'Purchase code field is required',
                'email.required' => 'Customer email field is required',
                'email.email' => 'Customer email field is must a valid email',
                'app_name.required' => 'App name field is required',
            ]);

            $requestData = [
                'app' => config('app.app_code'),
                'type' => 0,
                'email' => $request->email,
                'purchase_code' => $request->purchase_code,
                'version' => config('app.build_version'),
                'url' => $request->fullUrl(),
                'app_url' => $request->app_url
            ];


            if (!$this->checkDatabaseConnection($request)) {
                return Redirect::back()->withErrors('Database credentials are not correct, or the mysql server is down !');
            }

            if (true) {
                if (true) {
                    try {
                        $results = $this->saveENV($request);
                        //event(new EnvironmentSaved($request));
                        $lqsFile = storage_path('lqs');
                        file_put_contents($lqsFile, 'local');
                        return Redirect::route('ZaiInstaller::database')->with(['results' => $results]);
                    } catch (\Exception $e) {
                        return Redirect::back()->withErrors($e->getMessage());
                    }
                } else {
                    return Redirect::back()->withErrors($data->message);
                }
            } else {
                return Redirect::back()->withErrors('Something went wrong with your purchase key.');
            }
        } else {
            return Redirect::back()->withErrors('Something went wrong with your purchase key.');
        }
    }

    public function is_valid_domain_name($url)
    {
        try {
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function saveInfoInFile($url, $purchase_code)
    {
        $infoFile = storage_path('info');
        if (file_exists($infoFile)) {
            unlink($infoFile);
        }
        $data = json_encode([
            'd' => base64_encode($this->get_domain_name($url)),
            'i' => date('ymdhis'),
            'p' => base64_encode($purchase_code),
            'u' => date('ymdhis'),
        ]);
        file_put_contents($infoFile, $data);
    }

    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();
        if ($response['status'] == 'success') {
            $lqsFile = storage_path('lqs');
            $getInfoFile = storage_path('info');
            try {
                if (file_exists($lqsFile)) {
                    $lqs = file_get_contents($lqsFile);
                    unlink($lqsFile);
                } elseif (!$this->is_valid_domain_name(request()->fullUrl())) {
                    $lqs = file_get_contents(config('app.sql_path'));
                }

                if($lqs == 'local'){
                    $lqs = file_get_contents(config('app.sql_path'));
                }

                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                if ($lqs != null && $lqs != "") {
                    DB::unprepared($lqs);
                }
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                $installedLogFile = storage_path('installed');
                if (file_exists($getInfoFile)) {
                    $data = file_get_contents($getInfoFile);
                    unlink($getInfoFile);
                } else {
                    $data = json_encode([
                        'd' => base64_encode($this->get_domain_name(request()->fullUrl())),
                        'i' => date('ymdhis'),
                        'u' => date('ymdhis'),
                    ]);
                }

                if (!file_exists($installedLogFile)) {
                    file_put_contents($installedLogFile, $data);
                }
                return redirect('/');
            } catch (\Exception $e) {
                if (file_exists($lqsFile)) {
                    unlink($lqsFile);
                }
                if (file_exists($getInfoFile)) {
                    unlink($getInfoFile);
                }
                DB::rollBack();
                return Redirect::back()->withErrors('Something went wrong!');
            }
        } else {
            return Redirect::back()->withErrors($response['message']);
        }
    }
    function get_domain_name($url)
    {
        $parseUrl = parse_url(trim($url));
        if (isset($parseUrl['host'])) {
            $host = $parseUrl['host'];
        } else {
            $path = explode('/', $parseUrl['path']);
            $host = $path[0];
        }
        return  trim($host);
    }
    public function saveENV(Request $request)
    {
        //$env_val['APP_KEY'] = 'base64:' . base64_encode(Str::random(32));//got errors on test server ubuntu 14
        $env_val['APP_URL'] = $request->app_url;
        $env_val['DB_HOST'] = $request->db_host;
        $env_val['DB_DATABASE'] = $request->db_name;
        $env_val['DB_USERNAME'] = $request->db_user;
        $env_val['DB_PASSWORD'] = $request->db_password;
        $env_val['MAIL_HOST'] = $request->mail_host;
        $env_val['MAIL_PORT'] = $request->mail_port;
        $env_val['MAIL_USERNAME'] = $request->mail_username;
        $env_val['MAIL_PASSWORD'] = $request->mail_password;
        $this->setEnvValues($env_val);
    }

    public function setEnvValues($values)
    {
        if (count($values) > 0) {
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            foreach ($values as $envKey => $envValue) {
                $str = str_replace("{{".$envKey."}}", $envValue, $str);
            }
            file_put_contents($envFile, $str);
        }
        return true;
    }

    private function checkDatabaseConnection(Request $request)
    {
        $connection = 'mysql';

        $settings = config("database.connections.mysql");

        config([
            'database' => [
                'default' => 'mysql',
                'connections' => [
                    'mysql' => array_merge($settings, [
                        'driver' => 'mysql',
                        'host' => $request->db_host,
                        'port' => '3306',
                        'database' => $request->db_name,
                        'username' => $request->db_user,
                        'password' => $request->db_password,
                    ]),
                ],
            ],
        ]);

        DB::purge();
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
