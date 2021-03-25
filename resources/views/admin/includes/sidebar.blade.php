<div class="page-sidebar" id="sidebar">
    <!-- Sidebar Menu -->
    <ul class="nav sidebar-menu">
        <li class="active">
            <a href="{{url('admin/dashboard')}}">
                <i class="menu-icon glyphicon glyphicon-home"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>
        <li>
            <a href="{{url('admin/user/list')}}">
                <i class="menu-icon glyphicon glyphicon-user"></i>
                <span class="menu-text"> Users </span>
            </a>
        </li>
        <li>
            <a href="{{url('admin/category/list')}}">
                <i class="menu-icon glyphicon glyphicon-asterisk"></i>
                <span class="menu-text"> Categories </span>
            </a>
        </li>
        <li>
            <a href="{{url('admin/deal/list')}}">
                <i class="menu-icon glyphicon glyphicon-briefcase"></i>
                <span class="menu-text"> Deals </span>
            </a>
        </li>
        <li>
            <a href="{{url('admin/service-provider/list')}}">
                <i class="menu-icon glyphicon glyphicon-user"></i>
                <span class="menu-text"> Service Providers </span>
            </a>
        </li>
    <!-- <li>
			<a href="{{url('admin/appointment/list')}}">
				<i class="menu-icon glyphicon glyphicon-calendar"></i>
				<span class="menu-text"> Appointments </span>
			</a>
		</li> -->
    <!-- <li>
			<a href="{{url('admin/service-provider/list')}}">
				<i class="menu-icon glyphicon glyphicon-pencil"></i>
				<span class="menu-text"> Quotes </span>
			</a>
		</li> -->
        <li>
            <a href="{{route('boost_code_providers.index')}}">
                <i class="menu-icon glyphicon glyphicon-road"></i>
                <span class="menu-text"> Boost Code Providers </span>
            </a>
        </li>
        <li>
            <a href="{{route('welcome_messages.index')}}">
                <i class="menu-icon glyphicon glyphicon-inbox"></i>
                <span class="menu-text"> Welcome Message </span>
            </a>
        </li>
        <li>
            <a href="{{route('global_messages.index')}}">
                <i class="menu-icon glyphicon glyphicon-inbox"></i>
                <span class="menu-text"> Global Messages </span>
            </a>
        </li>
        <li>
            <a href="{{route('wizard_messages.index')}}">
                <i class="menu-icon glyphicon glyphicon-inbox"></i>
                <span class="menu-text"> Wizard Message </span>
            </a>
        </li>
        <li>
            <a href="{{url('admin/quote-messages/list')}}">
                <i class="menu-icon glyphicon glyphicon-inbox"></i>
                <span class="menu-text"> Quote Message </span>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/logout') }}">
                <i class="menu-icon fa fa-sign-out"></i>
                <span class="menu-text">Logout</span>
            </a>
        </li>
    </ul>
    <!-- /Sidebar Menu -->
</div>