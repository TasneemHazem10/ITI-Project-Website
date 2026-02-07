@include('instructor.layouts.head')


<body>
    @include('instructor.layouts.top_nav')

    @include('instructor.layouts.nav')

    @yield('instructor')

    <!-- Bootstrap JS -->
    
    @yield('script')
</body>

</html>
