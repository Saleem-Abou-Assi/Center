<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckBetaExpiry
{
    public function handle($request, Closure $next)
    {
        $installationDate = DB::table('settings')->get()->first()?->installation_date;

        if (!$installationDate) {
            // Set the installation date if not set
            $setting = new Setting();
            $setting->save();
        } else {
            $currentDate = Carbon::now();
            $diffDays = $currentDate->diffInDays($installationDate);

            if ($diffDays > 7) {
                return response('The beta period has expired. Please contact support.', 403);
            }
        } 

        return $next($request);
    }
}
