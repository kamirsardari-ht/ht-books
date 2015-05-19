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

	<!-- Content Section -->
    <div class="container">
      <div class="row">
        <div class="bar"></div>
    <?php
        $downloads=array();
      $download_args = array(
      'post_status' => array('publish'),
      'post_type' => 'download',
      'download_category' => 'pdf',
      'posts_per_page' => -1
       );
       $downloadPosts = new WP_Query($download_args);
       while($downloadPosts->have_posts()) : $downloadPosts->the_post();    
          $Id=$post->ID;
          $downloads[]=$Id; ?>
          <?php $BookID=get_the_ID();
           //$BookID=(($BookId+5)*2)+14; ?>
        <div class="card-12">
            <div class="col-md-3 npl">
               <?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $BookID ) ) : ?>
					<div class="edd_download_image">
            <?php $new_feature_image = wp_get_attachment_url( get_post_thumbnail_id($BookID) );?>
						<a href="<?php echo add_query_arg( 'BookId',$BookID , get_permalink(40));?>" title="<?php the_title_attribute(); ?>">
							<?php //echo get_the_post_thumbnail( get_the_ID(), 'thumbnail'); ?>
              <img src="<?php echo $new_feature_image;?>" width='300' height='auto'>
						</a>
					</div>
				<?php endif; ?>
            </div>
            <div class="col-md-9">
              <span class='tag'>subhead</span>
              <p><?php echo get_field( "book_published_date", $BookId );?></p>
              <p>
          		<div itemprop="description" class="edd_download_full_content">
  							<?php echo apply_filters( 'edd_downloads_content', get_post_field( 'post_content', get_the_ID() ) ); ?>
  						</div>
              </p>
              <div class="col-md-5 npl">
                <!--button class="download"-->
                	<!--div class="edd_download_buy_button">
						           <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
					          </div-->
                <!--/button-->
              
              <a  class="download" href="<?php echo add_query_arg( 'BookId',$BookID, get_permalink(40));?>">More Info</a>
              </div>
            </div>
      </div>
      <div class="bar"></div>
		<?php endwhile; ?>
		  </div>
	</div>
<?php get_footer(); ?>
