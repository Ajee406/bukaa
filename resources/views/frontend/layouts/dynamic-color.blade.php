<style>
    :root {
        @if(getOption('app_color_design_type', DEFAULT_COLOR) == DEFAULT_COLOR)
        --primary-color: #cdef84;
        --black-color: #121421;
        --text-black: #1b1c17;
        --para-color: #707070;
        --hover-color: #afd449;
        --color1: #383838;
        --black: #000000;
        @else
        --primary-color: {{getOption('app_primary_color', '#cdef84')}};
        --black-color: {{getOption('app_text_color', '#121421')}};
        --text-black: {{getOption('app_text_color', '#1b1c17')}};
        --para-color: {{getOption('app_text_secondary_color', '#707070')}};
        --hover-color: {{getOption('app_hover_color', '#afd449')}};
        --color1: {{getOption('app_text_secondary_color', '#383838')}};
        --black: {{getOption('app_text_color', '#000000')}};
        @endif
        --inter-tight: "Inter Tight", sans-serif;
        --scroll-track: #efefef;
        --scroll-thumb: #dadada;
        --stroke-color: #e4e6eb;
        --text-black-10: rgb(27 28 23 / 10%);
        --text-black-28: rgb(27 28 23 / 28%);
        --text-black-50: rgb(27 28 23 / 50%);
        --green: #4cbf4c;
        --red: #f02e17;
        --bg-one: #ededed;
        --border-color: #ededed;
        --color2: #ebe7d5;
        --color3: #fdedeb;
        --color4: #f4f4f4;
        --event-bg: #fbf9f1;
        --body-bg: #ffffff;
        --white: #ffffff;
        --white-10: rgb(255 255 255 / 10%);
        --white-15: rgb(255 255 255 / 15%);
        --white-32: rgb(255 255 255 / 32%);
        --white-80: rgb(255 255 255 / 70%);
        --black-5: rgb(0 0 0 / 5%);
        --black-10: rgb(0 0 0 / 10%);
    }
</style>
