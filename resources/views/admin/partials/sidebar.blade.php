<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard.index' ? 'active' : '' }}"
                     href="{{ route('admin.dashboard.index') }}">
                <span class="app-menu__icon"><ion-icon  name="ios-apps"></ion-icon></span>
                <span class="app-menu__label">&nbsp;System Statistics</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.invoices.index' ? 'active' : '' }}"
                                    href="{{route('admin.invoices.index')}}">

                <span class="app-menu__icon">
                    <i class="fa fa-file-text-o"></i>
                </span>
                <span class="app-menu__label">&nbsp; Invoice</span>
            </a>
        </li>
        
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.customers.index' ? 'active' : '' }}"
                href="{{ route('admin.customers.index') }}">

                <span class="app-menu__icon"><ion-icon name="people"></ion-icon></span>
                <span class="app-menu__label"> Customers</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.distributors.index' ? 'active' : '' }}" href="{{ route('admin.distributors.index') }}">
                <span class="app-menu__icon"><i class="fa fa-building"></i></span>
                <span class="app-menu__label">Distributors</span>
                
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.brands.index' ? 'active' : '' }}" href="{{ route('admin.brands.index') }}">
                <span class="app-menu__icon"><i class="fa fa-certificate"></i></span>
                <span class="app-menu__label">Brand</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <span class="app-menu__icon"><ion-icon name="document"></ion-icon></span>
                <span class="app-menu__label">Categories</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <span class="app-menu__icon"><i class="fa fa-check-square-o"></i></span>
                <span class="app-menu__label">&nbsp; Products</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.stocks.index' ? 'active' : '' }}" href="{{ route('admin.stocks.index') }}">
                <span class="app-menu__icon"><i class="fa fa-line-chart"></i></span>
                <span class="app-menu__label">&nbsp; Stocks</span>
            </a>
        </li>
        <li>
            <router-link to="#" class="app-menu__item" >
                {{-- <i class="app-menu__icon fa fa-user"></i> --}}
                <span class="app-menu__icon"><ion-icon name="analytics"> </ion-icon></span>
                <span class="app-menu__label"><span>&nbsp;<span> Analytics</span>
            </router-link>
        </li>
        
        
         
        <li>
            <a class="app-menu__item mt-5{{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>

    </ul>
</aside>
