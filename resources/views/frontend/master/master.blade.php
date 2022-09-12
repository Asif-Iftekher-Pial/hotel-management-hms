@include('frontend.partials.head')

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('frontend.partials.header')

    @yield('front_main')
    <!-- Hero Section Begin -->
    {{-- @include('frontend.partials.carousel') --}}
    <!-- Hero Section End -->

    @include('frontend.partials.footer')

    @include('frontend.partials.script')
</body>

</html>
