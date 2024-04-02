<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_dashboard') }}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_dashboard') }}"><i class="fas fa-hand-point-right"></i> <span>Dashboard</span></a></li>

            <li class="{{ Request::is('admin/settings/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_settings_index') }}"><i class="fas fa-hand-point-right"></i> <span>Settings</span></a></li>

            <li class="{{ Request::is('admin/slider/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_slider_index') }}"><i class="fas fa-hand-point-right"></i> <span>Sliders</span></a></li>

            <li class="{{ Request::is('admin/special/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_special_edit') }}"><i class="fas fa-hand-point-right"></i> <span>Special</span></a></li>

            <li class="{{ Request::is('admin/feature/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_feature_index') }}"><i class="fas fa-hand-point-right"></i> <span>Features</span></a></li>

            <li class="{{ Request::is('admin/testimonial/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_testimonial_index') }}"><i class="fas fa-hand-point-right"></i> <span>Testimonials</span></a></li>

            <li class="{{ Request::is('admin/counter/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_counter_edit') }}"><i class="fas fa-hand-point-right"></i> <span>Counters</span></a></li>

            <li class="{{ Request::is('admin/faq/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_index') }}"><i class="fas fa-hand-point-right"></i> <span>FAQs</span></a></li>

            <li class="{{ Request::is('admin/volunteer/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_volunteer_index') }}"><i class="fas fa-hand-point-right"></i> <span>Volunteers</span></a></li>

            <li class="{{ Request::is('admin/home-page/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_home_page_index') }}"><i class="fas fa-hand-point-right"></i> <span>Home Page Items</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/photo-category/*')||Request::is('admin/photo/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Photo Gallery</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/photo-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_photo_category_index') }}"><i class="fas fa-angle-right"></i> Categories</a></li>
                    <li class="{{ Request::is('admin/photo/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_photo_index') }}"><i class="fas fa-angle-right"></i> Photos</a></li>
                </ul>
            </li>


            <li class="nav-item dropdown {{ Request::is('admin/video-category/*')||Request::is('admin/video/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Video Gallery</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/video-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_video_category_index') }}"><i class="fas fa-angle-right"></i> Categories</a></li>
                    <li class="{{ Request::is('admin/video/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_video_index') }}"><i class="fas fa-angle-right"></i> Videos</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/post-category/*')||Request::is('admin/post/*')||Request::is('admin/comments')||Request::is('admin/replies') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Blog Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/post-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_post_category_index') }}"><i class="fas fa-angle-right"></i> Categories</a></li>
                    <li class="{{ Request::is('admin/post/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_post_index') }}"><i class="fas fa-angle-right"></i> Posts</a></li>
                    <li class="{{ Request::is('admin/comments') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_comment') }}"><i class="fas fa-angle-right"></i> Comments</a></li>
                    <li class="{{ Request::is('admin/replies') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_reply') }}"><i class="fas fa-angle-right"></i> Replies</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/subscriber/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Subscriber Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/subscriber/index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscriber_index') }}"><i class="fas fa-angle-right"></i> All Subscribers</a></li>
                    <li class="{{ Request::is('admin/subscriber/send-message') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscriber_send_message') }}"><i class="fas fa-angle-right"></i> Send Message to All</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/event/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_event_index') }}"><i class="fas fa-hand-point-right"></i> <span>Events</span></a></li>

            <li class="{{ Request::is('admin/cause/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_cause_index') }}"><i class="fas fa-hand-point-right"></i> <span>Causes</span></a></li>

            <li class="{{ Request::is('admin/other-pages/terms') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_terms_page') }}"><i class="fas fa-hand-point-right"></i> <span>Terms Page</span></a></li>

            <li class="{{ Request::is('admin/other-pages/privacy') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_privacy_page') }}"><i class="fas fa-hand-point-right"></i> <span>Privacy Page</span></a></li>
            

        </ul>
    </aside>
</div>