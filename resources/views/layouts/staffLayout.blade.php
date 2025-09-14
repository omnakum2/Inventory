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
  <style>
    .scrollbox {
      background-color: #dbd8d8;
      width: auto;
      height: 200px;
      overflow-y: auto;
      overflow-x: hidden;
      border-radius: 10px;
    }

    .container {
      overflow-y: auto;
      overflow-x: hidden;
    }

    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .invoice {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
        }

        .invoice-header {
            background-color: #ccc;
            text-align: center;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }

        .invoice-footer {
            margin-top: 20px;
            text-align: center;
        }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <nav class="navbar navbar-expand-lg fixed-top" style="background:#36454f">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="#">Inventory</a>
      <button class="navbar-toggler toggle-sidebar-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="text-light"><i class="bi bi-list"></i></span>
      </button>
    </div>
  </nav>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <a href="/staff/profile" class="text-decoration-none" style="color:#36454f">
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
        <a class="nav-link" href="/staff/dashboard">
          <i class="bi bi-grid-fill"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Products-nav" data-bs-toggle="collapse">
          <i class="bi bi-list"></i><span>Invoice</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Products-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/staff/invoice">
              <i class="bi bi-circle"></i><span>New Invoice</span>
            </a>
          </li>
          <li>
            <a href="/staff/invoice/show">
              <i class="bi bi-circle"></i><span>Manage Invoice</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/staff/stock">
          <i class="bi bi-box-fill"></i>
          <span> Stock</span>
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

    <sectio class="section dashboard">
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