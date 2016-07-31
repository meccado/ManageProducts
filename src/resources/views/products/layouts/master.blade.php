<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

  <!-- css styles-->
  @include('mng_product::products.partials.html-head')
  @yield('styles')
  <!-- ./css styles-->
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">

      <div class="wrapper">

            <!-- Main Header -->
            @include('mng_product::products.partials.navbar')

            <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
                  <!-- Left side column. contains the logo and sidebar -->
                  @include('mng_product::products.partials.left-sidebar')

                  <!-- Content Header (Page Breadcrumb) -->
				          {{-- @include('mng_product::products.partials.page-breadcrumb') --}}

                  <section class="content"><!-- Main content -->
                      <!-- Your Page Content Here -->
                      @include('errors.error')
                      @yield('content')
                  </section><!-- /.content -->

            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            {{-- @include('mng_product::products.partials.footer') --}}

            <!-- Control Sidebar -->
            @include('mng_product::products.partials.control-sidebar')
            <!-- /.control-sidebar -->

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

      </div><!-- ./wrapper -->

      <!-- scripts -->
      @include('mng_product::products.partials.html-scripts')
      @include('mng_product::products.partials.footer')

      @yield('scripts')
      <!-- ./scripts -->

      <!-- Optionally, you can add Slimscroll and FastClick plugins.
           Both of these plugins are recommended to enhance the
           user experience. Slimscroll is required when using the
           fixed layout. -->

  </body>
</html>
