<?php

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=> 'Home Template Row 1 Box 3',
		'id' => 'home_row_one_box_three',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name'=> 'Home Template Row 2 Box 1',
		'id' => 'home_row_two_box_one',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="offscreen">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=> 'Home Template Row 2 Box 2',
		'id' => 'home_row_two_box_two',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name'=> 'Home Template Row 2 Box 3',
		'id' => 'home_row_two_box_three',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
		register_sidebar(array(
		'name'=> 'Footer 1',
		'id' => 'footer_1',
		'before_widget' => '<ul class="botnav"><li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li></ul>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
		register_sidebar(array(
		'name'=> 'Footer 2',
		'id' => 'footer_2',
		'before_widget' => '<ul class="botnav"><li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li></ul>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
		register_sidebar(array(
		'name'=> 'Footer 3',
		'id' => 'footer_3',
		'before_widget' => '<ul class="botnav"><li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li></ul>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
		register_sidebar(array(
		'name'=> 'Footer 4',
		'id' => 'footer_4',
		'before_widget' => '<ul class="botnav"><li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li></ul>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}

/* Activating thumbnail support */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 590, 145, true ); // Thumbnails for posts
add_image_size( 'slider', 930, 320, true ); // Home Slider
add_image_size( 'portfolio', 190, 165, true ); // Thumbnail on portfolio gallery
add_image_size( 'footer-thumbnails', 44, 41, true ); // Thumbnail on footer gallery
add_image_size( 'home-post', 250, 85, true ); // Thumbnail on home
add_image_size( 'featured-product', 220, 220 ); // Thumbnail on featured widget

/**
 * Conditional Page/Post Navigation Links
 * http://www.ericmmartin.com/conditional-pagepost-navigation-links-in-wordpress-redux/
 * If more than one page exists, return TRUE.
 */
function show_posts_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}

// Limit of excerpt on homepage (in words)
function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Call the options page
require_once ( get_template_directory() . '/admin/theme-options.php' );

// Including the twitter plugin by default, any better idea?

include(get_template_directory() . '/script/twitter.php' );


// This is the new comment markup - edit as you feel necessary
function masters_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
      
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='50',$default='<path_to_url>' ); ?><br />

	<div class="reply">
		<span class="reply_for_ie6"></span>
 		<?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>

		<?php edit_comment_link(__('(Edit)'),'  ','') ?>
      
      </div>

         <?php printf(__('<cite class="fn">%s says:</cite>'), get_comment_author_link()) ?> 
	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_date('F nS, Y'); ?> at <?php comment_date('g:ia'); ?></a><br/></div>
   	   <?php if ($comment->comment_approved == '0') : ?>
   	      <em><?php _e('- Your comment is awaiting moderation.') ?></em>
    		<?php endif; ?>

      <?php comment_text() ?>

<?php
        }

// Changes the trailing </li> into a trailing </article>
function close_comment() {?>
	</li>
<?php
}

?>
