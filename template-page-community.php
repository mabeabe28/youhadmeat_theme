<?php
/**
 * Template Name: Community Page React
 * Template Post Type:  page
 *
 * @package youhadmeat_theme
 */

get_header();
?>
<div id="YHMAC-root"></div>

<script src="https://www.youhadme.at/wp-content/themes/youhadmeat_theme-master/includes/react-apps/yhmac/main.js"></script>
<link rel = "stylesheet" type = "text/css" href = "https://www.youhadme.at/wp-content/themes/youhadmeat_theme-master/includes/react-apps/yhmac/main.css" />

<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    document.getElementById("site-navigation").style.top = "0";
  } else {
    document.getElementById("site-navigation").style.top = "-50px";
  }
}
</script>
<?php
/*get_sidebar();*/
get_footer();
