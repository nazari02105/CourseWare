<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <h5 class="centered">@yield("name")</h5>
            <li class="mt">
                <a class="@yield("dashboard", "")" href="/student/dashboard">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sub-menu">
                <a class="@yield("course", "")" href="javascript:;">
                    <i class="fa fa-book"></i>
                    <span>Course</span>
                </a>
                <ul class="sub">
                    <li class="@yield("courses", "")"><a href="/student/courses">Student Courses</a></li>
                </ul>
            </li>
{{--            <li class="sub-menu">--}}
{{--                <a class="@yield("questions", "")" href="javascript:;">--}}
{{--                    <i class="fa fa-tasks"></i>--}}
{{--                    <span>Questions</span>--}}
{{--                </a>--}}
{{--                <ul class="sub">--}}
{{--                    <li class="@yield("designed", "")"><a href="/question/all">Designed</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="sub-menu">--}}
{{--                <a class="@yield("register", "")" href="javascript:;">--}}
{{--                    <i class="fa fa-desktop"></i>--}}
{{--                    <span>Register</span>--}}
{{--                </a>--}}
{{--                <ul class="sub">--}}
{{--                    <li class="@yield("pending", "")"><a href="/admin/pending">Pending</a></li>--}}
{{--                    <li class="@yield("user", "")"><a href="/admin/user">Users</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="sub-menu">--}}
{{--                <a class="@yield("course", "")" href="javascript:;">--}}
{{--                    <i class="fa fa-cogs"></i>--}}
{{--                    <span>Course</span>--}}
{{--                </a>--}}
{{--                <ul class="sub">--}}
{{--                    <li class="@yield("courseAll", "")"><a href="/course">All</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="sub-menu">--}}
{{--                <a href="javascript:;">--}}
{{--                    <i class="fa fa-th"></i>--}}
{{--                    <span>Data Tables</span>--}}
{{--                </a>--}}
{{--                <ul class="sub">--}}
{{--                    <li><a href="basic_table.html">Basic Table</a></li>--}}
{{--                    <li><a href="responsive_table.html">Responsive Table</a></li>--}}
{{--                    <li><a href="advanced_table.html">Advanced Table</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="inbox.html">--}}
{{--                    <i class="fa fa-envelope"></i>--}}
{{--                    <span>Mail </span>--}}
{{--                    <span class="label label-theme pull-right mail-info">2</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="sub-menu">--}}
{{--                <a href="javascript:;">--}}
{{--                    <i class=" fa fa-bar-chart-o"></i>--}}
{{--                    <span>Charts</span>--}}
{{--                </a>--}}
{{--                <ul class="sub">--}}
{{--                    <li><a href="morris.html">Morris</a></li>--}}
{{--                    <li><a href="chartjs.html">Chartjs</a></li>--}}
{{--                    <li><a href="flot_chart.html">Flot Charts</a></li>--}}
{{--                    <li><a href="xchart.html">xChart</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="sub-menu">--}}
{{--                <a href="javascript:;">--}}
{{--                    <i class="fa fa-comments-o"></i>--}}
{{--                    <span>Chat Room</span>--}}
{{--                </a>--}}
{{--                <ul class="sub">--}}
{{--                    <li><a href="lobby.html">Lobby</a></li>--}}
{{--                    <li><a href="chat_room.html"> Chat Room</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="google_maps.html">--}}
{{--                    <i class="fa fa-map-marker"></i>--}}
{{--                    <span>Google Maps </span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
