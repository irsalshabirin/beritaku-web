<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">

    @section('htmlheader')
        @include('frontend.partials.htmlheader')
    @show


    <body>
        <div class="demo-blog @yield('class-parent-div') mdl-layout mdl-js-layout has-drawer is-upgraded">
            <main class="mdl-layout__content">

                <div class="demo-blog__posts mdl-grid">
                    @yield('main-content')
                </div>

                @include('frontend.partials.htmlfooter')

            </main>

            <div class="mdl-layout__obfuscator"></div>

        </div>
        
        @section('scripts')
            @include('frontend.partials.scripts')
            @yield('script-content')
        @show
        
    </body>


</html>
