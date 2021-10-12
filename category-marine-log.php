<?php get_header(); ?>
<?php $queried_object = get_queried_object(); ?>
	
	<div class="wrapper">

	<?php include 'head.php';?><div class="header-padding"></div>	

		<main class="content">

			<div class="all-news-wrap wraper-100"><div class="all-news-block wraper-1240"><h1 class="all-news-title"><?php single_cat_title(); ?></h1>
				<div class="all-news-flex">

							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div class="news-item"><div class="news-item-img"><a href="<?php the_permalink(); ?>" class="my-cover" style="background-image: url(<?php if ( has_post_thumbnail()) {$full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium'); echo ''.$full_image_url[0] . '';} ?>)"></a></div><div class="news-item-inner"><div class="news-item-inner-block"><div class="news-item-data"><span><?php echo get_the_date('d.m.Y'); ?></span></div><h3 class="news-item-title"><?php the_title(); ?></h3><div class="news-item-text"><?php the_excerpt(); ?></div><div class="news-item-link"><a href="<?php the_permalink(); ?>"><?php _e('Read more','ds'); ?></a></div></div></div></div>

 					<?php endwhile; ?><?php else: ?><?php endif; ?>
 					
				</div>
			</div></div>

					<div class="navigathion wraper-1240"><?php wp_pagenavi(); ?></div>
				
		</main>

		<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li><li><span><span><?php single_cat_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

	</div>
 
	<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/masonry.pkgd.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>