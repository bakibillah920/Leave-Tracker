<aside id="sidebar-left" class="sidebar-left">
        <div class="sidebar-header">
            <div class="sidebar-title">
                Main
            </div>
        </div>
        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">
                    <ul class="nav nav-main">
                        <!-- dashboard -->
                        <li class="">
                            <a href="javascript:void(0)" onclick="changeURL('/dashboard')">
                            <i class="icons icon-grid"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0)" onclick="changeURL('/users')">
                            <i class="icons icon-directions"></i><span>Users</span>
                            </a>
                        </li>
                        <!-- human resource -->
                        <li class="nav-parent {{ Helper::liActive(['payroll','advance_salary','leave','award']) }}">
                            <a>
                                <i class="icons icon-loop"></i><span>Human Resource</span>
                            </a>
                            <ul class="nav nav-children">
                                <!-- leave managements -->
                                <li class="nav-parent {{ Helper::liActive(['leave']) }}">
                                    <a>
                                        <i class="fas fa-umbrella-beach" aria-hidden="true"></i>
                                        <span>Leave</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li class="{{ Helper::setActive('leave/category') }}">
                                            <a  href="javascript:void(0)" onclick="changeURL('/leave/category')">
                                            <span>Category</span>
                                            </a>
                                        </li>
                                        <li class="{{ Helper::setActive('leave/request') }}">
                                            <a  href="javascript:void(0)" onclick="changeURL('/leave/request')">
                                            <span>My Application</span>
                                            </a>
                                        </li>
                                        @if(Auth::user()->role !=3 )
                                        <li class="{{ Helper::setActive('leave/manage') }}">
                                        <a  href="javascript:void(0)" onclick="changeURL('/leave/manage')">
                                            <span>Manage Application</span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </aside>
    <script type="text/javascript">

        const expandableItems = document.querySelectorAll('li.nav-parent');

        expandableItems.forEach((item) => {
          item.addEventListener('click', (event) => {
            // item.classList.toggle('nav-expanded');
            const subMenu = item.querySelector('ul.nav-children');
            if (subMenu) {
                event.stopPropagation();
                item.classList.toggle('nav-expanded');
                subMenu.classList.toggle('nav-expanded');
            }else{
                event.stopPropagation();
                item.classList.toggle('nav-expanded');
            }
          });
        });

    </script>
