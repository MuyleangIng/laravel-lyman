<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('user_dashboard') }}">User Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('user_dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('user/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user_dashboard') }}">
                    <i class="fa-solid fa-palette"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ Request::is('user/event/tickets') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user_event_tickets') }}">
                    <i class="fa-solid fa-ticket"></i>
                    <span>Event Tickets</span>
                </a>
            </li>

            <!-- Section for Donations Received from Others -->
            <li class="menu-header">Donations Received</li>
            <li class="{{ Request::is('user/cause/donations-received') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user_cause_donations_received') }}">
                    <i class="fa-solid fa-handshake-angle"></i>
                    <span>Donations Received</span>
                </a>
            </li>

            <!-- Section for Donations Made to Other Causes -->
            <li class="menu-header">Donations Made</li>
            <li class="{{ Request::is('user/cause/donations-made') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user_cause_donations_made') }}">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Donations Made</span>
                </a>
            </li>

            <li class="{{ Request::is('user/cause') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user_cause') }}">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>My Project</span>
                </a>
            </li>

            <!-- Chatbot Section -->
            <li class="{{ Request::is('user/messages') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user_message_list') }}">
                    <i class="fa-solid fa-comments"></i>
                    <span>Chatbot</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
