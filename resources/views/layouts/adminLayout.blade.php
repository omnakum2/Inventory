<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>IMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.jpg') }}" rel="icon" class="rounded-circle">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="{{ asset('assets/css/fontG.css') }}">


  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/dataTables.dataTables.min.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/jQuery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>
  <style>
    .btn-color {
      background-color: #36454f;
      color: #fff;
    }

    .area {
      size: 100rem;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <nav class="navbar navbar-expand-lg fixed-top" style="background:#36454f">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="admin/dashboard">Inventory</a>
      <button class="navbar-toggler toggle-sidebar-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="text-light"><i class="bi bi-list"></i></span>
      </button>
    </div>
  </nav>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <a href="/admin/profile" class="text-decoration-none" style="color:#36454f">
        <div class="box text-center">
          <div class="row">
            <span class="bi bi-person-fill display-6"></span>
          </div>
          <div class="row mb-2">
            <strong><span class="h4">{{ Auth::user()->name }}</span></strong>
          </div>
        </div>
      </a>

      <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard">
          <i class="bi bi-grid-fill"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/staff">
          <i class="bi bi-people-fill"></i>
          <span>Staff</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/report">
          <i class="bi bi-bar-chart-fill"></i>
          <span> Report's</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Products-nav" data-bs-toggle="collapse">
          <i class="bi bi-box"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Products-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/admin/product/add">
              <i class="bi bi-circle"></i><span>Add Products</span>
            </a>
          </li>
          <li>
            <a href="/admin/product">
              <i class="bi bi-circle"></i><span>Manage Products</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#stock-nav" data-bs-toggle="collapse">
          <i class="bi bi-box-fill"></i><span>Product stock</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="stock-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/admin/stock/add">
              <i class="bi bi-circle"></i><span>Add Stock</span>
            </a>
          </li>
          <li>
            <a href="/admin/stock">
              <i class="bi bi-circle"></i><span> Manage stock</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/brand">
          <i class="bi bi-bootstrap-fill"></i>
          <span> New Brand</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/category">
          <i class="bi bi-stack"></i>
          <span> New Category</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/wharehouse">
          <i class="bi bi-house"></i>
          <span> New Wharehouse</span>
        </a>
      </li>

      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a class="nav-link collapsed" href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span> Logout</span>
          </a>
        </form>
      </li>
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      @yield('page-title')
    </div><!-- End Page Title -->

    <section class="section dashboard">
      @yield('content')
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer fixed-bottom">
    <div class="copyright">
      &copy; Copyright <strong><span>IMS</span></strong>. All Rights Reserved
    </div>

  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
  <script>
    let table = new DataTable('#myTable')

    function remove() {
      return confirm('are u sure to delete ?')
    }
  </script>
  @stack('customScript')
</body>

</html>