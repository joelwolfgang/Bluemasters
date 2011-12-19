					<!-- Begin of sidebar -->
					<div id="sidebar">
						<?php 	/* Widgetized sidebar, if you have the plugin installed. */
							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

							<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
							<li><h2>Author</h2>
								<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
							</li>
						-->
						
						<h2 class="list">Site Navigation</h2>

						<ul class="spenav">
							<li><a href="<?php bloginfo('url') ?>">Home</a></li>
							<?php wp_list_pages('title_li=&depth=1'); ?>  
						</ul>

						<h2 class="list">Blog Archives</h2>

						<ul class="sidenav">
							<?php wp_get_archives('show_post_count=1'); ?> 
						</ul>
						<!--<h2 class="comment">Network Connect</h2>

						<p class="aligncenter">
							<?php
								$options = get_option('bluemasters_theme_options'); //Get theme options
							?>
							<a href="http://twitter.com/<?php echo $options['social_twitter'];?>"><img src="<?php bloginfo('template_directory') ?>/img/twitter2.png" alt="icon" /></a>
							<a href="<?php echo $options['social_facebook'];?>"><img src="<?php bloginfo('template_directory') ?>/img/facebook.png" alt="icon" /></a>
							<a href="<?php echo $options['social_flickr'];?>"><img src="<?php bloginfo('template_directory') ?>/img/flickr.png" alt="icon" /></a>
							<a href="<?php echo $options['social_linkedin'];?>"><img src="<?php bloginfo('template_directory') ?>/img/in.png" alt="icon" /></a>
							<a href="<?php echo $options['social_tumblr'];?>"><img src="<?php bloginfo('template_directory') ?>/img/tumblr.png" alt="icon" /></a>
							<a href="<?php echo $options['social_youtube'];?>"><img src="<?php bloginfo('template_directory') ?>/img/youtube.png" alt="icon" style="margin-right: 0;" /></a>
						</p>-->
						<?php endif; ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
