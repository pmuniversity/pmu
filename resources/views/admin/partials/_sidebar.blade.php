<!-- Main sidebar -->
<div class="sidebar sidebar-main">
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user">
			<div class="category-content">
				<div class="media">
					<a href="#" class="media-left"><img
						src="/assets/admin/images/demo/users/face11.jpg"
						class="img-circle img-sm" alt=""></a>
					<div class="media-body">
						<span class="media-heading text-semibold">{{
							Auth::user()->full_name }}</span>
						<div class="text-size-mini text-muted">
							<i class="icon-pin text-size-small"></i> &nbsp;{{
							Auth::user()->location }}
						</div>
					</div>

					<div class="media-right media-middle">
						<ul class="icons-list">
							<li><a href="#"><i class="icon-cog3"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main -->
					<li class="navigation-header"><span>Main</span> <i
						class="icon-menu" title="Main pages"></i></li>
					<li><a href="/admin"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
					<li><a href="/admin/users"><i class="icon-home4"></i> <span>Users</span></a></li>
					<li><a href="#"><i class="icon-people"></i> <span>Product Types</span></a>
						<ul>
							<li><a href="/admin/topics/level/bachelores-degree">Bachelore</a></li>
							<li><a href="/admin/topics/level/masters-degree">Master</a></li>
							<li><a href="/admin/topics/level/specialization">Specialization</a></li>
						</ul></li>
					<li><a href="#"><i class="icon-people"></i> <span>Topics</span></a>
						<ul>
							<li><a href="/admin/topics">List Topics</a></li>
							<li><a href="/admin/topics/create">Add a Topic</a></li>
						</ul></li>

					<!-- /main -->
				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>
<!-- /main sidebar -->