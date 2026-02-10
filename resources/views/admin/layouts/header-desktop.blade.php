<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
       
                <div class="header-button">
                    <!-- User Account Dropdown -->
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="{{ Auth::user()->name ?? 'John Doe' }}" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ Auth::user()->name ?? 'john doe' }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="{{ route('admin.profile.edit') }}">
                                            <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="{{ Auth::user()->name ?? 'John Doe' }}" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="{{ route('admin.profile.edit') }}">{{ Auth::user()->name ?? 'john doe' }}</a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->email ?? 'johndoe@example.com' }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ route('admin.profile.edit') }}">
                                            <i class="zmdi zmdi-account"></i>Account
                                        </a>
                                    </div>

                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="zmdi zmdi-power"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    .header-wrap {
   justify-content: right !important;
}
</style>
<!-- END HEADER DESKTOP-->