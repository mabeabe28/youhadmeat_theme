<?php
/**
 * Template Name: Billsplit Page React
 * Template Post Type:  page
 *
 * @package youhadmeat_theme
 */

get_header();
?>
<div id="root"></div>

<script src="https://www.youhadme.at/wp-content/themes/youhadmeat_theme-master/includes/react-apps/billsplit/billsplit.js"></script>
<link rel = "stylesheet" type = "text/css" href = "https://www.youhadme.at/wp-content/themes/youhadmeat_theme-master/includes/react-apps/billsplit/billsplit.css" />

<script>
    document.getElementById("site-navigation").style.display = "none";
    document.getElementById("initial-navigation").style.display = "none";
</script>
<?php
/*get_sidebar();*/
get_footer();
