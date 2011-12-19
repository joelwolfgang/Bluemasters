		<!-- Starts top footer -->
		<?php $options = get_option('bluemasters_theme_options'); ?>
		<div id="topfooter">
			<div class="topcontent">
				<div class="column">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1')) : ?>
					
					<?php endif; ?>
				</div>
				<div class="column">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2')) : ?>
					
					<?php endif; ?>
				</div>
				<div class="column">
					<h2>From The Gallery</h2>
					<div class="gallery">
						<?php
							$category = $options['portfolio_cat_id']; 
							$my_query = new WP_Query('cat='.$category.'&orderby=rand');
							while ($my_query->have_posts()) : $my_query->the_post();
								$unique = $post->ID; 
						?>
						<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() )
								the_post_thumbnail('footer-thumbnails');
						?>
						</a>
						<?php endwhile; ?>
					</div>
				</div>
				<div class="column" style="margin-right: 0;">
					<div class="twitbird"><img src="<?php bloginfo('template_directory') ?>/img/bird.png" alt="twitter" /></div>
					<h2>Twitter Updates</h2>
					<?php 
					if (function_exists(twitter_messages)) {
						$twitter_user = $options['social_twitter'];
						twitter_messages($twitter_user, 1, true, true, '#', true, true, false); 
					} ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<!-- Ends top footer -->
		<!-- Starts "real" footer -->
		<div id="footer">
			<div class="fotcontent center">
			© 2010-<?php echo date(Y);?> Copyright <?php bloginfo('name'); ?>. All Rights Reserved. Powered by <a href="http://www.wordpress.org">WordPress</a>
			<div class="center">Elkhart Bicycle Shop | 401 E. Jackson Boulevard, Elkhart, IN 46516 | 574-294-7243</div>
			</div>
			<div class="clear"></div>
		</div>
		<!-- Ends "real" footer -->
		<!-- wordpress footer --> <?php wp_footer(); ?> <!-- /wordpress footer -->
	</body>
	<!-- Body ends here -->
</html>
