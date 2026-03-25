<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Grafco</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->


                 {{-- Content Management Section --}}
                <li class="nav-header">{{ __('messages.content_management') }}</li>

                @if ($user->can('banner-table') || $user->can('banner-add') || $user->can('banner-edit') || $user->can('banner-delete'))
                    <li class="nav-item">
                        <a href="{{ route('banners.index') }}" class="nav-link">
                            <i class="fas fa-images nav-icon"></i>
                            <p> {{ __('messages.Banners') }} </p>
                        </a>
                    </li>
                @endif

                @if ($user->can('about-index') || $user->can('about-create') || $user->can('about-edit') || $user->can('about-delete'))
                    <li class="nav-item">
                        <a href="{{ route('abouts.index') }}" class="nav-link">
                            <i class="fas fa-info-circle nav-icon"></i>
                            <p> {{ __('messages.About') }} </p>
                        </a>
                    </li>
                @endif

                @if ($user->can('category-index') || $user->can('category-create') || $user->can('category-edit') || $user->can('category-delete'))
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="fas fa-cogs nav-icon"></i>
                            <p> {{ __('messages.categories') }} </p>
                        </a>
                    </li>
                @endif

                @if ($user->can('product-index') || $user->can('product-create') || $user->can('product-edit') || $user->can('product-delete'))
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">
                            <i class="fas fa-tags nav-icon"></i>
                            <p> {{ __('messages.products') }} </p>
                        </a>
                    </li>
                @endif
              
                @if ($user->can('product-index') || $user->can('product-create') || $user->can('product-edit') || $user->can('product-delete'))
                    <li class="nav-item">
                        <a href="{{ route('product_options.index') }}" class="nav-link">
                            <i class="fas fa-tags nav-icon"></i>
                            <p> {{ __('messages.product_options') }} </p>
                        </a>
                    </li>
                @endif

                  <li class="nav-item">
                    <a href="{{ route('videos.index') }}" class="nav-link">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>{{ __('messages.videos') }} </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{ route('pages.index') }}" class="nav-link">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p> {{ __('messages.pages_management') }} </p>
                    </a>
                </li>


                {{-- System Configuration --}}
                <li class="nav-header">{{ __('messages.system_configuration') }}</li>

                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>{{ __('messages.Settings') }} </p>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a href="{{ route('working-hours.index') }}" class="nav-link">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>{{ __('messages.Working-hours') }} </p>
                    </a>
                </li>



                {{-- User Management --}}
                <li class="nav-header">{{ __('messages.user_management') }}</li>

                <li class="nav-item">
                    <a href="{{ route('admin.login.edit', auth()->user()->id) }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p>{{ __('messages.Admin_account') }} </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.role.index') }}" class="nav-link">
                        <i class="fas fa-shield-alt nav-icon"></i>
                        <p>{{ __('messages.roles') }} </p>
                    </a>
                </li>


                @if (
                    $user->can('employee-table') ||
                        $user->can('employee-add') ||
                        $user->can('employee-edit') ||
                        $user->can('employee-delete'))
                    <li class="nav-item">
                        <a href="{{ route('admin.employee.index') }}"
                            class="nav-link {{ request()->routeIs('admin.employee.*') ? 'active' : '' }}">
                            <i class="far fa-id-badge nav-icon"></i>
                            <p>{{ __('messages.Employee') }}</p>
                        </a>
                    </li>
                @endif


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
