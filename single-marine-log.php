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

		<div class="single-title-block wraper-1140"><h1 class="single-title"><?php the_title(); ?></h1></div>

		<div class="single-text-block wraper-1140"><div class="single-text">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?><?php else: ?><?php endif; ?>
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