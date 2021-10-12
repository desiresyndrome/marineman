<?php get_header(); ?>
<?php $queried_object = get_queried_object(); ?>

<div class="wrapper">

	<?php include 'head.php';?><?php include 'top-slider.php';?>

	<div class="header-title-wrap vawe-top wraper-100"><h2 class="header-title"><?php the_field('pb-title', $queried_object) ?></h2></div>

	<div class="all-ships-main-wrap wraper-100"><div class="all-ships-main-block wraper-1240"><h2 class="all-ships-main-title title-before"><?php single_cat_title(); ?></h2>
		<div class="all-ships-wrap">
			<div class="all-filter all-ships-filter"><form action="#" method="POST" id="ships-filter">
					<select class="select" name="typeFF">
						<option value="<?php _e('All type','ds'); ?>" disabled><?php _e('All type','ds'); ?></option><option value="<?php _e('All type','ds'); ?>"><?php _e('All type','ds'); ?></option>
						<?php $field_key = "field_6015936148448"; $field = get_field_object($field_key); foreach( $field['choices'] as $k => $v ){echo '<option value="' . $k . '">' . $v . '</option>';} ?>
					</select>
					<input type="hidden" name="action" value="ships-filter">
				</form></div>
			<div class="one-ships-what"><div class="one-ships-what-item"><h3><?php _e('Vessel Name','ds'); ?></h3></div><div class="one-ships-what-item"><h3><?php _e('Vessel Type','ds'); ?></h3></div><div class="one-ships-what-item"><h3><?php _e('IMO','ds'); ?></h3></div><div class="one-ships-what-item"><h3><?php _e('Read More','ds'); ?></h3></div></div>
			<div class="all-ships-block">
				<div class="all-ships-block-wrapp">

					<?php $args = array('post_status' => 'publish','posts_per_page' => 40,'post_type' => 'post','category_name' => 'ships','orderby' => 'menu_order','order' => 'ASC'); $wp_query = new WP_Query($args); ?>
					<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

						<div class="one-ship"><div class="one-ship-item"><p><?php the_field('s-name') ?></p></div><div class="one-ship-item"><p><?php the_field('s-vessel-type') ?></p></div><div class="one-ship-item"><p><?php the_field('s-imo') ?></p></div><div class="one-ship-item"><a href="<?php the_permalink(); ?>"><span><?php _e('View','ds'); ?></span></a></div></div>

					<?php endwhile; ?><?php else: ?><?php endif; ?>

				</div>

				<?php if ($wp_query->max_num_pages > 1): ?>
					<div class="blog-pagination-tag"><div class="gl-job-item-buttons">
						<a id="pagin-s" href="javascript:void(0)" data-page-c="1" data-page-m="<?php echo $wp_query->max_num_pages; ?>" class="gl-job-item-button1" style="max-width: 170px; margin: auto"><span>More</span></a>
						<?php ?>
					</div></div>
				<?php endif; ?><?php wp_reset_query(); ?>

			</div>
		</div>
	</div></div>

	<?php include 'my-text.php';?>

</main>

<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li><li><span><span><?php single_cat_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

</div>

<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/slick.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery.scrollbar.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>