<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{ route('admin/home') }}"><img class="sidebar-brand-full" width="118" height="46"
                src="{{ asset('template/logo.png') }}" alt="CoreUI Logo" /></a>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">

        <li class="nav-title">{{ __('homePage.components') }}</li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
                </svg> {{ __('homePage.mainList') }}</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{route('transTypes.index')}}"><span class="nav-icon"></span>
                        {{ __('transaction.trans_type') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('transStatus.index')}}"><span class="nav-icon"></span>
                        {{ __('transaction.trans_status') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('secrets.index')}}"><span class="nav-icon"></span>
                        {{ __('transaction.secret_degree') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('importances.index')}}"><span class="nav-icon"></span>
                        {{ __('transaction.importance_degree') }}</a></li>

            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                </svg> {{ __('homePage.users_roles') }}</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}"><span class="nav-icon"></span>
                        {{ __('homePage.users') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('roles.index')}}"><span class="nav-icon"></span>
                        {{ __('homePage.roles') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('department.index')}}"><span class="nav-icon"></span>
                            {{ __('homePage.departments') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('operation.index')}}"><span class="nav-icon"></span>
                            {{ __('homePage.operations') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span>
                        {{ __('homePage.privileges') }}</a></li>
                    
            </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                </svg> {{ __('homePage.charts') }}</a></li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
