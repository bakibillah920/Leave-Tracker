<header class="header">
    <div class="logo-env">
        <a href="/dashboard" class="logo">
            <img src="{{asset('uploads/app_image/logo-small.png')}}" height="40">
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
             data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <div class="header-left hidden-xs">
        <ul class="header-menu">
            <!-- sidebar toggle button -->
            <li>
                <div class="header-menu-icon sidebar-toggle" data-toggle-class="sidebar-left-collapsed"
                     data-target="html" data-fire-event="sidebar-left-toggle">
                    <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </li>
            <!-- full screen button -->
            <li>
                <div class="header-menu-icon s-expand">
                    <i class="fas fa-expand"></i>
                </div>
            </li>
            <!-- shortcut box -->
            <li>
                <div class="header-menu-icon dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-th"></i>
                </div>
            </li>
        </ul>
        <!-- search bar -->
        <span class="separator hidden-sm"></span>
        <form action="student/search" class="search nav-form" method="post" accept-charset="utf-8">
            <input type="hidden" name="school_csrf_name" value="db4b964b7b25e7e88048922955c0e1ba"/>
            <div class="input-group input-search">
                <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search">
                <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
    </div>
    <div class="header-right">
        <ul class="header-menu">
            <!-- website link -->
            <li>
                <a href="" target="_blank" class="header-menu-icon" data-toggle="tooltip" data-placement="bottom"
                   data-original-title="Visit Home Page">
                    <i class="fas fa-globe"></i>
                </a>
            </li>
            <!-- message alert box -->
            <li>
                <a href="#" class="dropdown-toggle header-menu-icon" data-toggle="dropdown">
                    <i class="far fa-bell"></i>
                </a>
                <div class="dropdown-menu header-menubox qmsg-box-mw">
                    <div class="notification-title">
                        <i class="far fa-bell"></i> Message
                    </div>
                    <div class="content">
                        <ul>
                            <li class="text-center">You do not have any new messages</li>
                        </ul>
                    </div>
                    <div class="notification-footer">
                        <div class="text-right">
                            <a href="communication/mailbox/inbox" class="view-more">All Messages</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <!-- user profile box -->
        <span class="separator"></span>
        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="{{asset('uploads/app_image/defualt.png')}}" alt="user-image" class="img-circle"
                         height="35">
                </figure>
            </a>
            <div class="dropdown-menu">
                <ul class="dropdown-user list-unstyled">
                    <li class="user-p-box">
                        <div class="dw-user-box">
                            <div class="u-img">
                                <img src="{{asset('uploads/app_image/defualt.png')}}" alt="user">
                            </div>
                            <div class="u-text">
                                <h4>{!! Auth::user()->name !!}</h4>
                                <p class="text-muted">{!! Auth::user()->name !!}</p>

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                   class="btn btn-danger btn-xs">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="profile/password"><i class="fas fa-mars-stroke-h"></i> Reset Password</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
