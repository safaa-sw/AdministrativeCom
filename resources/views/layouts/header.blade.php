<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3 " type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
            </svg>
          </button>
        <ul class="header-nav ms-3">
            <li class="nav-item nav-link"><a class="dropdown-item" href="{{ url('locale/en') }}">En </a></li>
            <li class="nav-item nav-link"><a class="dropdown-item" href="{{ url('locale/ar') }}">Ar</a></li>
        </ul>

        <ul class="header-nav ms-auto">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#"
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <h5>{{Auth::user()->name}}</h5> &nbsp;
                        <img class="avatar-img" @if (Auth::user()->profile!=null)
                        src="{{URL::asset(Auth::user()->profile->image)}}" 
                        @else
                        src="#" 
                        @endif
                       
                        alt="user@email.com">
                        
                    </div>
                    <div>
                        
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                        </svg> {{__('homePage.notification')}}</a>
                    </a>
                    <a class="dropdown-item" href="{{route('profile',[Auth::user()->id])}}">
                        <svg class="icon me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                        </svg> {{__('homePage.profile')}}</a>
                    </a>

                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"
                        onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                        <svg class="icon me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                        </svg> {{__('homePage.logout')}}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="header-divider"></div>

</header>
