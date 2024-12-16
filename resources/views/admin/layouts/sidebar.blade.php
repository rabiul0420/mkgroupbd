<div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto"><a target="_blank" class="navbar-brand" href="{{ route('home') }}"><span
                    class="brand-logo">
                    <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                        <defs>
                            <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                <stop stop-color="#000000" offset="0%"></stop>
                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                            </lineargradient>
                            <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                y2="100%">
                                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                            </lineargradient>
                        </defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                <g id="Group" transform="translate(400.000000, 178.000000)">
                                    <path class="text-primary" id="Path"
                                        d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                        style="fill:currentColor"></path>
                                    <path id="Path1"
                                        d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                        fill="url(#linearGradient-1)" opacity="0.2"></path>
                                    <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                        points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                    </polygon>
                                    <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                        points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                    </polygon>
                                    <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                        points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                </g>
                            </g>
                        </g>
                    </svg></span>
                <h2 class="brand-text">MKGROUP</h2>
            </a></li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                    class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                    class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                    data-ticon="disc"></i></a></li>
    </ul>
</div>
<div class="shadow-bottom"></div>
<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        @if(menuPermission('Dashboard'))
        <li class="nav-item">
            @if(routePermission('admin.dashboard'))
                <a class="d-flex align-items-center single-menu" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                </a>
            @endif
        </li>
        @endif

        @if(menuPermission('To-Do'))
        <li class="nav-item">
            @if(routePermission('admin.to-do-list.index'))
                <a class="d-flex align-items-center single-menu" href="{{ route('admin.to-do-list.index') }}">
                    <i data-feather="check-square"></i>
                    <span class="menu-title text-truncate" data-i18n="Todo">Todo</span>
                </a>
            @endif
        </li>
        @endif

        @if(menuPermission('Assets'))
        <li class="nav-item">
            @if(routePermission('admin.asset-list'))
                <a class="d-flex align-items-center single-menu" href="{{ route('admin.asset-list') }}">
                    <i data-feather="pocket"></i>
                    <span class="menu-title text-truncate" data-i18n="Assets">Assets</span>
                </a>
            @endif
        </li>
        @endif

        @if(menuPermission('Work Orders'))
        <li class="nav-item">
            @if(routePermission('admin.work-orders.index'))
            <a class="d-flex align-items-center single-menu" href="{{ route('admin.work-orders.index') }}">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate" data-i18n="Work Orders">Work Orders</span>
            </a>
            @endif
        </li>
        @endif

        @if(menuPermission('Products'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="shopping-bag"></i>
                <span class="menu-title text-truncate">Products</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.products.create'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.products.create') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Add Product</span>
                    </a>
                </li>
                @endif 
                @if(routePermission('admin.products.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.products.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Product List</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(menuPermission('Invoice'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="file-plus"></i>
                <span class="menu-title text-truncate">Invoice</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.invoices.create'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.invoices.create') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Add Invoice</span>
                    </a>
                </li>
                @endif 
                @if(routePermission('admin.invoices.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.invoices.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Invoice List</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Reports'))
        <li class="nav-item">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="bar-chart"></i>
                <span class="menu-title text-truncate">Reports</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.expense-reports'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.expense-reports') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Expense Report</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.income-reports'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.income-reports') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Income Report</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.profit-reports'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.profit-reports') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Profit Report</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Task and Calendar'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="calendar"></i>
                <span class="menu-title text-truncate">Task</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.task-list.create'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.task-list.create') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Add New Task</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.task-list.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.task-list.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Task List</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.task-calendar'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.task-calendar') }}">
                        <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">
                        <span>Task Calendar</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Employees'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Employees</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.employees.create'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.employees.create') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Add Employee</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.employees.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.employees.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Employee List</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.employee-designations.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.employee-designations.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Designation List</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        
        @if(menuPermission('Clients'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="user-plus"></i>
                <span class="menu-title text-truncate">Clients</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.clients.create'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.clients.create') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Add Client</span>
                    </a>
                </li>
                @endif 
                @if(routePermission('admin.clients.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.clients.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Client List</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Sister Concerns'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="book-open"></i>
                <span class="menu-title text-truncate">Sister Concerns</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.sister-concerns.create'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.sister-concerns.create') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Add Sister Concern</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.sister-concerns.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.sister-concerns.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Sister Concern List</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Our Services'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather='check-square'></i>
                <span class="menu-title text-truncate">Our Services</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.our-services.create'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.our-services.create') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Add Service</span>
                    </a>
                </li>
                @endif 
                @if(routePermission('admin.our-services.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.our-services.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Service List</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Expense'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather='minus'></i>
                <span class="menu-title text-truncate">Expense</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.expense-list.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.expense-list.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Expense List</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.expense-categories.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.expense-categories.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Expense Categoreis</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Income'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather='dollar-sign'></i>
                <span class="menu-title text-truncate">Income</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.incomes.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.incomes.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Income List</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.income-sectors.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.income-sectors.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Income Sectors</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Events'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather='sunset'></i>
                <span class="menu-title text-truncate">Events</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.events.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.events.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Event List</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.event-categories.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.event-categories.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Event Categories</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(menuPermission('Settings'))
        <li class="nav-item parent-menu">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="settings"></i>
                <span class="menu-title text-truncate">Settings</span>
            </a>
            <ul class="menu-content">
                @if(routePermission('admin.website-settings'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.website-settings') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Website Settings</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.faqs.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.faqs.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">FAQ</span>
                    </a>
                </li>
                @endif
                @if(routePermission('admin.payment-methods.index'))
                <li>
                    <a class="d-flex align-items-center child-menu" href="{{ route('admin.payment-methods.index') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Payment Methods</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
    </ul>
</div>