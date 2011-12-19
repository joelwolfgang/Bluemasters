<?php get_header(); ?>

		<!-- Starts posts listing a.k.a. The Blog -->
		<div id="wrap">
			<div id="sheet">
				<div class="main-content">
					<div class="main-title">
						<div class="left" style="margin-right: 15px;"><img src="<?php bloginfo('template_directory') ?>/img/bub.png" alt="bub" /></div>
						<div class="left">Blog</div>
						<div class="clear"></div>
					</div>
					<!-- Begin of blog post -->
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="content">
							<div <?php post_class('blogtitle'); ?> id="post-<?php the_ID(); ?>">
								<h1><?php the_title(); ?></h1>
								Posted in: <?php the_category(', ') ?> on <?php the_time('l, F jS, Y') ?>
							</div>
							<div class="post" style="margin-bottom: 40px;">
								<?php the_content(); ?>
							</div>
							<div class="left" style="margin-right: 10px;"><img style="border: 0; padding: 0;" src="<?php bloginfo('template_directory') ?>/img/tag.png"  alt="tag" /></div>
							<div class="left" style="font-weight: bold;"><?php the_tags(); ?></div>
							<div class="learn" style="float:right; margin-top:0;">
								<a style="color: #fff;" href="<?php comments_link(); ?>"><?php comments_number('No comments','One comment','% comments'); ?></a>
							</div>
							<div class="clear"></div>
						</div>

					<?php comments_template(); ?>

					<?php endwhile; else: ?>

						<p>Sorry, no posts matched your criteria.</p>

					<?php endif; ?>
				</div>
		<!-- Ends posts listing a.k.a. The Blog -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
