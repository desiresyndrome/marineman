<?php
/*
Template Name: Contacts
*/
?>
<?php get_header(); ?>

<div class="wrapper">

	<?php include 'head.php';?>

	<div class="gmap-wrap wraper-100"><iframe id="map" style="border: 0;" src="https://jobmarineman.com/wp-content/uploads/map-all-office.html" width="100%" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>

	<div class="header-title-wrap vawe-top wraper-100"><h2 class="header-title"><?php the_title(); ?></h2></div>

	<div class="contacts-wrap wraper-100"><div class="contacts-block wraper-1240">
		<h2 class="contacts-title"><?php _e('Our offices','ds'); ?></h2>
		<div class="contacts-inner"><div class="contacts-flex">
			<?php if(get_field('cs-top')): ?>
				<?php while(the_repeater_field('cs-top')): ?>
					<div class="contacts-item contacts-item-before">
						<h2 class="contacts-item-title"><?php the_sub_field('cs-top-title'); ?></h2>
						<h3 class="contacts-item-firma"><?php the_sub_field('cs-top-firm'); ?></h3>
						<p class="contacts-item-adres"><b>&bull; <?php _e('A :','ds'); ?></b> <?php the_sub_field('cs-top-adress'); ?></p>
						<?php if(get_sub_field('cs-top-bottom')): ?>
							<div class="contacts-item-info">
								<?php while(the_repeater_field('cs-top-bottom')): ?>
									<p><?php the_sub_field('cs-top-bottom-text'); ?></p>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div></div>
		<?php if(get_field('cs-bot')): ?>
			<?php while(the_repeater_field('cs-bot')): ?>
				<div class="contacts-inner">
					<h3 class="contacts-flex-title"><?php the_sub_field('cs-bot-title'); ?></h3>
					<div class="contacts-flex contacts-flex-change">
					<?php if(get_sub_field('cs-bot-item')): ?>
			<?php while(the_repeater_field('cs-bot-item')): ?>
						<div class="contacts-item">
							<?php if ( get_sub_field('cs-bot-item-title') ) {?>
							<p class="contacts-item-country"><?php the_sub_field('cs-bot-item-title') ?></p>
							<?php } else { ?>
								<?php } ?>
							<div class="contacts-item-info contacts-item-info-change"><p><b>&bull; <?php _e('E :','ds'); ?></b> <a href="<?php the_sub_field('cs-bot-item-e') ?>"><?php the_sub_field('cs-bot-item-e') ?></a></p><p><b>&bull; <?php _e('P :','ds'); ?></b> <a href="<?php the_sub_field('cs-bot-item-p') ?>"><?php the_sub_field('cs-bot-item-p') ?></a></p></div>
						</div>
							<?php endwhile; ?>
		<?php endif; ?>
					</div>
				</div>
				<?php endwhile; ?>
		<?php endif; ?>
	</div></div>

	<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li><li><span><span><?php the_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

</div>

<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

<?php wp_footer(); ?>
</body>
</html>