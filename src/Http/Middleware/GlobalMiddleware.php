<?php

namespace DivineOmega\PhantomJSLaravelTesting\Http\Middleware;

use Closure;
use DB;

class GlobalMiddleware
{
    public function handle($request, Closure $next)
    {
        if (strpos($request->header('User-Agent'), 'test:useDatabaseTransactions')!==false) {
            DB::beginTransaction();
        }

        return $next($request);
    }

}