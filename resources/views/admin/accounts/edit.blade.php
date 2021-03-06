@extends('layouts.element.main')

@section('title', 'Categories - Edit')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }
    </style>
@endsection

@section('content')

<!-- Navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Dashboard</a>
    <!-- Form -->
    <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
      <div class="form-group mb-0">
        <div class="input-group input-group-alternative">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
          </div>
          <input class="form-control" placeholder="Search" type="text">
        </div>
      </div>
    </form>
    <!-- User -->
    <ul class="navbar-nav align-items-center d-none d-md-flex">
      <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
            <img alt="Image placeholder" src="{{asset('assets/argon/img/theme/team-3-800x800.jpg')}}">
            </span>
            <div class="media-body ml-2 d-none d-lg-block">
              <span class="mb-0 text-sm  font-weight-bold">Jessica Jones</span>
            </div>
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
  </div>
</nav>
<!-- End Navbar -->
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
          <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-bottom-1">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('adminAccount.index') }}">
                                    Categories
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto text-right">

                </div>
            </div>
        </div>
        <div class="card-body" style="background: #f7f8f9;">
            <form action="{{ route('adminAccount.update', $admin->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-6 p-2">
                    <div class="form-group">
                        <label class="form-control-label">
                            Name
                        </label>
                        <input type="text" name="name" value="{{ $admin->name }}" class="form-control form-control-alternative" placeholder="Name">
                    </div>
                </div>
                <div class="col-6 p-2">
                    <div class="form-group">
                        <label class="form-control-label">
                            Email
                        </label>
                        <input type="email" name="email" value="{{ $admin->email }}" class="form-control form-control-alternative" placeholder="Email">
                    </div>
                </div>
                <div class="col-6 p-2">
                    <div class="form-group">
                        <label class="form-control-label">
                            Password
                        </label>
                        <input type="password" name="password" class="form-control form-control-alternative" placeholder="Password">
                    </div>
                </div>
                <div class="col-6 p-2">
                    <div class="form-group">
                        <label class="form-control-label">
                            Ulangi Password
                        </label>
                        <input type="password" name="password_confirmation" class="form-control form-control-alternative" placeholder="Ulangin Password">
                    </div>
                </div>
                <div class="col-6 p-2">
                    <div class="form-group">
                        <label class="form-control-label">
                            Status
                        </label>
                        <select name="status" class="form-control form-control-alternative">
                            @if ($admin->status == 1)
                              <option value="1" selected>Accept</option>
                              <option value="0">Pending</option> 
                            @else
                                <option value="0" selected>Pending</option> 
                                <option value="1">Accept</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-6 p-2">
                    <div class="form-group">
                        <label class="form-control-label">
                            Hak Akses
                        </label>

                        <select name="role_id" class="form-control form-control-alternative">
                           @foreach ($roles as $r)
                                @php
                                    $cek = $r->id ==  $admin->roles->first()->pivot->role_id;
                                @endphp
                                <option value="{{ $r->id }}" {{ $cek  ? 'selected = selected' : ''  }}>
                                    {{ $r->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8"></div>
                <div class="col text-right">
                    <button type="submit" class="btn btn-icon btn-primary" style="border-radius: 22px;">
                        <span class="btn-inner--text">Submit</span>
                    </button>
                </div>
            </div>
            </form>
        </div>
        <div class="card-footer py-4">

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
