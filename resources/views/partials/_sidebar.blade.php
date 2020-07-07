
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li>
                        <br><br><img src="{{ asset('images/myAvatar.png') }}" style="border-radius: 30px;" width="50px" height="50px" alt="avatar" />
                        <b>{{ \Illuminate\Support\Facades\Auth::user()->name }}</b>
                        <br><br>
                    </li>

                    <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
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

                    <li class="{{ (request()->is('transactions')) ? 'active' : '' }}">
                        <a href="{{ route('transactions') }}">
                            <i class="fas fa-clipboard-list"></i>
                            Transactions
                        </a>
                    </li>

                    <br><br><br><br>

                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="zmdi zmdi-power"></i>
                            Logout
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->
