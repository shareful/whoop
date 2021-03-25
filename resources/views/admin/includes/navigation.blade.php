<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <div class="navbar-header pull-left">
                <p class="logoname">
                    <a href="{{ url('admin') }}" class="navbar-brand">
                        Whoop! ME
                    </a>
                </p>
            </div>
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a data-toggle="dropdown" class="login-area dropdown-toggle" aria-expanded="false">
                                <section> 
                                    <h2><span class="profile"><span>Welcome {{Auth::user()->firstname.' '.Auth::user()->lastname}}</span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <!--/Theme Selector Area-->
                                <li class="dropdown-footer">
                                    <a href="{{ url('admin/logout') }}">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                            <!--/Login Area Dropdown-->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>