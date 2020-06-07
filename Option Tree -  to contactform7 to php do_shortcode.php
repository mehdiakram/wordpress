// Options tree to contactform7 to php do_shortcode
<?php 
$contact = ot_get_option('home_contactform7');
echo do_shortcode($contact);
?>