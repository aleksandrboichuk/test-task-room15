<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        @if($verified)
        <li class="sidebar-brand">
            <a href="/home">
                Admin Panel
            </a>
        </li>
        <li>
            <a href="/products">Products</a>
        </li>
        @endif
        <li class="mt-3">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-info">Logout</button>
            </form>
        </li>
    </ul>
</div>
