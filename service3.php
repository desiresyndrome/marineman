<?php
/*
Template Name: Service (The Marlins Test Of Spoken English (TOSE))
*/
?>
<?php get_header(); ?>

	<div class="wrapper">

	<?php include 'head.php';?><div class="header-padding"></div>	

		<main class="content">

			<div class="service-header wraper-1240"><h1 class="service-header-title"><?php the_title(); ?></h1></div>

				<?php if ( get_field('pb-title') ) {?>
			<div class="service-pay-block service-pay-block-change wraper-1240">
				<div class="service-pay-list"><h3><?php the_field('pb-title') ?></h3>
					<?php if(get_field('pb-list')): ?>
						<ul>
							<?php while(the_repeater_field('pb-list')): ?>
								<li><?php the_sub_field('pb-list-item') ?></li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
				<div class="service-pay-module"><div class="service-pay-module-inner"><?php the_field('pb-info') ?><img src="<?php bloginfo('template_directory'); ?>/img/paysera.jpg"><a href="<?php the_field('pb-link') ?>" class="service-pay-link"></a></div></div>
			</div> 
		<?php } else { ?><?php } ?>
			 
<div class="service-form-flex-wrap service-form-flex-wrap-change-bg service-form-flex-wrap-change1 wraper-100"><div class="service-form-flex wraper-1240">
				<div class="service-form-flex-form"><h3 class="service-form-title"><?php _e('Online form','ds'); ?></h3><?php echo do_shortcode('[contact-form-7 id="1151" title="The Marlins Test Of Spoken English (TOSE)" html_id="feedback-form1" html_class="feedback-form placeholder_dark"]') ?></div>
				<div class="service-form-flex-sample"><h3 class="service-sample-title"><?php _e('Sample','ds'); ?></h3><div class="service-sample-img"><a href="<?php the_field('sample-img') ?>" class="my-cover gallery" rel="gallery" style="background-image: url(<?php the_field('sample-img') ?>);"></a></div></div>
			</div></div>
 
 		<?php if ( get_field('sr-ceo-text') ) {?>
			<div class="service-text-wrap service-text-wrap-change wraper-100"><div class="service-text-block wraper-1240">
				<?php if ( get_field('sr-ceo-title') ) {?>
				<h2 class="service-text-title"><?php the_field('sr-ceo-title') ?></h2>
					<?php } else { ?><?php } ?>
				<div class="service-text"><?php the_field('sr-ceo-text') ?></div>
			</div></div>
		<?php } else { ?><?php } ?>
 
		</main>

<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/services-for-seafarers','ds'); ?>"><span itemprop="name"><?php _e('Services for seafarers','ds'); ?></span><meta itemprop="position" content="1"></a></span></li><li><span><span><?php the_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

	</div>
 
	<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
		<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery.fancybox-1.3.4.pack.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>