<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionAccess
{
    /**
     * Handle an incoming request.
     *
     * Usage:
     * subscription:exam
     * subscription:question_bank
     * subscription:current_affairs
     * subscription:major_test
     * subscription:assigned_test
     * subscription:public_exam
     * subscription:advanced_reports
     */
    public function handle(
        Request $request,
        Closure $next,
        string $feature
    ): Response {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Authentication is required.');
        }

        /*
         * Malav Technologies platform admin bypass.
         *
         * Only the explicitly configured platform-admin
         * email gets subscription bypass.
         *
         * Customer/library users remain subscription-protected,
         * even if they have the "Super Admin" role.
         */
        $platformAdminEmail = config('app.platform_admin_email');

        if (
            $platformAdminEmail &&
            strcasecmp((string) $user->email, (string) $platformAdminEmail) === 0
        ) {
            return $next($request);
        }

        if (!$user->library_id) {
            abort(403, 'Library access is required.');
        }

        $subscription = $user->library
            ->subscriptions()
            ->with('plan')
            ->whereIn('status', ['trial', 'active'])
            ->whereDate('starts_at', '<=', now())
            ->whereDate('ends_at', '>=', now())
            ->latest('ends_at')
            ->first();

        /*
         * No active subscription:
         * send the library user to the dedicated
         * subscription-expired page.
         */
        if (!$subscription || !$subscription->plan) {
            return redirect()->route('subscription.expired');
        }

        $featureColumns = [
            'exam' => 'exam_access',
            'question_bank' => 'question_bank_access',
            'current_affairs' => 'current_affairs_access',
            'major_test' => 'major_test_access',
            'assigned_test' => 'assigned_test_access',
            'public_exam' => 'public_exam_access',
            'advanced_reports' => 'advanced_reports_access',
        ];

        if (!isset($featureColumns[$feature])) {
            abort(403, 'Invalid subscription feature.');
        }

        $column = $featureColumns[$feature];

        if (!$subscription->plan->{$column}) {
            abort(403, 'This feature is not included in your current plan.');
        }

        return $next($request);
    }
}