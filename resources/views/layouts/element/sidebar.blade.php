

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-2" href="javascript:;">
        <img width="60" style="max-height: 60px;" src="{{asset('assets/img/cafe6.png')}}" class="navbar-brand-img">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{asset('assets/argon/img/theme/team-1-800x800.jpg')}}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#!" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="{{asset('assets/argon/img/brand/blue.png')}}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a id="dashboard-id" class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fa fa-tachometer-alt text-default"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a id="category-id" class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fa fa-list-alt text-default"></i>
                    Category
                </a>
            </li>

            <li class="nav-item">
                <a id="category-id" class="nav-link" href="{{ route('units.index') }}">
                    <i class="fa fa-list-alt text-default"></i>
                    Unit
                </a>
            </li>

            <li class="nav-item">
                <a id="category-id" class="nav-link" href="{{ route('products.index') }}">
                    <i class="fa fa-list-alt text-default"></i>
                    Product
                </a>
            </li>

        </ul>

      </div>
    </div>
</nav>

@section('scripts')

    <script>
        $(document).ready(function(){

            var url = window.location.href;
            var urls = url.split('localhost/warungDonto/public/');
            //console.log(urls[1]);
            var param = urls[1].split('edit');
            var p = param[0].split('admin');
            var asli = p[1].split('/');
            //console.log(asli);

            if( urls[1] == 'admin/products' || urls[1] == 'admin/products/' || urls[1] == 'admin/products/create' || urls[1] == 'admin/products/'+asli[2]+'/edit' ){
                $('.nav-item a').removeClass('test');
                $('#product-id i').removeClass('text-default');
                $('#product-id').addClass('test');
            }else if( urls[1] == 'admin/categories' || urls[1] == 'admin/categories/' || urls[1] == 'admin/categories/create' || urls[1] == 'admin/categories/'+asli[2]+'/edit' ){
                $('.nav-item a').removeClass('test');
                $('#category-id i').removeClass('text-default');
                $('#category-id').addClass('test');
            }else if( urls[1] == 'admin/accounts' || urls[1] == 'admin/accounts/' || urls[1] == 'admin/accounts/create' || urls[1] == 'admin/accounts/'+asli[2]+'/edit' ){
                $('.nav-item a').removeClass('test');
                $('#account-id i').removeClass('text-default');
                $('#account-id').addClass('test');
            }else if( urls[1] == 'admin/roles' || urls[1] == 'admin/roles/' || urls[1] == 'admin/roles/create' || urls[1] == 'admin/roles/'+asli[2]+'/edit' ){
                $('.nav-item a').removeClass('test');
                $('#role-id i').removeClass('text-default');
                $('#role-id').addClass('test');
            }else{
                $('.nav-item a').removeClass('test');
                $('#dashboard-id i').removeClass('text-default');
                $('#dashboard-id').addClass('test');
            }

        })
    </script>

@endsection
