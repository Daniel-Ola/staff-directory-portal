<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="font-w700" href="{{ route('home') }}">
                        <img src="{{ asset('assets/media/citi_assets/logo.png') }}" alt="CITITRUST" class="img-fluid" />
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="img-avatar img-avatar32" src="{{ asset('assets/media/avatars/avatar15.jpg') }}" alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="/profile/view">
                    <img class="img-avatar" src="{{ asset('assets/media/avatars/avatar15.jpg') }}" alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href="/profile/view">{{ substr(Auth::user()->firstname, 0, 1) }}. {{ Auth::user()->lastname }}</a>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark"  href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form2').submit();">
                            <i class="si si-logout"></i>
                        </a>
                        <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a href="/home"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>
                <li>
                    <a href="/staffs/view"><i class="si si-cup"></i><span class="sidebar-mini-hide">Staff Directory</span></a>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-badge"></i><span class="sidebar-mini-hide">Profile</span></a>
                    <ul>
                        <li>
                            <a class="" data-toggle="" href="/profile/view"><span class="sidebar-mini-hide">View</span></a>
                        </li>
                        <li>
                            <a class="" data-toggle="" href="/profile/edit"><span class="sidebar-mini-hide">Edit</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>