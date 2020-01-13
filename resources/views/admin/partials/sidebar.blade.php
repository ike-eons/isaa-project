<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        
        <li>
            <a class="app-menu__item" href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">System Statistics</span>
            </a>
        </li>
        <li>
            <router-link to="/customers" class="app-menu__item" >
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Customers</span>
            </router-link>
        </li>
        <li>
            <router-link to="/products" class="app-menu__item" >
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Products</span>
            </router-link>
        </li>
        <li>
            <router-link to="#" class="app-menu__item" >
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Stocks</span>
            </router-link>
        </li>
        <li>
            <router-link to="#" class="app-menu__item" >
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Analytics</span>
            </router-link>
        </li>
        
        
         
        <li>
            <a class="app-menu__item mt-5 pt-5{{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>

    </ul>
</aside>
