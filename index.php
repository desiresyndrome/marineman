<?php get_header(); ?>
<?php $queried_object = get_queried_object(); ?>

<div class="wrapper">

	<?php include 'head.php';?>
	<?php include 'top-slider.php';?>
	
	<div class="gl-guarantee-wrap vawe-top wraper-100"><div class="gl-guarantee-block wraper-1240"><h2 class="gl-guarantee-block-title wow fadeInUp" data-wow-duration="1s"><?php _e('We guarantee','ds'); ?></h2><div class="gl-guarantee-flex"><div class="gl-guarantee-item wow flipInY" data-wow-duration="2s" data-wow-delay=".7s"><img src="<?php bloginfo('template_directory'); ?>/img/gl-icon1.png" alt=""><p><?php _e('World class Respected Ship Owners','ds'); ?></p></div><div class="gl-guarantee-item wow flipInY" data-wow-duration="2s" data-wow-delay=".7s"><img src="<?php bloginfo('template_directory'); ?>/img/gl-icon2.png" alt=""><p><?php _e('Matching candidate’s goals','ds'); ?></p></div><div class="gl-guarantee-item wow flipInY" data-wow-duration="2s" data-wow-delay=".7s"><img src="<?php bloginfo('template_directory'); ?>/img/gl-icon3.png" alt=""><p><?php _e('Long-terms employment','ds'); ?></p></div><div class="gl-guarantee-item wow flipInY" data-wow-duration="2s" data-wow-delay=".7s"><img src="<?php bloginfo('template_directory'); ?>/img/gl-icon4.png" alt=""><p><?php _e('Support and Guidance','ds'); ?></p></div></div></div></div>

	<div class="gl-vacancies-wrap wraper-100"><div class="gl-vacancies-block wraper-1240">
		<h2 class="gl-vacancies-block-title title-before"><?php echo get_the_title( apply_filters( 'wpml_object_id', 10, 'page', TRUE  ) ); ?></h2>
		<div class="gl-jobs-wrap">
			<div class="gl-jobs-filter all-filter">
				<form action="#" method="POST" id="job-filter">
					<div class="all-filter-form-flex">
						<select class="select" name="posFF" id="posFF">
							<option value="" disabled><?php _e('All Position','ds'); ?></option><option value=""><?php _e('All Position','ds'); ?></option>
							<?php $field_key = "field_601603ec68cdf"; $field = get_field_object($field_key); foreach( $field['choices'] as $k => $v ){echo '<option value="' . $k . '">' . $v . '</option>';} ?>
						</select>
						<select class="select" name="vesFF" id="vesFF">
							<option value="" disabled><?php _e('All Vesel Type','ds'); ?></option><option value=""><?php _e('All Vesel Type','ds'); ?></option>
							<?php $field_key = "field_60160426d5ce5"; $field = get_field_object($field_key); foreach( $field['choices'] as $k => $v ){echo '<option value="' . $k . '">' . $v . '</option>';} ?>
						</select>
						<select class="select" name="natFF" id="natFF">
							<option value="" disabled><?php _e('All Nationality','ds'); ?></option><option value=""><?php _e('All Nationality','ds'); ?></option>
							<?php $field_key = "field_601621e58180e"; $field = get_field_object($field_key); foreach( $field['choices'] as $k => $v ){echo '<option value="' . $k . '">' . $v . '</option>';} ?>
						</select>
						<input type="hidden" name="action" value="job-filter">
					</div>
				</form>
			</div>
			<div class="gl-jobs-block wow fadeInUp" data-wow-duration="1.5s">
				<div class="gl-job-item-wrapp">

					<?php $temp = $wp_query; $wp_query= null; $wp_query = new WP_Query(); $wp_query->query('showposts=20' . '&paged='.$paged. '&category_name=vacancies' . '&orderby=menu_order' . '&order=ASC'); while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

						<div class="gl-job-item-block <?php the_field('va-pin') ?>"><div class="gl-job-item-inner"><div class="gl-job-item-leftside"><div class="gl-job-item-leftside-top"><h3 class="gl-job-item-title"><?php the_field('va-rank') ?></h3><p class="gl-job-item-type"><?php _e('Type of vessel','ds'); ?>: <?php the_field('va-vessel') ?></p><p class="gl-job-item-nat"><?php _e('Nationality','ds'); ?>: <?php the_field('va-nationality') ?></p></div><div class="gl-job-item-leftside-bottom"><div class="gl-job-item-price"><span><?php the_field('va-price') ?></span></div><div class="gl-job-item-word"><span><?php the_field('va-world') ?></span></div><div class="gl-job-item-time"><span><?php the_field('va-time') ?></span></div></div></div><div class="gl-job-item-rightside"><!--<div class="gl-job-item-data"><span><?php echo get_the_date('M. d, Y'); ?></span></div> --><div class="gl-job-item-buttons"><a href="javascript:void(0)" class="gl-job-item-button1 click-pop" data-title-sert="<?php the_title(); ?>"><span><?php _e('Apply now','ds'); ?></span></a><a href="<?php the_permalink(); ?>" class="gl-job-item-button2"><span><?php _e('Read more','ds'); ?></span></a></div></div></div></div>

					<?php endwhile; ?>

				</div>

				<?php if ($wp_query->max_num_pages > 1): ?>
					<div class="blog-pagination-tag"><div class="gl-job-item-buttons">
						<a id="pagin" href="javascript:void(0)" data-page-c="1" data-page-m="<?php echo $wp_query->max_num_pages; ?>" class="gl-job-item-button1" style="max-width: 170px; margin: auto"><span>More</span></a>
						<?php ?>
					</div></div>
				<?php endif; ?><?php wp_reset_query(); ?>
				
			</div>
		</div>
	</div></div>

	<?php include 'my-text.php';?>

	<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul><li><span><span>Marine MAN</span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

	<div class="click-pop" id="bg-popup"></div><div id="window"><?php echo do_shortcode('[contact-form-7 id="1776" title="Index Vacancy" html_id="feedback-form1" html_class="feedback-form placeholder_dark"]') ?></div>

</div>

<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/slick.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/wow.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery.scrollbar.min.js"></script>
<script>$('#fileFF').change(function(){if($('html:lang(en)').length){if($(this).val()!='')$(this).prev().text('CV Added');else $(this).prev().text('Attach CV')}else if($('html:lang(ru)').length){if($(this).val()!='')$(this).prev().text('CV Добавлено');else $(this).prev().text('Прикрепть CV')}else if($('html:lang(pl)').length){if($(this).val()!='')$(this).prev().text('CV Dodany');else $(this).prev().text('Dołączać CV')}});</script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>