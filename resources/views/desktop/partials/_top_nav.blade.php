<div class="navbar-collapse collapse">
    <ul class="navbar-nav  navbar-right">
        @if (!Auth::guest())
            <li>
                <a href="#" data-toggle="dropdown"> <i class="material-icons">&#xE3C7;</i>
                </a>
                <ul class="dropdown-menu pmu-caret">
                    <li class="active"><a href="/admin/user/{{Auth::user()->id}}/edit"><span>my profile</span></a></li>
                    <li><a href="/admin/dashboard"><span>dashboard</span></a></li>
                    <li><a href="{{ url('/admin/logout') }}"
                           onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                            <span>Logout</span> </a>

                        <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST"
                              style="display: none;">{{ csrf_field() }}</form>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</div>
