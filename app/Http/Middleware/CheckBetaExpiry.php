<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckBetaExpiry
{
    public function handle($request, Closure $next)
    {
        $installationDate = DB::table('settings')->value('installation_date');

        if (!$installationDate) {
            // Set the installation date if not set
            DB::table('settings')->update(['installation_date' => Carbon::now()]);
        } else {
            $installationDate = Carbon::parse($installationDate);
            $currentDate = Carbon::now();
            $diffDays = $currentDate->diffInDays($installationDate);

            if ($diffDays > 7) {
                return response('The beta period has expired. Please contact support.', 403);
            }
        }

        return $next($request);
    }
}
