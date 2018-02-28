<?php

namespace App\Http\Middleware;

use Closure;
use Request;

/*
 * So, about this.
 * Charon expect relationship items to have an extra "items" attribute.
 * This allows metadata (like pagination) to be added to any related collection.
 *
 * Since your order input doesn't use that syntax, we need this middleware to translate the json input
 * to input that Charon can understand. This could be done in the controller, but this makes it look better.
 */

/**
 * Class TransformOrderToCharon
 * @package App\Http\Middleware
 */
class TransformOrderToCharon
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $content = json_decode(Request::instance()->getContent(), true);

        if ($content) {
            // Look for the "items" part.
            if (isset($content['items'])) {
                $content['items'] = [
                    'items' => $content['items']
                ];
            }
        }

        //Request::instance()->setContent(json_encode($content));

        return $next($request);
    }
}