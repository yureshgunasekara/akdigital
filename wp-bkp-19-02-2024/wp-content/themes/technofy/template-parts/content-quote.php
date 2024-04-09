<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technofy
 */
$technofyTag = Technofy_Function('Tags');
$technofyFunc = Technofy_Function('Functions');
$technofy_tg = Technofy_Function('Tags');

if( is_single() ): ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-details-inner">
		<div class="blog-details-content">	
			
			<div class="blog-item-info">
				<ul class="post-meta">
					<li class="post-author"><?php $technofy_tg->posted_by(); ?></li>
					<li class="post-date"><?php $technofy_tg->posted_on(); ?></li>
				</ul>
			</div>

			<div class="st-blog-content-detils">
				<?php the_content(); ?>
			 </div>

			 <?php 
			 if( has_tag() ) : ?>
				<div class="blog-details_bottom">
					<?php $technofy_tg->tags(); ?>
				</div>
			<?php 
			endif; ?>
		</div>
	</div>
		
</article><!-- #post-<?php the_ID(); ?> -->

<?php 
else: ?>
<div class="single-blog-wrap">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="blog-item">
			<div class="blog-details">
				<?php 
				if( ! empty( $post->post_title ) ) : ?>
        			<h5 class="blog-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php 
				endif; ?>

				<span><i class="fa fa-user"></i><?php $technofyTag->posted_by(); ?></span>
                <span><i class="fa fa-clock-o"></i><?php $technofyTag->posted_on(); ?></span>
                <?php the_content(); ?>
			</div>
		</div>
	</article>
</div>

<?php endif; ?>



