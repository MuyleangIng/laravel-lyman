<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('user_dashboard') }}">User Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('user_dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('user/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user_dashboard') }}"><i class="fa-solid fa-palette"></i> <span>Dashboard</span></a></li>

            <li class="{{ Request::is('user/event/tickets') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user_event_tickets') }}"><i class="fa-solid fa-ticket"></i> <span>Event Tickets</span></a></li>

            <li class="{{ Request::is('user/cause/donations') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user_cause_donations') }}"><i class="fa-solid fa-handshake-angle"></i> <span>Cause Donations</span></a></li>

            <li class="{{ Request::is('user/causes') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user_cause') }}"><i class="fa-solid fa-hand-holding-heart"></i> <span>Causes</span></a></li>

        </ul> 
    </aside>
</div>