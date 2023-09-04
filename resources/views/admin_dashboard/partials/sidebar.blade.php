<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin_dashboard.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin_dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Categories -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Categories"
            aria-expanded="true" aria-controls="Categories">
            <i class="fas fa-snowflake"></i>
            <span>Categories</span>
        </a>
        <div id="Categories" class="collapse" aria-labelledby="Categories" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{route('admin_dashboard.category.index')}}">All Categories</a>
                <a class="collapse-item" href="{{route('admin_dashboard.category.create')}}">Add Category</a>
            </div>
        </div>
    </li>

      <!-- Products -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Products"
            aria-expanded="true" aria-controls="Products">
            <i class="fas fa-briefcase"></i>
            <span>Products</span>
        </a>
        <div id="Products" class="collapse" aria-labelledby="Products" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{route('admin_dashboard.product.index')}}">All Products</a>
                <a class="collapse-item" href="{{route('admin_dashboard.product.create')}}">Add Product</a>
            </div>
        </div>
    </li>


          <!-- Settings -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Settings"
                aria-expanded="true" aria-controls="Settings">
                <i class="fas fa-fw fa-cog"></i>
                <span>Settings</span>
            </a>
            <div id="Settings" class="collapse" aria-labelledby="Settings" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="">Settings</a>
                    <a class="collapse-item" href="">Admin Settings</a>
                </div>
            </div>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
