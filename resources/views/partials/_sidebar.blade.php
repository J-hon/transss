
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-credit-card"></i>
                            Wallet
                        </a>
                    </li>
                    <li class="{{ (request()->is('deposit')) ? 'active' : '' }}">
                        <a href="{{ route('deposit') }}">
                            <i class="fas fa-sign-in-alt"></i>
                            Deposit
                        </a>
                    </li>

                    <li class="{{ (request()->is('withdrawal')) ? 'active' : '' }}">
                        <a href="{{ route('withdrawal') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            Withdrawal
                        </a>
                    </li>

                    <li class="{{ (request()->is('transfer')) ? 'active' : '' }}">
                        <a href="{{ route('transfer') }}">
                            <i class="fas fa-exchange-alt"></i>
                            Transfer
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->
