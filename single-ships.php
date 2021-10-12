 <?php
/*
Template Name: Single
*/
?>
<?php get_header(); ?>
<?php $category = get_the_category(); $term = get_term($category[0]->cat_ID);?>

<div class="wrapper">

	<?php include 'head.php';?><div class="header-padding"></div>	

	<main class="content">

		<div class="single-vacancies-wrap wraper-100"><div class="single-vacancies-flex wraper-1240">
			<div class="single-ship-block"><div class="single-ship-inner"><h1 class="single-ship-top-title"><?php the_field('s-name') ?><span>, <?php _e('IMO','ds'); ?> <?php the_field('s-imo') ?></span></h1>
				<div class="single-ship-item">
					<table border="0" cellspacing="0" class="single-ship-item-inner"><tr><td><?php _e('IMO number','ds'); ?></td><td><?php the_field('s-imo') ?></td></tr><tr><td><?php _e('MMSI','ds'); ?></td><td><?php the_field('s-mmsi') ?></td></tr><tr><td><?php _e('Name of the ship','ds'); ?></td><td><?php the_field('s-name') ?></td></tr><tr><td><?php _e('Former names','ds'); ?></td><td><?php the_field('s-former-names') ?></td></tr><tr><td><?php _e('Vessel type','ds'); ?></td><td><?php the_field('s-vessel-type') ?></td></tr><tr><td><?php _e('Operating status','ds'); ?></td><td><?php the_field('s-operating-status') ?></td></tr><tr><td><?php _e('Flag','ds'); ?></td><td><?php the_field('s-flag') ?></td></tr><tr><td><?php _e('Gross tonnage','ds'); ?></td><td><?php the_field('s-gross-tonnage') ?></td></tr><tr><td><?php _e('Deadweight','ds'); ?></td><td><?php the_field('s-deadweight') ?></td></tr><tr><td><?php _e('Length','ds'); ?></td><td><?php the_field('s-length') ?></td></tr><tr><td><?php _e('Breadth','ds'); ?></td><td><?php the_field('s-breadth') ?></td></tr><tr><td><?php _e('Engine type','ds'); ?></td><td><?php the_field('s-engine-type') ?></td></tr><tr><td><?php _e('Engine model','ds'); ?></td><td><?php the_field('s-engine-model') ?></td></tr><tr><td><?php _e('Engine power','ds'); ?></td><td><?php the_field('s-engine-power') ?></td></tr><tr><td><?php _e('Year of build','ds'); ?></td><td><?php the_field('s-year') ?></td></tr><tr><td><?php _e('Builder','ds'); ?></td><td><?php the_field('s-builder') ?></td></tr><tr><td><?php _e('Classification society','ds'); ?></td><td><?php the_field('s-classification-society') ?></td></tr><tr><td><?php _e('Home port','ds'); ?></td><td><?php the_field('s-home-port') ?></td></tr><tr><td><?php _e('Owner','ds'); ?></td><td><?php the_field('s-owner') ?></td></tr><tr><td><?php _e('Manager','ds'); ?></td><td><?php the_field('s-manager') ?></td></tr></table>
					<div class="single-ship-desc-block"><h2 class="single-ship-desc-title"><?php _e('Description','ds'); ?>:</h2><div class="single-ship-desc"><?php the_field('s-description') ?></div></div>
				</div>
			</div></div>
			<div class="single-vacancies-form-block"><div class="single-vacancies-form-inner"><h2 class="single-vacancies-form-title"><?php _e('Any questions ?','ds'); ?></h2>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php echo do_shortcode('[contact-form-7 id="1163" title="Single Ships" html_id="feedback-form1" html_class="feedback-form placeholder_dark"]') ?>
				<?php endwhile; ?><?php endif; ?>
		</div></div>
	</div></div>

</main>

<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li>
	<?php 
	$category = get_the_category(); 
	echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="'.get_category_link($category[0]->cat_ID).'"><span itemprop="name">'.get_cat_name($category[0]->cat_ID).'</span><meta itemprop="position" content="1"></a></span></li>';
	?>
	<li><span><span><?php the_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

</div>

<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>