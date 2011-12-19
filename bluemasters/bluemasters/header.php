<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php $options = get_option('bluemasters_theme_options'); //Get theme options ?>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
	<!-- Header starts here -->
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=<?php bloginfo('charset'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" /> 
		<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_directory') ?>/script/jquery.nivo.slider.pack.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {

				$('input[type=text]').focus(function() {

				$(this).val('')


				});

			});

		</script>
		<script type="text/javascript">
  			/* <![CDATA[ */
   			$(function(){
				<?php if( is_page_template('template-portfolio.php'))
						echo 'portfolioDropdown();';
				?>
				
		    	$(".topnav .page_item").hover(function() { // When mouse is over the Parent Page...
        			$(this).find("ul:first").fadeIn(200); // Drop down the sub-pages
      			}, function(){
        			$(this).find("ul:first").fadeOut(200); // Hide the sub-pages again
      			});		
				<?php if( is_page_template('template-contact.php')) { ?>
						initialize();
						contactForm();
				<?php } ?>
    		});
  			/* ]]> */
		</script>

		<title><?php if ( is_home() or is_front_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php bloginfo('description'); ?><?php } ?>	<?php if ( is_search() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Search Results<?php } ?>
		<?php if ( is_author() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Author Archives<?php } ?>
		<?php if ( is_single() ) { ?><?php wp_title(''); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
		<?php if ( is_page() && !is_front_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php wp_title(''); ?><?php } ?>
		<?php if ( is_category() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php single_cat_title(); ?><?php } ?>
		<?php if ( is_month() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php the_time('F'); ?><?php } ?>
		<?php if ( is_404() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Nothing's here!'<?php } ?>
		<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Tag Archive&nbsp;|&nbsp;<?php  single_tag_title("", true); } } ?>
		</title>
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

		<!-- wordpress head -->
			<?php wp_head(); ?>
		<!-- /wordpress head -->
	</head>
	<!-- Header finishes here -->
	<!-- Body starts here -->
	<body id="top">
		<div id="wrapper">
			<!-- Starts top menu (searchbox and stuff) -->
			<div class="menu"> 
				<div class="list"> 
					<?php get_search_form(); ?>
					<!--<div class="button"><a href="http://twitter.com/<?php echo $options['social_twitter'];?>"><img src="<?php bloginfo('template_directory') ?>/img/twitter.png" alt="Follow us on Twitter!" /></a></div>-->
					<div class="button"><a href="<?php echo $options['social_facebook'];?>"><img src="<?php bloginfo('template_directory') ?>/img/fb.png" alt="Facebook" /></a></div>
					<div class="button"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory') ?>/img/rss.png" alt="Feed" /></a></div>
					<div class="sub">Subscribe to: <a href="<?php bloginfo('rss2_url'); ?>">Posts</a> | <a href="<?php bloginfo('comments_rss2_url'); ?>">Comment</a> </div>

				</div>
			</div>
			<!-- Ends top menu (searchbox and stuff) -->
			<div class="clear"></div>
			<!-- Starts real menu and logo -->
			<div id="header">
				<ul class="topnav">
					<?php wp_list_pages('title_li='); ?>  
				</ul>
				<div class="logo"><a href="<?php bloginfo('url') ?>"><img src="<?php bloginfo('template_directory') ?>/img/logo.png" alt="Logo" /></a></div>
			</div>
			<!-- Ends real menu and logo -->
			<div class="clear"></div>
	<!-- Header ends here -->
