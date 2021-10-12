<?php get_header(); ?>
<?php $queried_object = get_queried_object(); ?>

<div class="wrapper">

	<?php include 'head.php';?><div class="header-padding"></div>	

		<main class="content">

			<div class="gl-vacancies-wrap gl-vacancies-change wraper-100"><div class="gl-vacancies-block wraper-1240"><h2 class="vacancies-block-title"><?php the_field('pb-title', $queried_object) ?></h2>
				<div class="gl-jobs-wrap"><div class="gl-jobs-block">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="gl-job-item-block"><div class="gl-job-item-inner"><div class="gl-job-item-leftside"><div class="gl-job-item-leftside-top"><h3 class="gl-job-item-title"><?php the_field('va-rank') ?></h3><p class="gl-job-item-type"><?php _e('Type of vessel','ds'); ?>: <?php the_field('va-vessel') ?></p><p class="gl-job-item-nat"><?php _e('Nationality','ds'); ?>: <?php the_field('va-nationality') ?></p></div><div class="gl-job-item-leftside-bottom"><div class="gl-job-item-price"><span><?php the_field('va-price') ?></span></div><div class="gl-job-item-word"><span><?php the_field('va-world') ?></span></div><div class="gl-job-item-time"><span><?php the_field('va-time') ?></span></div></div></div><div class="gl-job-item-rightside"><!-- <div class="gl-job-item-data"><span><?php echo get_the_date('M. d, Y'); ?></span></div> --><div class="gl-job-item-buttons"><a href="javascript:void(0)" class="gl-job-item-button1 click-pop" data-title-sert="<?php the_title(); ?>"><span><?php _e('Apply now','ds'); ?></span></a><a href="<?php the_permalink(); ?>" class="gl-job-item-button2"><span><?php _e('Read more','ds'); ?></span></a></div></div></div></div>

 					<?php endwhile; ?><?php else: ?><?php endif; ?>
 					
					</div></div>
			</div></div>

								<div class="navigathion wraper-1240"><?php wp_pagenavi();  ?></div>
 
		<?php include 'my-text.php';?>

		</main>

	<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li><li><span><span><?php single_cat_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

	<div class="click-pop" id="bg-popup"></div><div id="window"><?php echo do_shortcode('[contact-form-7 id="1776" title="Index Vacancy" html_id="feedback-form1" html_class="feedback-form placeholder_dark"]') ?></div>

	</div>
 
	<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/wow.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery.scrollbar.min.js"></script>
<script>$('#fileFF').change(function(){if($('html:lang(en)').length){if($(this).val()!='')$(this).prev().text('CV Added');else $(this).prev().text('Attach CV')}else if($('html:lang(ru)').length){if($(this).val()!='')$(this).prev().text('CV Добавлено');else $(this).prev().text('Прикрепть CV')}else if($('html:lang(pl)').length){if($(this).val()!='')$(this).prev().text('CV Dodany');else $(this).prev().text('Dołączać CV')}});</script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>