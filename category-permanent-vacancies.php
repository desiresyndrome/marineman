<?php get_header(); ?>
<?php $queried_object = get_queried_object(); ?>

<div class="wrapper">

	<?php include 'head.php';?><?php include 'top-slider.php';?>

	<div class="header-title-wrap vawe-top wraper-100"><h2 class="header-title"><?php the_field('pb-title', $queried_object) ?></h2></div>

	<div class="perm-vacancies-wrap wraper-100"><div class="perm-vacancies-block wraper-1240"><h2 class="perm-vacancies-block-title title-before"><?php single_cat_title(); ?></h2>
		<div class="perm-vacancies-what"><div class="perm-vacancies-what-item"><h3><?php _e('Position','ds'); ?></h3></div><div class="perm-vacancies-what-item"><h3><?php _e('License','ds'); ?></h3></div><div class="perm-vacancies-what-item"><h3><?php _e('Rank abbreviations','ds'); ?></h3></div><div class="perm-vacancies-what-item"><h3><?php _e('Vessel type','ds'); ?></h3></div><div class="perm-vacancies-what-item"><h3><?php _e('Vessel type description','ds'); ?></h3></div><div class="perm-vacancies-what-item"><h3><?php _e('Rotation','ds'); ?></h3></div><div class="perm-vacancies-what-item"><h3><?php _e('Salary','ds'); ?></h3></div><div class="perm-vacancies-what-item"><h3><?php _e('View actual','ds'); ?></h3></div></div>
		<div class="perm-vacancies-work-block">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php if(get_field('perm-vacancy')): ?>
					<?php while(the_repeater_field('perm-vacancy')): ?>
						<div class="perm-vacancies-work"><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-position') ?></p></div><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-license') ?></p></div><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-rank1') ?></p></div><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-rank2') ?></p></div><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-rank3') ?></p></div><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-type') ?></p></div><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-desc') ?></p></div><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-rot') ?></p></div><div class="perm-vacancies-work-item"><p><?php the_sub_field('perm-salary') ?></p></div><div class="perm-vacancies-work-item"><a href="<?php _e('/','ds'); ?>"><span><?php _e('View','ds'); ?></span></a></div></div>	
					<?php endwhile; ?><?php endif; ?>

				<?php endwhile; ?><?php else: ?><?php endif; ?>
				 
			</div>	
		</div></div>

		<div class="navigathion wraper-1240"><?php wp_pagenavi(); ?></div>

		<div class="appeal-block title-before wraper-1240"><div class="appeal-flex"><div class="appeal-item"><p><?php the_field('pv-text1', $queried_object) ?></p></div><div class="appeal-item"><p><?php the_field('pv-text2', $queried_object) ?></p></div><div class="appeal-item"><p><?php the_field('pv-text3', $queried_object) ?></p></div></div></div>

		<?php include 'my-text.php';?>

		<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li><li><span><span><?php single_cat_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

	</div>

	<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/slick.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery.scrollbar.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

	<?php wp_footer(); ?>
</body>
</html>