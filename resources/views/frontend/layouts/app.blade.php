<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('frontend.layouts.header')

<body class="{{ selectedLanguage()->rtl == 1 ? 'direction-rtl' : 'direction-ltr' }}">
<input type="hidden" id="lang_code" value="{{session('local')}}">
@if (getOption('app_preloader_status', 0) == STATUS_ACTIVE)
    <div id="preloader">
        <div id="preloader_status">
            <img src="{{ getSettingImage('app_preloader') }}" alt="{{ getOption('app_name') }}"/>
        </div>
    </div>
@endif

@include('frontend.layouts.nav')

@yield('content')

@include('frontend.layouts.footer')


<iframe width="100%" height="100%" allow="microphone *" src="https://www.gptbots.ai/widget/eeuz5lpiaqv47hkvedtyfjx/chat.html"></iframe>


@if (!empty(getOption('cookie_status')) && getOption('cookie_status') == STATUS_ACTIVE)
    <div class="cookie-consent-wrap shadow-lg">
        @include('cookie-consent::index')
    </div>
@endif

<script src="https://www.gptbots.ai/widget/wellzrop8cwwhz1dschoqa2/chat.js"></script>
  
  
@include('frontend.layouts.script')
</body>

</html>
