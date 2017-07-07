<!DOCTYPE html>
<html>

    <head>
        @include('userview.metahead')

        <title>Admin - @yield('title')</title>

        @yield('custommetahead')

    </head>

    <body class="nav-md">
      <div class="container body">

        <div class="main_container">
          @include('userview.sidebar')
          @include('userview.navbar')


          <!-- page content -->
            <div class="right_col" role="main">

                @yield('pagebody')

                <!-- footer content -->

                <footer>
                      <div>
                          <p class="">Designed and developed by <a href="http://www.balancika.com/" target="_blank">Balancika Outsourcing</a>. <img src="{{URL::asset('images/balancika.jpg')}}">
                          </p>
                      </div>
                      <div class="clearfix"></div>
                  </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>
        <!-- main content ends -->

      </div>
        @include('userview.pagefooter')

        @yield('customfooterscript')

    </body>
</html>

