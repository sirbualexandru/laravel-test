<aside id="left-panel">
	@if(Auth::user())
	<!-- User info -->
	<div class="login-info">
		<span> <!-- User image size is adjusted inside CSS, it should stay as is -->
			<a href="#" ajax_target="/profile/edit" id="show-shortcut" data-action="toggleShortcut" class="remote_modal">
				<img src="img/avatars/sunny.png" alt="me" class="online" />
                <span> {{ Auth::user()->first_name }} </span>
				<i class="fa fa-angle-down"></i>
			</a>
        </span>
    </div>
    @endif
    <nav>
        <ul>
            <li class="<?php echo(isset($active_menu) && $active_menu == 'jobs') ? 'active' : '' ?>">
                <a href="/jobs">
                    <i class="fa fa-lg fa-fw fa-list" aria-hidden="true"></i>
                    <span class="menu-item-parent">{{ trans('lang.job_list') }}</span>
                </a>
            </li>

            @role('employer')
            <li class="<?php echo(isset($active_menu) && $active_menu == 'categories') ? 'active' : '' ?>">
                <a href="/categories">
                    <i class="fa fa-lg fa-fw fa-folder-open" aria-hidden="true"></i>
                    <span class="menu-item-parent">{{ trans('lang.job') }} {{ trans('lang.categories') }}</span>
                </a>
            </li>

            <li class="<?php echo(isset($active_menu) && $active_menu == 'candidates') ? 'active' : '' ?>">
                <a href="/candidates">
                    <i class="fa fa-lg fa-fw fa-users" aria-hidden="true"></i>
                    <span class="menu-item-parent">{{ trans('lang.job') }} {{ trans('lang.candidates') }}</span>
                </a>
            </li>
            @endrole
        </ul>
    </nav>

	<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>