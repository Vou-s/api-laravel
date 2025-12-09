
<li class="nav-item">
    <a href="{{ route('subCategories.index') }}" class="nav-link {{ Request::is('subCategories*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Sub Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('orders*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Orders</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('products.index') }}" class="nav-link {{ Request::is('products*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Products</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('midtrans.index') }}" class="nav-link {{ Request::is('midtrans*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Midtrans</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('auths.index') }}" class="nav-link {{ Request::is('auths*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Auths</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('payments.index') }}" class="nav-link {{ Request::is('payments*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Payments</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('orderItems.index') }}" class="nav-link {{ Request::is('orderItems*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Order  Items</p>
    </a>
</li>
