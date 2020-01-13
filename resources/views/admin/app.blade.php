    @include('admin.partials.header')

    <div id="app" >

        @include('admin.partials.head-section')
        @include('admin.partials.sidebar')
        <main class="app-content">
            <!-- @yield('content') -->
            {{-- <router-view></router-view>  --}}
            <div class="row">
                <div class="col-6">
                    <example-component></example-component>
                    
                </div>
                <div class="col-6">
                    <product-component />
                </div>
            </div>
            
            
        </main>
    </div>
    @include('admin.partials.footer')
    
    
