<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('') }}">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">WIP</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Projects -->
	<li class="nav-item">
		<a class="nav-link" href="{{ url('') }}">
			<i class="fas fa-fw fa-table"></i>
			<span>Projects</span>
		</a>
	</li>

	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link" href="index.html">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<div class="sidebar-card d-none d-lg-flex">
		<a href="{{url('/project/advertise')}}" class="btn btn-success">
			<span class="text">Advertise Project</span>
		</a>
	</div>
</ul>