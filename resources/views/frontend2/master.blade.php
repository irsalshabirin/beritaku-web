<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    @section('head')
        @include('frontend2.partials.head')
    @show


    <body>
        @section('htmlheader')
            @include('frontend2.partials.htmlheader')
        @show

        @section('scripts')
            @yield('script-content')
        @show

        <!-- Main Content - Start -->
        @yield('main-content')
        <!-- Main Content - End -->
      
        @section('htmlfooter')
            @include('frontend2.partials.htmlfooter')
        @show


        <a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
      
    </body>


</html>
