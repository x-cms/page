<?php

namespace Xcms\Page\Http\Middleware;

use Closure;
use Xcms\Page\Models\Page;

class NavMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        nav()->registerLinkType('page', function ($id) {
            $page = Page::find($id);
            if (!$page) {
                return null;
            }
            return [
                'model_title' => $page->title,
                'url' => $page->slug,
            ];
        });

        return $next($request);
    }
}
