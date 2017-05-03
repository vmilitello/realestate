<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        لوحة تحكم الموقع {{getSettings()}}
        @yield('title')
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.6 -->
    {!! Html::style('/admin/bootstrap/css/bootstrap.css') !!}

    <!-- Sweet Alert -->
    {!! Html::style('/admin/dist/css/sweetalert2.min.css') !!}

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- jvectormap -->
    {!! Html::style('/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}

    <!-- Theme style -->
    {!! Html::style('/admin/dist/css/AdminLTE.min.css') !!}

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('/admin/dist/css/skins/_all-skins.min.css') !!}

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('header')
</head>
<body class="hold-transition skin-blue sidebar-mini" dir="rtl">

<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="{{url('/adminpanel')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">لوحة التحكم</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu pull-left">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li style="float: right" class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">{{count_messages()}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header" style="text-align: right">لديك  {{count_messages()}} رسائل جديدة</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <!-- start message -->
                                    @foreach(unread_message() as $unread_message => $message)
                                        <li>
                                            <a href="{{url('/adminpanel/contact/' . $message->id . '/edit')}}">
                                                <h4  style="text-align: left">
                                                    {{$message->contact_name}}
                                                    <small style="text-align: left"><i class="fa fa-clock-o"></i> {{$message->created_at}}</small>
                                                </h4>
                                                <p>{{$message->contact_message, 10}}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                    <!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li style="float: right" class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">{{count_inactive_buildings(0)}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" style="text-align: right">لديك {{count_inactive_buildings(0)}}  عقار غير مفعل</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        @foreach(App\Building::where('status', 0)->get() as $building)
                                        <li>
                                            <a href="{{url('adminpanel/change-status/' . $building->id . '/1')}}">
                                                <span class="pull-right">
                                                    {{$building->building_name}}
                                                </span>

                                                <i class="fa fa-check pull-left"></i>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{Auth::user()->name}}</span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        {{Auth::user()->name}}
                                        <small>{{Auth::user()->created_at}}</small>
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{url('adminpanel/users/' . Auth::user()->id . '/edit')}}" class="btn btn-default btn-flat">
    الملف الشخصي
                                        </a>
                                    </div>
                                    <div class="pull-left">
                                        <a href="{{route('logout')}}" class="btn btn-default btn-flat">تسجيل الخروج</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li style="float: right" >
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sideusersuser panel -->
            <div class="user-panel">
                <div class="text-center image" style="margin-bottom: 10px">
                    <img src="/admin/dist/img/user2-160x160.jpg" alt="User Image">
                </div>
                <div class="clearfix"></div>
                <div style="padding-bottom: 15px" class="info">
                    <p style="margin-top: -10px" class="text-center">{{Auth::user()->name}}</p>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="ابحث">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header text-center">القائمة الرئيسية</li>

                @include('admin.layouts.navigation')
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->

            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->


<!-- jQuery 2.2.3 -->
{!! Html::script('/admin/plugins/jQuery/jquery-2.2.3.min.js')!!}

<!-- Bootstrap 3.3.6 -->
{!! Html::script('/admin/bootstrap/js/bootstrap.min.js')!!}

<!-- FastClick -->
{!! Html::script('/admin/plugins/fastclick/fastclick.js')!!}

<!-- AdminLTE App -->
{!! Html::script('/admin/dist/js/app.min.js')!!}

<!-- Sparkline -->
{!! Html::script('/admin/plugins/sparkline/jquery.sparkline.min.js')!!}

<!-- jvectormap -->
{!! Html::script('/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')!!}
{!! Html::script('/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')!!}

<!-- SlimScroll 1.3.0 -->
{!! Html::script('/admin/plugins/slimScroll/jquery.slimscroll.min.js')!!}

<!-- ChartJS 1.0.1 -->
{!! Html::script('/admin/plugins/chartjs/Chart.min.js')!!}

<!-- AdminLTE for demo purposes -->
{!! Html::script('/admin/dist/js/demo.js')!!}

<!-- SweetAlert -->
{!! Html::script('/admin/dist/js/sweetalert2.min.js')!!}

@include('/admin/layouts/flashMessage')
@yield('footer')
</body>
</html>