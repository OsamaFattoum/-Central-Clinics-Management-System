<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
	<div class="main-sidebar-header active">
		<a class="desktop-logo logo-light  active" href="{{ route('dashboard') }}"><img
				src="{{URL::asset('assets/img/brand/logo_' . config('app.locale') . '.png')}}" class="main-logo"
				alt="logo"></a>
		<a class="logo-icon mobile-logo icon-light active" href="{{ route('dashboard') }}"><img
				src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
	</div>
	<div class="main-sidemenu">
		<div class="app-sidebar__user clearfix">
			<div class="dropdown user-pro-body">
				<div class="">
					<img alt="user-img" class="avatar avatar-xl brround"
						src="{{URL::asset(auth()->user()->image_path)}}"><span
						class="avatar-status profile-status bg-green"></span>
				</div>
				<div class="user-info">
					<h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
					<span class="mb-0 text-muted">{{ Auth::user()->email }}</span>
				</div>
			</div>
		</div>
		<ul class="side-menu">
			<li class="side-item side-item-category">@lang('sidebar.main_t')</li>
			<li class="slide">
				<a class="side-menu__item" href="{{ route('dashboard') }}"><svg xmlns="http://www.w3.org/2000/svg"
						class="side-menu__icon" viewBox="0 0 24 24">
						<path d="M0 0h24v24H0V0z" fill="none" />
						<path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
						<path
							d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
					</svg><span class="side-menu__label">@lang('sidebar.main_l')</span></a>
			</li>
			<li class="side-item side-item-category">@lang('sidebar.system_t')</li>
			@permission('read-departments')
				<li class="slide {{ Request::is('departments/*') ? 'is-expanded' : ''}}">
					<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg
							xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none" />
							<path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
							<path
								d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
						</svg><span class="side-menu__label">@lang('sidebar.departments_t')</span><i
							class="angle fe fe-chevron-down"></i></a>
					<ul class="slide-menu">
						<li><a class="slide-item" href="{{ route('departments.index') }}">@lang('sidebar.all')</a></li>
					</ul>
				</li>
			@endpermission
			@permission('read-clinics')
				<li class="slide {{ Request::is('clinics/*') ? 'is-expanded' : ''}}">
					<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg
							xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none" />
							<path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
							<path
								d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
						</svg><span class="side-menu__label">@lang('sidebar.clinics_t')</span><i
							class="angle fe fe-chevron-down"></i></a>
					<ul class="slide-menu">
						<li><a class="slide-item" href="{{ route('clinics.index') }}">@lang('sidebar.all')</a></li>
						<li><a class="slide-item" href="{{ route('clinics.create') }}">@lang('sidebar.clinics_add_t')</a>
						</li>
					</ul>
				</li>
			@endpermission
			@permission('read-pharmacies')
				<li class="slide {{ Request::is('pharmacies/*') ? 'is-expanded' : ''}}">
					<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg
							xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none" />
							<path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
							<path
								d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
						</svg><span class="side-menu__label">@lang('sidebar.pharmacies_t')</span><i
							class="angle fe fe-chevron-down"></i></a>
					<ul class="slide-menu">
						<li><a class="slide-item" href="{{ route('pharmacies.index') }}">@lang('sidebar.all')</a></li>
						<li><a class="slide-item"
								href="{{ route('pharmacies.create') }}">@lang('sidebar.pharmacies_add_t')</a></li>
					</ul>
				</li>
			@endpermission
			@permission('read-doctors')
				<li class="slide {{ Request::is('doctors/*') ? 'is-expanded' : ''}}">
					<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg
							xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none" />
							<path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
							<path
								d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
						</svg><span class="side-menu__label">@lang('sidebar.doctors_t')</span><i
							class="angle fe fe-chevron-down"></i></a>
					<ul class="slide-menu">
						<li><a class="slide-item" href="{{ route('doctors.index') }}">@lang('sidebar.all')</a></li>
						<li><a class="slide-item" href="{{ route('doctors.manage') }}">@lang('sidebar.doctors_add_t')</a>
						</li>
					</ul>
				</li>
			@endpermission
			
		</ul>
	</div>
</aside>
<!-- main-sidebar -->