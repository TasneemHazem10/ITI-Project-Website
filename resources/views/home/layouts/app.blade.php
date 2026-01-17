@include ('home.layouts.head')


<body>
   @include('home.layouts.navbar')


    <!-- start login -->
            @yield('content')

    
    <!-- end login -->

    <!-- Footer -->
     @include('home.layouts.footer')



@yield('script')

</body>

</html>