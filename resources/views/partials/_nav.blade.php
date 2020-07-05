<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu" style="margin-left: 750px">
                            <div class="image">
                                <img src="{{ asset('images/myAvatar.png') }}" alt="avatar" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn">
                                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                </a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="account-dropdown__footer">
                                    <a href="{{ route('logout') }}">
                                        <i class="zmdi zmdi-power"></i>Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->
