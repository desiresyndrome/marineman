<?php
/*
Template Name: Service (STCW Online Courses)
*/
?>
<?php get_header(); ?>

<div class="wrapper">

	<?php include 'head.php';?><div class="header-padding"></div>	

	<main class="content">

		<div class="service-all-wrap service-all-wrap-change wraper-100"><div class="service-all-block wraper-1240"><h1 class="service-all-block-title"><?php the_title(); ?></h1>
			<?php if ( get_field('sh-text') ) {?>
				<div class="service-short-text-block"><div class="service-short-text">
					<?php the_field('sh-text') ?>
				</div></div> 
			<?php } else { ?><?php } ?>
			<?php if(get_field('sat-item')): ?>
				<div class="service-all-flex">
					<?php while(the_repeater_field('sat-item')): ?>		
						<div class="service-all-item"><div class="service-all-item-inner"><div class="service-all-item-inner-block">
							<h2 class="service-all-item-title"><a href="<?php the_sub_field('sat-item-link') ?>" target="_blank"><?php the_sub_field('sat-item-title') ?></a></h2>
							<div class="service-all-item-text"><p><?php the_sub_field('sat-item-text') ?></p></div>
						</div><a href="<?php the_sub_field('sat-item-link') ?>" class="service-all-item-more" target="_blank"><span><?php _e('Order','ds'); ?></span></a></div></div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div></div>

	</main>

	<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/services-for-seafarers','ds'); ?>"><span itemprop="name"><?php _e('Services for seafarers','ds'); ?></span><meta itemprop="position" content="1"></a></span></li><li><span><span><?php the_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

</div>

<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery.fancybox-1.3.4.pack.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>