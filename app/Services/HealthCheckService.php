<?php

namespace App\Services;

use App\Exceptions\HealthCheckException;
use App\Models\HealthCheck;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HealthCheckService
{

    private function checkDb(): bool
    {
        try {
            $db = DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function checkCache(): bool
    {
        try {
            /** we use different store as default, because Cache default
             * connection checked when app init
             */
            Cache::store('redis')->set('test', 'aga');
            Cache::store('redis')->delete('test');
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function saveHealthcheck($attributes = [])
    {
        HealthCheck::create($attributes);
    }

    /**
     * @throws HealthCheckException
     */
    public function check(string $owner): array
    {
       $db = $this->checkDb();
       $cache = $this->checkCache();

           $result = [
                'db' => $db,
                'cache' => $cache
            ];
        if ($db) {
            $this->saveHealthcheck(array_merge($result, ['owner' => $owner]));
        }

        if ($db && $cache) {
            return $result;
        }

        throw new HealthCheckException (json_encode($result));
    }
}