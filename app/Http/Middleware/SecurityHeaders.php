<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Security headers to protect the website
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN'); // Prevents clickjacking
        $response->headers->set('X-Content-Type-Options', 'nosniff'); // Prevents MIME sniffing
        $response->headers->set('X-XSS-Protection', '1; mode=block'); // Force browser XSS filter
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade'); // Protect referrer privacy
        
        return $response;
    }
}
