<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckBetaExpiry
{
    public function handle($request, Closure $next)
    {
        $installationDate = DB::table('settings')->get()->first()->installation_date;

        if (!$installationDate) {
            // Set the installation date if not set
            DB::table('settings')->insert([
                'installation_date' =>  Carbon::now()
            ]);
            // DB::table('settings')->first()->update(['installation_date' => Carbon::now()->toDateString()]);
            if (1) {
                return response('The beta period has expired. Please contact support.'.Carbon::now(), 403);
            }
        } else {
            // $installationDate = Carbon::parse($installationDate);
            $currentDate = Carbon::now();
            $diffDays = $currentDate->diffInDays($installationDate);

            if ($diffDays < 0) {
                return response('The beta period has expired. Please contact support.'.$diffDays, 403);
            }
        } 

        return $next($request);
    }
}
