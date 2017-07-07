<!DOCTYPE html>
<html lang="en">
<head>
    @include('publicview.metahead')

    <title>Sourcing Key - @yield('title')</title>

    @yield('custommetahead')
    
</head><!--/head-->

<body>

	@include('publicview.header')

	<section id="mainsection">
        <div class="container">

			@yield('pagebody')

        </div>
    </section>

    

    
    @include('publicview.pagefooter')
    @include('publicview.scriptfooter')
    @yield('customscripts')
</body>
</html>