<?php
/*
Template Name: Service All
*/
?>
<?php get_header(); ?>

<div class="wrapper">

	<?php include 'head.php';?><div class="header-padding"></div>	

	<main class="content">

		<div class="service-all-wrap wraper-100"><div class="service-all-block wraper-1240"><h1 class="service-all-block-title"><?php the_title(); ?></h1><div class="service-all-flex">
			<?php 
			$stati_children = new WP_Query(array('post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC', 'post_parent' => get_the_ID()));
		if($stati_children->have_posts()) : while($stati_children->have_posts()): $stati_children->the_post();?>
			<div class="service-all-item"><div class="service-all-item-inner"><div class="service-all-item-inner-block"><h2 class="service-all-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><div class="service-all-item-text"><p><?php the_field('se-exc', $queried_object); ?></p></div></div><a href="<?php the_permalink(); ?>" class="service-all-item-more"><span><?php _e('Read more','ds'); ?></span></a></div></div>
		<?php endwhile; ?><?php else: ?><?php endif; ?><?php wp_reset_query(); ?>
	</div></div></div>

</main>

<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li><li><span><span><?php the_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

</div>

<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>