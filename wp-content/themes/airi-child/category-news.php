<style>
  .news-main-wrap {
    margin-bottom: 100px;
  }
  .news-header, .news-info {
    font-family: "Raleway",sans-serif;
    color: #000;
    margin-bottom: 20px;
  }
  .news-header p {
     font-weight: 600;
     font-size: 16px;
  }
  .news-title, .news-info p {
    margin-bottom: 0;
  }
  .news-info p {
    font-weight: 600;
    font-size: 13px;
    line-height: 1.3;
  }
  .news-info {
    padding: 15px 25px 5px;
  }
  .news-info h3 {
    margin: 0 0 5px;
  }
  .news-post-wrap {
    border: 2px solid grey;
    outline: 5px solid #fed2c7;
  }
  @media (max-width: 991px) and (min-width: 768px) {
    .news-mb-col {
        width: 33.33333%;
        float: left;
    }
  }
  @media (max-width: 767px) {
    .news-post-wrap {
      width: auto;
      max-width: 500px;
      margin: auto;
      margin-bottom: 35px;
    }
  }

</style>
<?php
/**
* News Category Template
*/

get_header(); ?>

<section id="primary" class="site-content container news-main-wrap">
  <div id="content" role="main">

  <?php
  // Check if there are any posts to display
  if ( have_posts() ) : ?>

  <header class="news-header text-center">
    <h2 class="news-title"><em>News & Events</em></h2>
    <p>Follow the latest news from the Maison and see all the stars dressed in <b><em>MUKTA</em></b> from the past events</p>
  </header>

  <div class="row">
    <?php
    // The Loop
    while ( have_posts() ) : the_post(); ?>
    <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
    <div class="col-md-4 news-mb-col">
      <div class="news-post-wrap">
        <a href="<?php the_permalink() ?>" rel="bookmark"
        title="Permanent Link to <?php the_title_attribute(); ?>">
          <img src="<?php echo $url ?>" />
        </a>
        <div class="news-info text-center">
          <h3><em><?php the_title();?></em></h3>
          <p><?php the_excerpt();?></p>
        </div>
      </div>
    </div>
    <?php endwhile;

    else: ?>
    <p>Sorry, no posts matched your criteria.</p>
  </div>
  <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
