<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    protected $roles_levels = [
        "participant" => 1,
        "staff" => 2,
        "admin" => 3
    ];

    /**
     * Check users's role on event
     * 
     * @param int $event_id
     * @param string $expected_role
     * @param \App\Models\User $user
     * @return boolean
     */
    public function checkRoleForEvent($event_id, $expected_role, $user)
    {
        $role = $user->roles()->where("event_id", $event_id)->first();

        if (!isset($role) || $role->Authorization < $this->roles_levels[$expected_role]) {
            return false;
        }

        return true;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        switch ($role) {
            case "admin":
                if ($user->admin == false) {
                    return response()->json(["message" => "Admin role required", 403]);
                }
                break;
            case "staff":
                $event_id = $request->route("id");
                if (!$this->checkRoleForEvent($event_id, "staff", $user)) {
                    return response()->json(["message" => "Staff role required", 403]);
                }
                break;
            case "participant":
                $event_id = $request->route("id");
                if (!$this->checkRoleForEvent($event_id, "participant", $user)) {
                    return response()->json(["message" => "Participant role required", 403]);
                }
                break;
            default:
                break;
        }

        return $next($request);
    }
}
