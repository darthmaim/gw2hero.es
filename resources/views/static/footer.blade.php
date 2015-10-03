<footer class="footer" id="footer" role="contentinfo">
    @section('footer')
        <a href="{{ url('/') }}">gw2hero.es</a> &copy; {{ date('Y') }}
        <div style="margin-top: 8px; line-height: 1.25;">
            <a href="https://trello.com/b/lUJa4FuH/gw2heroes"
               title="Post suggestions on our Trello board">Trello</a> &bull;
            <a href="https://github.com/chillerlan/gw2hero.es"
               title="View and contribute to our source code on github">github</a><br>
            <a href="https://twitter.com/gw2heroes"
               title="Follow us on twitter">@gw2heroes</a> &bull;
            <a href="https://www.facebook.com/gw2heroes"
               title="Like us on facebook">facebook</a> &bull;
            <a href="{{ action('SupportController@getContact') }}"
               title="Contact us">Contact</a>
        </div>
    @show
</footer>
