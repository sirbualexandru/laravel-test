<header id="header">
	<div id="logo-group">

		<!-- PLACE YOUR LOGO HERE -->
		<span id="logo" >
            <a href="/">
                <img src="/img/logo.png" alt="logo" style="width:140px;"/>
            </a>
        </span>
		<!-- END LOGO PLACEHOLDER -->

		<!-- Note: The activity badge color changes when clicked and resets the number to 0
			 Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->

		<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
	
		<!-- END AJAX-DROPDOWN -->
	</div>

	<!-- #PROJECTS: projects dropdown -->

	<!-- end projects dropdown -->

	<!-- #TOGGLE LAYOUT BUTTONS -->
	<!-- pulled right: nav area -->
	<div class="pull-right">

		<!-- collapse menu button -->
		<div id="hide-menu" class="btn-header pull-right">
			<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
		</div>
		<!-- end collapse menu -->

		<!-- #MOBILE -->
		<!-- Top menu profile link : this shows only when top menu is active -->
		<ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
			<li class="">
				<a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
					<img src="img/avatars/sunny.png" alt="John Doe" class="online" />  
				</a>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="#ajax/profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="login.html" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
					</li>
				</ul>
			</li>
		</ul>

		
		<!-- logout button -->
		<div id="logouta" class="btn-header transparent pull-right">
			<span> <a  href="{{ url('/logout') }}" title="Sign Out" data-action="userLogout" data-logout-msg="{{ trans('lang.confirm_logout') }}"><i class="fa fa-sign-out"></i></a> </span>
			<form id="logout-form" action="{{ url('/logout') }}" method="get" style="display:none;">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
		<!-- end logout button -->

		<!-- fullscreen button -->
		<div id="fullscreen" class="btn-header transparent pull-right">
			<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
		</div>
		<!-- end fullscreen button -->

	</div>
	<!-- end pulled right: nav area -->

</header>