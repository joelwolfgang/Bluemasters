<?php 
/*
Template Name: Product
*/
get_header(); ?>

		<!-- Starts Pages -->
		<div id="wrap">
			<div id="sheet">
				<div class="main-content">
					<div class="main-title">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="left" style="margin-right: 15px;"><img src="<?php bloginfo('template_directory') ?>/img/man2.png" alt="bub" /></div>
						<div class="left"><?php the_title(); ?></div>
						<div class="clear"></div>
					</div>
					<!-- Begin of blog post -->
						<div class="content">
							<div class="post" style="margin-bottom: 40px;">
								<?php 
								// gets all custom fields and puts thier values into a variable of the same name
								// only works with one value per custom field
								$custom_field_keys = get_post_custom_keys();
								foreach ( $custom_field_keys as $key => $value ) {
									$valuet = trim($value);
									if ( '_' == $valuet{0} )
										continue;
										$custom_fields = get_post_custom();
										$my_custom_field = $custom_fields[$value];
										foreach ( $my_custom_field as $key => $value2 )
											$$value = $value2;
								}
								?>
								
								Regular:  <span style='color: blue;'><?php echo $Regular;?></span><br/>
								Closeout:  <span style='color: red;'><?php echo $Clearance;?></span><br/><br/>
								<img src='<?php echo $Picture;?>'><br/>
								
								<?php the_content();?>
							</div>
							<div class="clear"></div>
						</div>

					<?php endwhile; else: ?>

						<p>Sorry, no posts matched your criteria.</p>

					<?php endif; ?>
				</div>
		<!-- Ends posts listing a.k.a. The Blog -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
