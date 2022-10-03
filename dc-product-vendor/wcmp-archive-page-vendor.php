<?php
defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: wcmp_before_main_content.
 *
 */

do_action('wcmp_before_main_content');



global $WCMp;
$vendor_id = wcmp_find_shop_page_vendor();  //5
$vendor = get_wcmp_vendor($vendor_id);
$display_name = $vendor->user_data->first_name;

[
    '_vendor_image' => $vendor_img_id,
    '_vendor_exp' => $vendor_exp,
    '_vendor_jobtitle' => $vendor_jobtitle,
    '_vendor_school' => $vendor_school,
    '_vendor_phone' => $vendor_phone,
    '_vendor_fb_profile' => $fb_link,
    '_vendor_twitter_profile' => $twitter_link,
    '_vendor_linkdin_profile' => $linkedin_link,
    '_vendor_youtube' => $yt_link,
    '_vendor_instagram' => $ig_link,
    '_vendor_country_code' => $vendor_country_code,
    '_vendor_country' => $vendor_country,
    // '_vendor_state' => $vendor_state,
    // '_vendor_city' => $vendor_city,
    '_vendor_address_1' => $vendor_address_1,
    // '_vendor_address_2' => $vendor_address_2,
    '_vendor_other' => $vendor_other,
    '_vendor_charge'  => $vendor_charge,
] = get_user_meta($vendor_id);

$vendor_img_url = wp_get_attachment_image_url($vendor_img_id[0], 'full', true) ?: $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
$address = $vendor_country[0] . $vendor_address_1[0];

$vendor_email = $vendor->user_data->user_email;

// echo '<pre>';
//var_dump($vendor->user_data->user_email);
//var_dump(get_user_meta($vendor_id));
// echo '</pre>';

//var_dump($vendor);
/* $vendor = get_wcmp_vendor($vendor_id);
    if( $vendor ){
        $image = $vendor->get_image() ? $vendor->get_image() : $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
        $description = $vendor->description;

        $address = $vendor->get_formatted_address();

        $WCMp->template->get_template('archive_vendor_info.php', array('vendor_id' => $vendor->id, 'banner' => $vendor->get_image('banner'), 'profile' => $image, 'description' => apply_filters('the_content', $description), 'mobile' => $vendor->phone, 'location' => $address, 'email' => $vendor->user_data->user_email));
    } */


?>
<style>
    .shop-page-title.category-page-title.page-title {
        display: none;
    }

    .row {
        max-width: unset;
    }

    .vendor_content i {
        color: #fff;
        width: 36px;
        height: 36px;
        background-color: #fafafa;
        border-radius: 100%;
        margin: 0rem 0.5rem;
        line-height: 36px;
    }

    .avatarVendor {
        width: 300px;
        height: 300px;
        border-radius: 100%;
        object-fit: cover;
    }

    .title_line {
        position: relative;
    }

    .title_line::after {
        content: '';
        height: 1px;
        width: 100%;
        background-color: #ccc;
        display: block;
        position: absolute;
        top: calc(50% + 1px);
        left: 0px;
        z-index: 1;
    }

    .title_line h2 {
        background-color: #fff;
        display: inline;
        z-index: 2;
        position: relative;
        padding: 0px 2rem;
    }

    .portfolio article img {
        aspect-ratio: 1/1;
        width: 100%;
        object-fit: cover;
    }

    .accordionVendor .accordion-title {
        text-decoration: unset;
        border-color: #444;
    }

    .accordionVendor .accordion-item {
        border: none;
    }

    .accordionVendor .accordion-title.active,
    .accordionVendor .accordion-title.active .icon-angle-down,
    .accordionVendor .accordion-title.active span,
    .portfolio article a,
    .portfolio article a h5 {
        color: #f17272;
    }

    .accordionVendor .accordion-title.active {
        border-color: #f17272;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .fw-bold {
        font-weight: bold;
    }
</style>


<section>
    <div class="container" style="padding-top:3rem">
        <div class="row">
            <div class="col medium-6 small-12 large-5 text-center flex-column ">
                <img src="<?= $vendor_img_url ?>" class="avatarVendor">
                <h5 class=" mt-3"><?= $display_name ?></h5>
                <p class=""><?= $vendor_jobtitle[0] ?></p>
            </div>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');

                .vendor_page_title {
                    font-family: 'Dancing Script', cursive !important;
                    font-size: 2.5rem;
                    color: #d31a82;
                    font-weight: 700;
                }
            </style>
            <div class="col medium-6 small-12 large-7 text-center vendor_content">
                <p class="vendor_page_title"><?= $vendor->page_title ?></p>

                <p><?= !empty($vendor_school[0]) ? ('畢業學校：' . $vendor_school[0]) : '' ?></p>
                <p><?= !empty($vendor_exp[0]) ? ('入行年份：' . $vendor_exp[0]) : '' ?></p>
                <p><?= !empty($vendor_phone[0]) ? ('Tel：' . $vendor_phone[0]) : '' ?></p>
                <p><?= !empty($address) ? ('Address：' . $address) : '' ?></p>
                <p><?= !empty($vendor_email) ? ('Email：<a href="mailto:' . $vendor_email . '" target="_blank">' . $vendor_email) . '</a>' : '' ?></p>


                <?= wpautop($vendor->description) ?>



                <div class="mt-3">
                    <?php if (!empty($fb_link[0])) : ?>
                        <a href="<?= $fb_link[0] ?>" target="_blank"><i class="icon-facebook" style="background-color:#1877f2"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($twitter_link[0])) : ?>
                        <a href="<?= $twitter_link[0] ?>" target="_blank"><i class="icon-twitter" style="background-color:#1da1f2"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($linkedin_link[0])) : ?>
                        <a href="<?= $linkedin_link[0] ?>" target="_blank"><i class="icon-linkedin" style="background-color:#0077b5"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($yt_link[0])) : ?>
                        <a href="<?= $yt_link[0] ?>" target="_blank"><i class="icon-youtube" style="background-color:#ff0000"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($ig_link[0])) : ?>
                        <a href="<?= $ig_link[0] ?>" target="_blank"><i class="icon-instagram" style="background-color:#c13584"></i></a>
                    <?php endif; ?>
                </div>

                <div style="margin-top:2.5rem">
                    <hr style="width:3rem;display: inline-block;" />
                    <p>為了保障雙方利益，麻煩講聲係 MUA 網站問到我</p>
                </div>



            </div>

        </div>
    </div>
</section>

<section>
    <div class="container" style="margin-top:8rem">
        <div class="row">
            <div class="title_line text-center">
                <h2 class="fw-bold">我的作品集</h2>
            </div>
        </div>

        <div class="row portfolio" style="margin-top:3rem">
            <?php
            $args = array(
                'posts_per_page' => -1,
                'author' => $vendor_id,
                'post_type' => 'product',
                'post_status' => 'publish',
            );
            $get_vendor_products = get_posts($args);
            foreach ($get_vendor_products as $product) :

            ?>
                <div class="col medium-6 small-6 large-3">
                    <article id="product-<?= $product->ID ?>">
                        <a href="<?= get_the_permalink($product->ID); ?>"><img src="<?= get_the_post_thumbnail_url($product->ID, 'full') ?>"></a>
                        <a href="<?= get_the_permalink($product->ID); ?>">
                            <h5><?= get_the_title($product->ID); ?></h5>
                        </a>
                        <a href="<?= trailingslashit(get_home_url() . '/vendor/' . $vendor->page_slug) ?>">
                            <p>查看 <?= $display_name ?></p>
                        </a>
                    </article>
                </div>

            <?php endforeach; ?>

        </div>
    </div>

</section>


<section>
    <div class="container" style="margin-top:6rem">
        <div class="accordion accordionVendor" rel="">

            <?php if (!empty($vendor_charge[0])) : ?>
                <div class="accordion-item"><a href="#" class="accordion-title plain"><button class="toggle"><i class="icon-angle-down"></i></button><span>服務收費</span></a>
                    <div class="accordion-inner">
                        <?= wpautop($vendor_charge[0]); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($vendor_other[0])) : ?>
                <div class="accordion-item"><a href="#" class="accordion-title plain"><button class="toggle"><i class="icon-angle-down"></i></button><span>其他詳情</span></a>
                    <div class="accordion-inner">
                        <?= wpautop($vendor_other[0]); ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>


<?php

/**
 * Hook: wcmp_store_tab_contents.
 *
 * Output wcmp store widget
 */

//do_action('wcmp_store_tab_widget_contents');


/**
 * Hook: wcmp_after_main_content.
 *
 */
do_action('wcmp_after_main_content');

/**
 * Hook: wcmp_sidebar.
 *
 */
// deprecated since version 3.0.0 with no alternative available
// do_action( 'wcmp_sidebar' );


get_footer('shop');
