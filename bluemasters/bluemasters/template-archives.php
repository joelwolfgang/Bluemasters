<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

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
								<h2>Archives by Subject:</h2>
									<ul>
										<?php wp_list_categories('title_li='); ?>
									</ul>

								<h2>Archives by Pages:</h2>
									<ul>
										<?php wp_list_pages('&title_li='); ?>
									</ul>
								<h2>Archives by Title:</h2>
									<ul>
										<?php wp_get_archives('type=alpha');?>
									</ul>

								<h2>Archives by Month:</h2>
									<ul>
										<?php wp_get_archives('type=monthly'); ?>
									</ul>
								
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
