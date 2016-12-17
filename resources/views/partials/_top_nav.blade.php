@if (!Auth::guest())
<li><a href="#" data-toggle="dropdown"> <i class="material-icons">&#xE3C7;</i>
</a>
	<ul class="dropdown-menu pmu-caret">
		<li class="active"><a href="#"><span>my profile</span></a></li>
		<li><a href="#"><span>settings</span></a></li>
		<li><a href="{{ url('/logout') }}"
			onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
				Logout </a>

			<form id="logout-form" action="{{ url('/logout') }}" method="POST"
				style="display: none;">{{ csrf_field() }}</form></li>
	</ul></li>
@endif
