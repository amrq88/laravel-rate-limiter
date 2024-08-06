<?php

namespace Rapidsquirrel\LaravelRateLimiter\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class RateLimiter
{
    protected $maxAttempts;
    protected $decayMinutes;

    public function __construct($maxAttempts = 60, $decayMinutes = 1)
    {
        $this->maxAttempts = $maxAttempts;
        $this->decayMinutes = $decayMinutes;
    }

    public function handle($request, Closure $next)
    {
        $key = $this->resolveRequestKey($request);

        if ($this->tooManyAttempts($key)) {
            return $this->buildResponse();
        }

        $this->hit($key);

        return $next($request);
    }

    protected function resolveRequestKey($request)
    {
        return sha1($request->ip());
    }

    protected function tooManyAttempts($key)
    {
        return Cache::get($key, 0) >= $this->maxAttempts;
    }

    protected function hit($key)
    {
        $hits = Cache::get($key, 0) + 1;
        Cache::put($key, $hits, $this->decayMinutes * 60);
    }

    protected function buildResponse()
    {
        return response()->json([
            'message' => 'Too many requests. Please try again later.'
        ], Response::HTTP_TOO_MANY_REQUESTS);
    }
}
