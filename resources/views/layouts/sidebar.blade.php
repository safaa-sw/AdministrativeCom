<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <a href="{{route('transaction')}}"><img class="sidebar-brand-full" width="118" height="46" src="{{ asset('template/logo.png') }}"
        alt="CoreUI Logo" /></a>
        
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">

        <li class="nav-title">{{ __('homePage.components') }}</li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
                </svg> {{ __('homePage.transaction_create') }}</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{route('inside/create')}}"><span class="nav-icon"></span>
                        {{ __('homePage.transaction_inside') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span>
                        {{ __('homePage.transaction_incoming') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span>
                        {{ __('homePage.transaction_outgoing') }}</a></li>

            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-envelope-closed') }}"></use>
            </svg> {{ __('homePage.user_transactions') }}</a>
        <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link" href="{{route('user/transactions/in')}}"><span class="nav-icon"></span>
                    {{ __('homePage.user_incoming_box') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('user/transactions/out')}}"><span class="nav-icon"></span>
                    {{ __('homePage.user_outgoing') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('user/transactions/processing')}}"><span class="nav-icon"></span>
                        {{ __('homePage.user_processing') }}</a></li>
        </ul>
    </li>
       
        <li class="nav-item"><a class="nav-link" href="{{route('transaction/tracked')}}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-search') }}"></use>
            </svg> {{ __('homePage.transaction_tracking') }}</a>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-address-book') }}"></use>
                </svg> {{ __('homePage.reports') }}</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span>
                        {{ __('homePage.reports') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span>
                        {{ __('homePage.reports') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span>
                        {{ __('homePage.reports') }}</a></li>
            </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-notes') }}"></use>
                </svg> {{ __('homePage.delivery_data') }}</a></li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
