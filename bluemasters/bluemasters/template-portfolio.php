<?php 
/*
Template Name: Portfolio
*/
get_header(); ?>

		<!-- Start Portfolio -->
		<?php
			$options = get_option('bluemasters_theme_options');
			$category = $options['portfolio_cat_id'];
		?>
		<div id="wrap">
			<div id="gallerysheet">
				<div class="gallery-head">
					<div class="left" style="margin-right:10px"><img src="<?php bloginfo('template_directory') ?>/img/gallery.png" alt="gallery" /></div> 
					<div class="left"><h2 style="width: 200px;">Portfolio</h2></div>
					<div class="trigger"> 
						<span></span>
						<ul class="gallerynav"> 
							<li>  
								Portfolio  
								<ul class="subnav">  
									 <?php wp_list_categories('title_li=&child_of='.$category.''); ?>  
								</ul> 
							</li> 
						</ul>
					</div>

					<script type="text/javascript">
						/* <![CDATA[ */
						function portfolioDropdown(){
							$(".trigger span").click(function() { //When trigger is clicked...
								//Following events are applied to the subnav itself (moving subnav up and down)
								$(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click
								$("ul.subnav").parent().hover(function() {
								}, function(){
									$(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
								});
								//Following events are applied to the trigger (Hover events for the trigger)
							}).hover(function() {
								$(this).addClass("subhover"); //On hover over, add class "subhover"
							}, function(){	//On Hover Out
								$(this).removeClass("subhover"); //On hover out, remove class "subhover"
							});

						}
						/* ]]> */
					</script>

				</div>
				<div class="clear"></div>

				<div class="gallery-body">
					<?php
					$category = $options['portfolio_cat_id'];
					$images_number = $options['gallery_item_number'];
					if ($images_number == "")
						$images_number = 12;
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$temp = $wp_query;
					$wp_query= null;
					$wp_query = new WP_Query('cat='.$category.'&posts_per_page='.$images_number.'&paged='.$paged);

					while ($wp_query->have_posts()) : $wp_query->the_post();
						$unique = $post->ID; 
					?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php if ( has_post_thumbnail() )
								the_post_thumbnail('portfolio');
					?>
					</a>
				<?php   
					endwhile;
				?>	
				</div>
				<div class="clear"></div>

				<div id="paging">
					<div class="left"><div class="next"><?php previous_posts_link('&laquo; Previous Page') ?></div></div>
					<div class="right"><div class="next"><?php next_posts_link('Next Page &raquo;') ?></div></div>
					<div class="clear"></div>
				</div>
				<?php $wp_query = null; $wp_query = $temp;?>

			</div>
		</div>
	</div>
<?php get_footer(); ?>
