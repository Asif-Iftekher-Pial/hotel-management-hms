{{-- css head --}}
@include('backend.partials.head')

<body>
    <div class="main-wrapper">
        {{-- header section --}}
        @include('backend.partials.header')
        {{-- left sidebar section --}}
        @include('backend.partials.sidebar')
        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('main_section')
            </div>
        </div>
    </div>
    {{-- js files --}}
    @include('backend.partials.script')
</body>

</html>
