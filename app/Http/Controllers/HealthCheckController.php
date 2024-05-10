<?php

namespace App\Http\Controllers;

use App\Exceptions\HealthCheckException;
use App\Models\HealthCheck;
use App\Services\HealthCheckService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use function response;

class HealthCheckController extends Controller
{

    public function check(Request $request, HealthCheckService $healthCheckService)
    {
        try{
            $result = $healthCheckService
                    ->check($request->header('x-owner'));

           // dd($result);
            return response()->json($result);
        }catch(HealthCheckException $e){
           return response()-> json(json_decode($e->getMessage(),true),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }catch (Exception $e){
            return response()-> json($e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

}