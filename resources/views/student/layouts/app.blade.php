@include('student.layouts.head')

<body>
@include('student.layouts.top_nav')
    
    <!-- Sidebar -->
    @include('student.layouts.nav')

    @include('student.layouts.top_nav')
    <!-- Main Content -->
    @yield('student')
    

    <!-- Bootstrap JS -->
    @yield('script')
</body>

</html>
