<?php
/*
* Template Name: Speakers - Wordpress
*/
get_header(); ?>
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
    'post_type'         => 'speakers', //it does accept Custom Types
    'offset'            => 0,
    'post_status'      => 'publish',
    //'cat'              => '1', // id of the category
);
// query
$wp_query = new WP_Query($args);
if ($wp_query->have_posts()) {

    $avatar = get_template_directory_uri() . "/img/avatar-placeholder2.png";
?>
    <style>
        .ratio-1x1 {
            --bs-aspect-ratio: 100%;
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
                    $image = get_the_post_thumbnail_url() ?? $avatar; ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-20 pb-3" id="speaker">
                        <!-- Button trigger modal -->
                        <a class="d-block" data-toggle="modal" data-target="#speaker-<?php the_ID() ?>">
                            <div class="ratio ratio-1x1" style="margin: 0 auto;">
                                <img style="box-shadow: 4px 4px 10px #0000001A;object-fit: cover;" class="d-block mx-auto rounded-circle" src="<?= $image ?>" alt="#speaker-<?php the_ID() ?>">
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
                    <!-- Modal -->
                    <div class="modal fade" id="speaker-<?php the_ID() ?>" tabindex="-1" role="dialog" aria-labelledby="speaker-<?php the_ID() ?>Title" aria-hidden="true">
                        <div class="modal-dialog align-self-center bg-white px-5 py-lg-5" role="document">
                            <div class="row text-center position-relative">
                                <div class="col-12">
                                    <div class="ratio ratio-1x1 w-50" style="margin: 0 auto;">
                                        <img style="box-shadow: 4px 4px 10px #0000001A;object-fit: cover;" class="d-block mx-auto rounded-circle" src="<?= $image ?>" alt="#speaker-<?php the_ID() ?>">
                                    </div>
                                </div>
                                <div class="col-12 pt-3 pb-1 dcolor_1_color">
                                    <b>
                                        <h4 style="font-family: lato-bold; margin-bottom: 0;"><?php the_title() ?></h4>
                                    </b>
                                </div>
                                <div class="col-12" style="font-family: lato-italic; color: #848484">
                                    <div> Job title </div>
                                    <div> Company / organization </div>
                                </div>
                                <div class="col-12 pt-3">
                                    <div class="text-left"> <?php the_content() ?> </div>
                                </div>
                            </div>

                            <button type="button" class="close position-absolute dcolor_1_color" data-dismiss="modal" aria-label="Close" style="right: 1rem; top: 0.5rem;">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
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
