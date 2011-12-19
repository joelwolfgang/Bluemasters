<?php 
/*
Template Name: Home
*/
get_header(); ?>

		<div id="banner">
		<?php
			$options = get_option('bluemasters_theme_options');
			$category = $options['portfolio_cat_id'];
			$slide_number = $options['portfolio_item_number'];
			if ($slide_number == "")
				$slide_number = 4;
		?>
			<div id="slider">
				<?php
					$my_query = new WP_Query('posts_per_page='.$slide_number.'&cat='.$category);
					while ($my_query->have_posts()) : $my_query->the_post();
						$unique = $post->ID; 
						$thumb = get_post_meta($post->ID, 'thumb', true);
				?>
					<a href="<?php the_permalink(); ?>" style="display:block;">
						<?php if ( has_post_thumbnail() )
								the_post_thumbnail('slider');
						?>
					</a>
				<?php
					endwhile;
				?>
			</div>
			<div id="slider-shadow"><img src="<?php bloginfo('template_directory') ?>/img/shadow.png" alt="shadow" /></div>

			<script type="text/javascript">
				$(window).load(function() {
				$('#slider').nivoSlider({
					effect:'random', //Specify sets like: 'fold,fade,sliceDown'
					slices:15,
					animSpeed:500,
					pauseTime:3000,
					startSlide:0, //Set starting Slide (0 index)
					directionNav:true //Next &amp; Prev		
					});
				});
			</script>
		</div>

	</div>

	<div id="main">

		<div class="block">
			<div class="head">
				<div class="icons"><img src="<?php bloginfo('template_directory') ?>/img/man.png" alt="Icons" /></div>
				<div class="title"><?php bloginfo('name') ?></div>
			</div>
			<div class="section">
				<img src="<?php echo $options['about_image'];?>" alt="Icons" />
				<h2>About Us</h2>
				<p><?php echo $options['about_text'];?></p>
				<div class="learn"><a href="<?php echo $options['about_url'];?>">Learn More</a></div>
			</div>
		</div>

		<div class="block">
			<div class="head">
				<div class="icons"><img src="<?php bloginfo('template_directory') ?>/img/bubble.png" alt="Icons" /></div>
				<div class="title">Our Blog Updates</div>
			</div>

			<?php query_posts('posts_per_page=1'); ?>

  			<?php while (have_posts()) : the_post(); ?>
			<?php $thumb = get_post_meta($post->ID, 'thumb', $single = true); ?>

			<div class="section">
				<?php if ( has_post_thumbnail() )
					the_post_thumbnail('home-post');
				?>
				<h2><?php the_title(); ?></h2>
				<h3>Posted in <?php the_category(', ') ?> on <?php the_time('F jS, Y') ?></h3>
				 <?php the_excerpt(); ?> 
				<div class="learn">
					<a href="<?php comments_link(); ?>"><?php comments_number('No comments','One comment','% comments'); ?></a> 
				<a href="<?php the_permalink() ?>">Read More</a>
			</div>
			<?php endwhile; ?>
		</div>
	</div>

	<div class="block2">
		<div class="head">
			<div class="icons"><img src="<?php bloginfo('template_directory') ?>/img/f.jpg" alt="Icons" /></div>
			<div class="title"><a style="text-decoration: none; color: white;" href="http://twitter.com/elkhartbicycleshop">Facebook</a></div>
		</div>
		<div class="section">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Template Row 1 Box 3')) : ?>
				
			<?php endif; ?>
		</div>

		<!--<div class="smallblock" style="margin-bottom: 10px;"> 
			<div class="ico2">
				<a href="http://twitter.com/<?php echo $options['social_twitter'];?>"><img src="<?php bloginfo('template_directory') ?>/img/twitter2.png" alt="icon" /></a>
				<a href="<?php echo $options['social_facebook'];?>"><img src="<?php bloginfo('template_directory') ?>/img/facebook.png" alt="icon" /></a>
				<a href="<?php echo $options['social_flickr'];?>"><img src="<?php bloginfo('template_directory') ?>/img/flickr.png" alt="icon" /></a>
				<a href="<?php echo $options['social_linkedin'];?>"><img src="<?php bloginfo('template_directory') ?>/img/in.png" alt="icon" /></a>
				<a href="<?php echo $options['social_tumblr'];?>"><img src="<?php bloginfo('template_directory') ?>/img/tumblr.png" alt="icon" /></a>
				<a href="<?php echo $options['social_youtube'];?>"><img src="<?php bloginfo('template_directory') ?>/img/youtube.png" alt="icon" style="margin-right: 0;" /></a>
			</div>
			<div class="clear"></div>
		</div>-->
		
	</div>

	<div class="clear"></div>
	<!-- Row Two -->
	<div class="break">
	<div class="block">
			<div class="head">
				<div class="icons"><img src="<?php bloginfo('template_directory') ?>/img/man.png" alt="Icons" /></div>
				<div class="title">Cycling News</div>
			</div>
			<div class="section rss">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Template Row 2 Box 1')) : ?>
				
				<?php endif; ?>
			</div>
		</div>
		
		<div class="block">
			<div class="head">
				<div class="icons"><img src="<?php bloginfo('template_directory') ?>/img/man.png" alt="Icons" /></div>
				<div class="title">Featured Product</div>
			</div>
			<div class="section">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Template Row 2 Box 2')) : ?>
				
				<?php endif; ?>
			</div>
		</div>
		
		<div class="block2">
			<div class="head">
				<div class="icons"><img src="<?php bloginfo('template_directory') ?>/img/man.png" alt="Icons" /></div>
				<div class="title">Cycling Resources</div>
			</div>
			<div class="section">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Template Row 2 Box 3')) : ?>
				
				<?php endif; ?>
			</div>
		</div>
		
		<div class="clear"></div>
		
</div>
</div>

<?php get_footer(); ?>
