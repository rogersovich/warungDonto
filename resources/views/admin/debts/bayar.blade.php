@extends('layouts.element.main')

@section('title', 'Hutang - Add')

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
                                <a href="{{ route('products.index') }}">
                                    Hutang
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto text-right">

                </div>
            </div>
        </div>
        <div class="card-body" style="background: #f7f8f9;">
            <form action="{{ route('debts.process') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Nama Pembeli
                        </label>
                        <input type="text" name="name" disabled value="{{ ucwords($debt->name) }}" class="form-control form-control-alternative">
                    </div>
                </div>
                <div class="col-md-12 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Total Sebelumnya
                        </label>
                        <input type="text" name="name" disabled value="{{ number_format($debt->total_sebelumnya) }}" class="form-control form-control-alternative">
                    </div>
                </div>
                <div class="col-md-12 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Sudah Bayar
                        </label>
                        <input type="text" name="name" disabled value="{{ number_format($debt->sudah_bayar) }}" class="form-control form-control-alternative">
                    </div>
                </div>
                <div class="col-md-12 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Sisa Bayar
                        </label>
                        <input type="text" name="sisa_bayar" readonly value="{{ $debt->sisa_bayar }}" class="form-control form-control-alternative">
                    </div>
                </div>
                <div class="col-md-12 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Uang Yang Harus Di Bayar
                        </label>
                        <input type="hidden" name="debt_id" value="{{ $debt->id }}">
                        <input type="hidden" name="order_id" value="{{ $debt->order_id }}">
                        <input type="text" name="uangFix" autofocus class="form-control form-control-alternative">
                    </div>
                </div>
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
