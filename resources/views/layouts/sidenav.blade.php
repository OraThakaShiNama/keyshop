<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <div class="sidenav-menu-heading">DASHBOARDS</div>
            <a class="nav-link" href="{{ route('users.index') }}">
                <div class="nav-link-icon"><i class="icon-users" data-feather="users"></i></div>
                Users
            </a>
            <a class="nav-link" href="{{ route('categories.index') }}">
                <div class="nav-link-icon"><i class="fa fa-list" aria-hidden="true"></i></div>
                List Categories
            </a>
            <a class="nav-link" href="{{ route('books.index') }}">
                <div class="nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                Books Categories
            </a>
            <a class="nav-link" href="{{ route('orders.index') }}">
                <div class="nav-link-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                Order Books
            </a>
        </div>
    </div>
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>