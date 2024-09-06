<?php
get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg') ?>)"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re
            interested in?</h3>
        <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
</div>

<?php
$homepageEvents = new WP_Query(array(
    'posts_per_page' => 2,
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'event_date',
            'compare' => '>=',
            'type' => 'DATE' // Sử dụng kiểu DATE
        )
    )
));
?>

<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
            <?php
            while ($homepageEvents->have_posts()) {
                $homepageEvents->the_post();
                $eventDate = get_post_meta(get_the_ID(), 'event_date', true); // Lấy ngày sự kiện
            ?>
                <div class="event-summary">
                <?php echo date("d/m/Y", strtotime($eventDate)); ?>
                    <a class="event-summary__date t-center">
                        <span class="event-summary__month"><?php echo date("M", strtotime($eventDate)); ?></span>
                        <span class="event-summary__day"><?php echo date("d", strtotime($eventDate)); ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h5>
                        <p><?php echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php echo esc_url(get_the_permalink()); ?>" class="nu gray">Learn more</a></p>
                    </div>
                </div>
            <?php }
            wp_reset_postdata();
            ?>
            <p class="t-center no-margin"><a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>" class="btn btn--blue">View All Events</a></p>
        </div>
    </div>

    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

            <?php
            $homepageBlogs = new WP_Query(array(
                'posts_per_page' => 2,
                'post_type' => 'post',
            ));

            if ($homepageBlogs->have_posts()) {
                while ($homepageBlogs->have_posts()) {
                    $homepageBlogs->the_post(); ?>
                    <div class="event-summary">
                        <a class="event-summary__date event-summary__date--beige t-center">
                            <span class="event-summary__month"><?php the_time("M"); ?></span>
                            <span class="event-summary__day"><?php the_time("d"); ?></span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 18); ?> <a href="<?php echo esc_url(get_the_permalink()); ?>" class="nu gray">Read more</a></p>
                        </div>
                    </div>
            <?php }
            } else {
                echo '<p>No blog posts found.</p>';
            }
            wp_reset_postdata();
            ?>

            <p class="t-center no-margin"><a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
    </div>

</div>

<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <?php
            $sliderPosts = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'slide'
            ));

            if ($sliderPosts->have_posts()) {
                while ($sliderPosts->have_posts()) {
                    $sliderPosts->the_post();
                    $backgroundImage = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
                    <div class="hero-slider__slide" style="background-image: url(<?php echo esc_url($backgroundImage); ?>)">
                        <div class="hero-slider__interior container">
                            <div class="hero-slider__overlay">
                                <h2 class="headline headline--medium t-center"><?php the_title(); ?></h2>
                                <p class="t-center"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                <p class="t-center no-margin"><a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn--blue">Learn more</a></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p>No slides found.</p>';
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>


<?php get_footer(); ?>