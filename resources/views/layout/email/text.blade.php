@yield('title', isset( $subject ) ? $subject : 'GW2Heroes')

------------------------------------------------------------

@yield('body')


---
@section('footer')
@include('layout.email.text.footer')
@show
