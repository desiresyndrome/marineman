<?php
/*
Template Name: Service (ECDIS Specific Courses)
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
				<div class="service-pay-module service-pay-module-change"><div class="service-pay-module-inner"><?php the_field('pb-info') ?></div></div>
			</div> 
		<?php } else { ?><?php } ?>
		
		<?php if ( get_field('pb2-title') ) {?>
			<div class="service-pay-block service-pay-block-change3 wraper-1240">
				<div class="service-pay-module service-pay-module-change"><div class="service-pay-module-inner"><?php the_field('pb2-info') ?></div></div>
				<div class="service-pay-list"><h3><?php the_field('pb2-title') ?></h3>
					<?php if(get_field('pb2-list')): ?>
						<ul>
							<?php while(the_repeater_field('pb2-list')): ?>
								<li><?php the_sub_field('pb2-list-item') ?></li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>				
			</div> 
		<?php } else { ?><?php } ?>

			<div class="service-form-block wraper-1240"><div id="courses"></div><h3 class="service-form-title"><?php _e('Online form','ds'); ?></h3><?php echo do_shortcode('[contact-form-7 id="1154" title="ECDIS Specific Courses" html_id="feedback-form1" html_class="feedback-form placeholder_dark"]') ?></div>
			
			<?php if(get_field('tr-item')): ?>
			<div class="service-form-flex-wrap service-form-flex-wrap-change-bg service-form-flex-wrap-change1 wraper-100"><div class="training-flex wraper-1240">
	<?php while(the_repeater_field('tr-item')): ?>
				<div class="training-item"><div class="training-item-inner">
					<div class="training-item-inner-block">
						<h3 class="training-item-title"><a href="#courses" class="anhor1"><?php the_sub_field('tr-item-title') ?></a></h3>
						<div class="training-item-img"><div class="my-cover" style="background-image: url(<?php the_sub_field('tr-item-img') ?>);"></div></div>
						<div class="training-item-text"><p><?php the_sub_field('tr-item-text') ?></p></div>
						<span class="training-price"><?php the_sub_field('tr-item-price') ?></span>
						<div class="training-buy"><a href="<?php the_sub_field('tr-item-link') ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/img/paysera.jpg" alt=""></a></div>
					</div>
					<a href="#courses" class="training-item-more anhor1"><span><?php _e('Order','ds'); ?></span></a> 
				</div></div> 
				 			<?php endwhile; ?>
			</div></div>  
		<?php endif; ?>

			<div class="service-text-wrap service-text-wrap-change wraper-100"><div class="service-text-block wraper-1240">
				<?php if ( get_field('sr-ceo-text') ) {?>
					<?php if ( get_field('sr-ceo-title') ) {?>
						<h2 class="service-text-title"><?php the_field('sr-ceo-title') ?></h2>
					<?php } else { ?><?php } ?>
					<div class="service-text"><?php the_field('sr-ceo-text') ?>		</div>
				<?php } else { ?><?php } ?>
				<?php if ( get_field('sh-text') ) {?>
					<div class="service-short-text-block service-short-text-block-change"><div class="service-short-text"><?php the_field('sh-text') ?></div></div> 
				<?php } else { ?><?php } ?>
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