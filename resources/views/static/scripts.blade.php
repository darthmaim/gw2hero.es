<script async src="{{ asset2('js/gw2heroes.js') }}"></script>

<script>
    if('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js');
    }
</script>

@yield('scripts')

@include('static.scripts.analytics')
