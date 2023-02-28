<?php
/*
* Template Name: Eposters - Wordpress
*/
get_header();
$avatar = get_poster_avatar(); ?>
<div>
    <?= get_header_banner(get_the_ID()); ?>
</div>
<div class="st-p">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php the_content() ?>
            </div>
        </div>
    </div>
</div>
<?php
global $wp_query;

$args = array(
    'post_type'         => 'eposters',
    'posts_per_page'   => -1,
    'cat' => '',
    'offset'            => 0,
    'post_status'      => 'publish',
    'orderby'           => 'date', // for example'orderby' => 'name'
    'order'             => 'DESC', // ASC ascended , DESC descend
    'post__not_in' => array(get_the_ID()),
);
// query
$wp_query = new WP_Query($args);
if ($wp_query->have_posts()) { ?>
    <style>
        .ratio-vertical {
            --bs-aspect-ratio: 115%;
        }

        .ratio {
            position: relative;
            width: 100%;
        }

        .ratio::before {
            display: block;
            padding-top: var(--bs-aspect-ratio);
            content: "";
        }

        .ratio>* {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <div class="st-p">
        <div class="container-fluid">
            <div class="row">
                <?php
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
                    $image = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $avatar; ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-20 pb-3" id="speaker">
                        <!-- Button trigger modal -->
                        <a class="d-block" href="<?php the_permalink() ?>">
                            <div class="ratio ratio-vertical" style="margin: 0 auto;">
                                <img src="<?= $image ?>" style="box-shadow: 4px 4px 10px #0000001A;object-fit: cover;" class="d-block mx-auto">
                            </div>
                            <div>
                                <div class="pt-3 text-center">
                                    <b>
                                        <h5><?php the_title() ?></h5>
                                    </b>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }; //while
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
<?php
} //if
get_footer();
