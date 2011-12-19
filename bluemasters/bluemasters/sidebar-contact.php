					<!-- Begin of sidebar -->
					<div id="sidebar">
						<h2 class="cell">Get In Touch</h2>
						
						<p><?php
							$options = get_option('bluemasters_theme_options'); //Get theme options
							echo $options['git_info'] ?></p>
                        
                        <ul id="git_info">
                        	<li class="git_phone">
                            	<h3>Phone</h3>
                                <h4><?php echo $options['git_phone']; ?></h4>
                            </li>
                            <li class="git_email">
                            	<h3>Email Address</h3>
                                <h4><?php echo $options['git_email']; ?></h4>
                            </li>
                            <li class="git_address">
                            	<h3>Address</h3>
                                <h4>

<?php 
$str = $options['git_address']; 
$str = explode(",",$str);
echo $str[0] . "<br/>" . $str[1] . ", " . $str[2];
?>
</h4>
                            </li>
                        </ul>

						<h2 class="list">Site Navigation</h2>

						<ul class="spenav">
							<li><a href="<?php bloginfo('url') ?>">Home</a></li>
							<?php wp_list_pages('title_li=&depth=1'); ?>  
						</ul>

						<h2 class="comment">Network Connect</h2>

						<p class="aligncenter">
							<a href="http://twitter.com/<?php echo $options['social_twitter'];?>"><img src="<?php bloginfo('template_directory') ?>/img/twitter2.png" alt="icon" /></a>
							<a href="<?php echo $options['social_facebook'];?>"><img src="<?php bloginfo('template_directory') ?>/img/facebook.png" alt="icon" /></a>
							<a href="<?php echo $options['social_flickr'];?>"><img src="<?php bloginfo('template_directory') ?>/img/flickr.png" alt="icon" /></a>
							<a href="<?php echo $options['social_linkedin'];?>"><img src="<?php bloginfo('template_directory') ?>/img/in.png" alt="icon" /></a>
							<a href="<?php echo $options['social_tumblr'];?>"><img src="<?php bloginfo('template_directory') ?>/img/tumblr.png" alt="icon" /></a>
							<a href="<?php echo $options['social_youtube'];?>"><img src="<?php bloginfo('template_directory') ?>/img/youtube.png" alt="icon" style="margin-right: 0;" /></a>
						</p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>