<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
    @switch ($user->role_id)
        @case(1)
            <li><a href="/app" class="nav-link px-2 link-dark">Application</a></li>
            <li>
                @if($user->appIsVerified)
                    <a href="/interview" class="nav-link px-2 link-dark">Interview</a>
                @else
                    <p class="nav-link px-2 link-secondary">Interview</p>
                @endif
            </li>
            @break
        @case(2)
            <li><a href="/app/list" class="nav-link px-2 link-dark">Applications</a></li>
            @break
        @case(3)
            <li><a href="/profile" class="nav-link px-2 link-dark">Profile</a></li>
            <li><a href="/schedule" class="nav-link px-2 link-dark">Schedule</a></li>
            @break
        @case(4)
            <li><a href="/pages/1" class="nav-link px-2 link-dark">Main page</a></li>
            <li><a href="/roles" class="nav-link px-2 link-dark">Roles</a></li>
            <li><a href="/report" class="nav-link px-2 link-dark">Report</a></li>
            @break
    @endswitch
</ul>
<div class="col-md-3 text-end">
    <a class="btn btn-border-blue me-2" href="/dashboard">Dashboard</a>
    <a class="btn btn-all-blue" href="/auth/logout">Logout</a>
</div>
