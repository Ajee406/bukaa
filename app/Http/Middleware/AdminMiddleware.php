<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName();
        if (auth()->user()->role == USER_ROLE_ADMIN) {
            return $next($request);
        } elseif (auth()->user()->role == USER_ROLE_BOARD_MEMBER && in_array($routeName, [
                'committee.admin.committee-election.result-list',
                'committee.admin.committee-election.results',
                'committee.admin.candidates.pending',
                'committee.admin.candidates.final',
                'committee.admin.candidates.view',
                'committee.admin.candidates.status_modal',
                'committee.admin.candidates.status_change',
                'committee.admin.election.results',
                'committee.admin.election.result-list',
                'committee.admin.candidates-comments.index',
                'committee.admin.candidates-comments.status_change_modal',
                'committee.admin.candidates-comments.status_change',
                'committee.admin.votes.index',
                'committee.admin.votes.status-change',
                'committee.admin.votes.submit-result',
            ])) {

            return $next($request);
        }
        abort('403');
    }
}
