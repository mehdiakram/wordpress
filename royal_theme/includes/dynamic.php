<style type="text/css">.header_body {background-color: <?php if (ot_get_option('header_bg_color')) { ?><?php echo ot_get_option('header_bg_color'); ?><?php } else {?>#EAF2FE<?php } ?>;}.fix_body {background-color: <?php if (ot_get_option('news_scrolling_bg_color')) { ?><?php echo ot_get_option('news_scrolling_bg_color'); ?><?php } else {?>#fff<?php } ?>;}.scrollingtext a, .scrollingtext a:link, .scrollingtext a:visited, .message {color: <?php if (ot_get_option('news_scrolling_text_color')) { ?><?php echo ot_get_option('news_scrolling_text_color'); ?><?php } else {?>#000<?php } ?>;}.footer_body {background-color: <?php if (ot_get_option('footer_bg_color')) { ?><?php echo ot_get_option('footer_bg_color'); ?><?php } else {?>#0ABEFF<?php } ?>;}</style><?php if(ot_get_option('news_scrolling_display') == 'disabled') { ?><style type="text/css">.new_tracker {display: none;}.header {margin-top: 0px;}</style><?php } else { ?><style type="text/css">.new_tracker {display: block;margin-top: -40px;}.header {margin-top: 40px;</style><?php } ?><?php if(ot_get_option('news_scrolling_width') == 'disabled') { ?><style type="text/css">.fix_body{width: 945px; margin: 0 auto;}</style><?php } else { ?><style type="text/css">.fix_body{width: 100%;}</style><?php } ?>