<style>
    :root {
        @if(getOption('sa_app_color_design_type', DEFAULT_COLOR) == DEFAULT_COLOR)
        --primary-color: #cdef84;
        --hover-color: #afd449;
        --bColor: #707070;
        --colorOne: #707070;
        --text-black: #1b1c17;
        --sidebar-text-color: #e7e3e3;
        --sidebar-bg-color: #1b1c17;
        --sidebar-hover-text-color: #cdef84;
        --main-color: #cdef84;
        --inner-gradient: linear-gradient(
            180deg,
            #1b1c17 0%,
            #1ad717 900%
        );
        --gradient-1: radial-gradient(
            circle,
            #1b1c17 -60.43%,
            #1b1c17 19.49%,
            #1b1c17 50%,
            #0fa958 410%
        );
        @else
        --primary-color: {{getOption('sa_app_primary_color', '#cdef84')}};
        --hover-color: {{getOption('sa_app_hover_color', '#afd449')}};
        --bColor: {{getOption('sa_app_text_body_color', '#707070')}};
        --colorOne: {{getOption('sa_app_text_body_color', '#707070')}};
        --text-black: {{getOption('sa_app_text_color', '#1b1c17')}};
        --sidebar-text-color: {{getOption('sa_app_sidebar_text_color', '#e7e3e3')}};
        --sidebar-bg-color: {{getOption('sa_app_sidebar_bg_color', '#1b1c17')}};
        --sidebar-hover-text-color: {{getOption('sa_app_sidebar_text_color', '#cdef84')}}ef;
        --main-color: {{getOption('sa_app_primary_color', '#cdef84')}};
        --inner-gradient: {{getOption('sa_inner_gradient_color', 'linear-gradient(180deg, #1b1c17 0%, #1ad717 900%)')}};
        --gradient-1: {{getOption('sa_gradiant1_color', 'radial-gradient( circle, #1b1c17 -60.43%, #1b1c17 19.49%, #1b1c17 50%, #0fa958 410%)')}};
        @endif
        --stroke-color: #e4e6eb;
        --colorTwo: #ebedf0;
        --colorThree: #fafafa;
        --colorFour: #71e3ba;
        --colorFive: #ed84ef;
        --colorSix: #84a2ef;
        --colorSeven: #f4f4ef;
        --colorEight: #ea4335;
        --colorEight-10: rgb(234 67 53 / 10%);
        --colorNine: #f9f9f9;
        --colorTen: #fdedeb;
        --colorEleven: #eaeaea;
        --colorTwelve: #0fa958;
        --colorTwelve-10: rgb(15 169 88 / 10%);
        --color13: #f5b40a;
        --color13-10: rgb(245 180 10 / 10%);
        --color14: #ebe7d5;
        --color15: #e6ef84;
        --color16: #84dcef;
        --color17: #eef0f2;
        --color18: #b7bdc6;
        --color19: #596680;
        --color20: #f0f0f0;
        --color21: #ed0006;
        --color22: #8d84ef;
        --color23: #d3d9e5;
        --color24: #cdffc5;
        --color25: #ffc5a5;
        --color26: #efece0;
        --color27: #262722;
        --color28: #f4f4f4;
        --color29: #ffcdb0;
        --color30: #bbffb0;
        --color31: #30312d;
        --color32: #8d6eff;
        --color33: #ff8972;
        --color34: #ffb263;
        --scroll-track: #efefef;
        --scroll-thumb: #dadada;
        --text-black-50: rgb(27 28 23 / 50%);
        --green: #4cbf4c;
        --red: #f02e17;
        --bg-one: #ededed;
        --border-color: #ededed;
        --border-color-one: #e5e8ec;
        --border-color-deep: #b0b0b0;
        --body-bg: #fbf9f1;
        --white: #ffffff;
        --white-10: rgb(255 255 255 / 10%);
        --white-12: rgb(255 255 255 / 12%);
        --white-15: rgb(255 255 255 / 15%);
        --white-32: rgb(255 255 255 / 32%);
        --white-70: rgb(255 255 255 / 70%);
        --white-80: rgb(255 255 255 / 80%);
        --black: #000000;
        --black-5: rgb(0 0 0 / 5%);
        --black-8: rgb(0 0 0 / 8%);
        --black-10: rgb(0 0 0 / 10%);
        --black-12: rgb(0 0 0 / 12%);
    }
</style>
