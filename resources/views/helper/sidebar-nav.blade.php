<ul class="sidebar-nav">
    <?php $activeUrl = request()->fullUrl(); ?>
    @foreach($links as $label => $url)
        <li><a class="{{ $activeUrl === $url ? 'active' : ''}}" href="{{ $url or '#' }}">{{ $label }}</a></li>
    @endforeach
</ul>
