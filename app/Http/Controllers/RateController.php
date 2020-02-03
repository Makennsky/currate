<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RateController extends Controller
{
    public function getPairHistory(Request $request)
    {
        $pair   =   $request->get('pair');
        try {
            $rates  =   Rate::query()->where('pair', '=', $pair)->get();

            return response(
                $rates,
                Response::HTTP_OK
            );
        } catch (Exception $exception){
            Log::error('error in request:',
                [
                    'message'   =>  $exception->getMessage(),
                    'trace'     =>  $exception->getTraceAsString()
                ]
            );
            return response('request failed',
            Response::HTTP_NO_CONTENT
            );
        }

    }

    public function getMainRates(Request $request)
    {
        $time   =   Carbon::now()->subHour();
        $rates  =   Rate::query()->where('created_at', '<=', $time)->get()->unique('pair')->toArray();
        return response()->json($rates, Response::HTTP_OK);
    }
}
