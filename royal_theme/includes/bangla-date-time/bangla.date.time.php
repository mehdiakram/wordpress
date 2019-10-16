<?php

  $rtbn_options = get_option("rtbn_options");
  if (!is_array($rtbn_options)) {
    $rtbn_options = array(
        'cal_wgt' => '1',
        'trans_dt' => '1',
        'trans_cmnt' => '1',
        'trans_num' => '1',
        'trans_cal' => '1' );
   }


include "bangla.translator.php";
include "bangla.date.class.php";

function rtbn_bangla_time() {

$offset=6*60*60; //converting 6 hours to seconds.
$hour = gmdate("G", time()+$offset);

if ($hour >= 5 && $hour <= 5) { echo "ভোর "; }
else if ($hour >= 6 && $hour <= 11) { echo "সকাল "; }
else if ($hour >= 12 && $hour <= 14) { echo "দুপুর "; }
else if ($hour >= 15 && $hour <= 17) { echo "বিকাল "; }
else if ($hour >= 18 && $hour <= 19) { echo "সন্ধ্যা "; }
else { echo "রাত "; }

echo en_to_bn(gmdate("g:i", time()+$offset));
}


function rtbn_bn_day() { echo en_to_bn(gmdate("l", time()+6*60*60)); }

function rtbn_bangla_date_function() {

  $rtbn_options = get_option("rtbn_options");
  if (!is_array($rtbn_options)) {
    $rtbn_options = array( 'dt_change' => '6', 'separator' => ', ', 'last_word' => '1', 'ord_suffix' => '1' ); }
if ( $rtbn_options['last_word'] == "1" ) { $last_word = " বঙ্গাব্দ"; }

$bn = new BanglaDate(time(), $rtbn_options['dt_change']);
$bdtday = $bn->get_day();
$bdtmy = $bn->get_month_year();

$day = sprintf( '%s', implode( ' ', $bdtday ) );
$month_year = sprintf( '%s', implode( $rtbn_options['separator'] , $bdtmy ) );

$day_number = array( "১" => "১লা", "২" => "২রা", "৩" => "৩রা", "৪" => "৪ঠা", "৫" => "৫ই", "৬" => "৬ই", "৭" => "৭ই", "৮" => "৮ই", "৯" => "৯ই", "১০" => "১০ই", "১১" => "১১ই", "১২" => "১২ই", "১৩" => "১৩ই", "১৪" => "১৪ই", "১৫" => "১৫ই", "১৬" => "১৬ই", "১৭" => "১৭ই", "১৮" => "১৮ই", "১৯" => "১৯শে", "২০" => "২০শে", "২১" => "২১শে", "২২" => "২২শে", "২৩" => "২৩শে", "২৪" => "২৪শে", "২৫" => "২৫শে", "২৬" => "২৬শে", "২৭" => "২৭শে", "২৮" => "২৮শে", "২৯" => "২৯শে", "৩০" => "৩০শে", "৩১" => "৩১শে" );

if ( $rtbn_options['ord_suffix'] == "1" ) { echo $day_number[$day] . ' ' . $month_year . $last_word; }
elseif ( $rtbn_options['ord_suffix'] == "" ) { echo $day . ' ' . $month_year . $last_word; }
}


function rtbn_bn_season() {

$bn = new BanglaDate(time(), 0);
$bdtmonth = $bn->get_month();
$month = sprintf( '%s', implode( ' ', $bdtmonth ) );

if($month == "বৈশাখ" || $month == "জ্যৈষ্ঠ") { echo "গ্রীষ্মকাল"; }
elseif($month == "আষাঢ়" || $month == "শ্রাবণ") { echo "বর্ষাকাল"; }
elseif($month == "ভাদ্র" || $month == "আশ্বিন") { echo "শরৎকাল"; }
elseif($month == "কার্তিক" || $month == "অগ্রহায়ণ") { echo "হেমন্তকাল"; }
elseif($month == "পৌষ" || $month == "মাঘ") { echo "শীতকাল"; }
else { echo "বসন্তকাল"; }
}



function rtbn_bn_en_date() {

  $rtbn_options = get_option("rtbn_options");
  if (!is_array($rtbn_options)) {
    $rtbn_options = array( 'separator' => ', ', 'last_word' => '1', 'ord_suffix' => '1' ); }
if ( $rtbn_options['last_word'] == "1" ) { $last_word = " ইং"; }

if ( $rtbn_options['ord_suffix'] == "1" ) { $day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" ); }

elseif ( $rtbn_options['ord_suffix'] == "" ) { $day_number = array( "1" => "১", "2" => "২", "3" => "৩", "4" => "৪", "5" => "৫", "6" => "৬", "7" => "৭", "8" => "৮", "9" => "৯", "10" => "১০", "11" => "১১", "12" => "১২", "13" => "১৩", "14" => "১৪", "15" => "১৫", "16" => "১৬", "17" => "১৭", "18" => "১৮", "19" => "১৯", "20" => "২০", "21" => "২১", "22" => "২২", "23" => "২৩", "24" => "২৪", "25" => "২৫", "26" => "২৬", "27" => "২৭", "28" => "২৮", "29" => "২৯", "30" => "৩০", "31" => "৩১" ); }

$offset=6*60*60;
echo $day_number[gmdate("j", time()+$offset)] . " " . en_to_bn(gmdate("F", time()+$offset)); echo $rtbn_options['separator'] . en_to_bn(gmdate("Y", time()+$offset)) . $last_word;
}



function rtbn_bn_hijri_date() {

  $rtbn_options = get_option("rtbn_options");
  if (!is_array($rtbn_options)) {
    $rtbn_options = array( 'hijri_adjust' => '24', 'hijri_tz' => 'Asia/Dhaka', 'separator' => ', ', 'last_word' => '1', 'ord_suffix' => '1' ); }
if ( $rtbn_options['last_word'] == "1" ) { $last_word = " হিজরী"; }

$offset2 = $rtbn_options['hijri_adjust'] * 60 * 60;

include "bangla.uCal.class.php";
$d = new uCal;

$tz = date_default_timezone_set($rtbn_options['hijri_tz']);

if ( $rtbn_options['ord_suffix'] == "1" ) { $day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" ); }

elseif ( $rtbn_options['ord_suffix'] == "" ) { $day_number = array( "1" => "১", "2" => "২", "3" => "৩", "4" => "৪", "5" => "৫", "6" => "৬", "7" => "৭", "8" => "৮", "9" => "৯", "10" => "১০", "11" => "১১", "12" => "১২", "13" => "১৩", "14" => "১৪", "15" => "১৫", "16" => "১৬", "17" => "১৭", "18" => "১৮", "19" => "১৯", "20" => "২০", "21" => "২১", "22" => "২২", "23" => "২৩", "24" => "২৪", "25" => "২৫", "26" => "২৬", "27" => "২৭", "28" => "২৮", "29" => "২৯", "30" => "৩০", "31" => "৩১" ); }

$month_name = array( "Muh" => "মুহাররম", "Saf" => "সফর", "Rb1" => "রবিউল-আউয়াল", "Rb2" => "রবিউস-সানি", "Jm1" => "জমাদিউল-আউয়াল", "Jm2" => "জমাদিউস-সানি", "Raj" => "রজব", "Shb" => "শাবান", "Rmd" => "রমযান", "Shw" => "শাওয়াল", "DhQ" => "জিলক্বদ", "DhH" => "জিলহজ্জ" );

echo $day_number[$d->date("j", time()-$offset2)] . " " . $month_name[$d->date("M", time()-$offset2)] . $rtbn_options['separator'] . en_to_bn($d->date("Y", time()-$offset2)) . $last_word;
}



add_shortcode('bangla_time', 'rtbn_bangla_time');
add_shortcode('bangla_day', 'rtbn_bn_day');
add_shortcode('bangla_date', 'rtbn_bangla_date_function');
add_shortcode('bangla_season', 'rtbn_bn_season');
add_shortcode('english_date', 'rtbn_bn_en_date');
add_shortcode('hijri_date', 'rtbn_bn_hijri_date');










?>
