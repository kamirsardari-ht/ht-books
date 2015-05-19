<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( 8 ) ) : ?>
			<div class="edd_download_image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
				</a>
			</div>
			<?php endif; ?>
			<div itemprop="description" class="edd_download_full_content">
				<?php echo apply_filters( 'edd_downloads_content', get_post_field( 'post_content', 8 ) ); ?>
			</div>

			<!--h3 itemprop="name" class="edd_download_title">
				<a title="<?php the_title_attribute(); ?>" itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3-->

			<?php if ( ! edd_has_variable_prices( 8 ) ) : ?>
				<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					<div itemprop="price" class="edd_price">
						<?php edd_price( 8 ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="edd_download_buy_button">
				<?php echo edd_get_purchase_link( array( 'download_id' => 8 ) ); ?>
			</div>

		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
