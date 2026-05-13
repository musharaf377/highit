<?php

/**
 * Theme Footer Widget Template
 * @package highit
 * @since 1.0.0
 */
// Get all footer options
$footer_logo = cs_get_option('footer_one_logo');
$footer_short_description = cs_get_option('footer_short_description');
$footer_menu_column_title = cs_get_option('footer_menu_column_title');
$footer_menu = cs_get_option('footer_menu');
$footer_contact_title = cs_get_option('footer_contact_column_title');
$footer_contact_phone = cs_get_option('footer_contact_phone_number');
$footer_contact_email = cs_get_option('footer_contact_email');
$footer_contact_location = cs_get_option('footer_contact_location');
$footer_download_text = cs_get_option('footer_download_resume_enable');
$footer_download_link = cs_get_option('footer_download_resume_link');
$footer_social_icons = cs_get_option('footer_social_repeater');
$copyright_text = cs_get_option('copyright_text');
$footer_bottom_menu = cs_get_option('footer_bottom_menu');

// Set default copyright text if not provided
if (empty($copyright_text)) {
    $copyright_text = esc_html__('© 2025 highit | All right reserved ', 'highit') . '<a href="' . esc_url('https://highit.agency') . '">' . esc_html__('Highit', 'highit') . '</a>';
}

// Replace placeholders in copyright text
$copyright_text = str_replace('{copy}', '&copy;', $copyright_text);
$copyright_text = str_replace('{year}', date('Y'), $copyright_text);
?>
<div class="footer-section">
    <div class="custom-container container">
        <div class="footer-top-area">
            <div class="footer-top-left">
                <div class="footer-logo">
                    <?php
                    if (has_custom_logo() && empty($footer_logo['id'])) {
                        the_custom_logo();
                    } elseif (!empty($footer_logo['id'])) {
                        printf('<a class="site-logo" href="%1$s"><img src="%2$s" alt="%3$s"/></a>', esc_url(get_home_url()), esc_url($footer_logo['url']), esc_attr($footer_logo['alt']));
                    } else {
                        printf('<a class="site-title" href="%1$s">%2$s</a>', esc_url(get_home_url()), esc_html(get_bloginfo('title')));
                    }
                    ?>
                </div>
                <?php if (!empty($footer_short_description)) : ?>
                    <div class="footer-description">
                        <?php echo wp_kses_post($footer_short_description); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="footer-top-right">
                <div class="widget_nav_menu">
                    <div class="footer-menu-wrap">
                        <h4 class="footer-column-title"><?php echo esc_html($footer_menu_column_title); ?></h4>
                        <ul class="footer-list">
                            <?php
                            if (!empty($footer_menu)) :
                                foreach ($footer_menu as $menu) :
                                    echo '<li><a href="' . esc_url($menu['footer_menu_item_url']) . '">' . esc_html($menu['footer_menu_item_title']) . '</a></li>';
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="footer-contact-info">
                    <h4 class="footer-column-title"><?php echo esc_html($footer_contact_title); ?></h4>
                    <div class="footer-contact-info-list">
                        <?php if (!empty($footer_contact_phone)) : ?>
                            <p class="contact-phone"><a href="tel:<?php echo esc_attr($footer_contact_phone); ?>"><?php echo esc_html($footer_contact_phone); ?></a></p>
                        <?php endif; ?>
                        <?php if (!empty($footer_contact_email)) : ?>
                            <p class="contact-email"><a href="mailto:<?php echo esc_attr($footer_contact_email); ?>"><?php echo esc_html($footer_contact_email); ?></a></p>
                        <?php endif; ?>
                        <?php if (!empty($footer_contact_location)) : ?>
                            <p class="contact-location"><?php echo esc_html($footer_contact_location); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>



        <div class="footer-middle-area">
            <?php if (!empty($footer_download_text) && !empty($footer_download_link)) : ?>
                <div class="download-resume">
                    <a href="<?php echo esc_url($footer_download_link); ?>" class="download-resume-link">
                        <?php echo esc_html($footer_download_text); ?><?php echo highit_get_svg_icon('download_arrow'); ?>
                    </a>
                </div>
            <?php endif; ?>

            <ul class="footer-social-share">
                <?php
                if (!empty($footer_social_icons)) :
                    foreach ($footer_social_icons as $icon) :
                ?>
                        <li class="single-info-item">
                            <a href="<?php echo esc_url($icon['footer_social_icon_item_url']); ?>">
                                <img src="<?php echo esc_url($icon['footer_social_icon_item_icon']['url']); ?>" alt="<?php echo esc_attr($icon['footer_social_icon_item_icon']['alt']); ?>" />
                            </a>
                        </li>
                <?php
                    endforeach;
                endif;
                ?>
            </ul>
        </div>

        <div class="footer-bottom-menu">
            <div class="menu-about-menu-container">
                <div class="copyright-text">
                    <?php echo wp_kses($copyright_text, highit()->kses_allowed_html(array('a'))); ?>
                </div>

                <ul class="footer-bottom-menu-list">
                    <?php
                    if (!empty($footer_bottom_menu)) :
                        foreach ($footer_bottom_menu as $menu) :
                    ?>
                            <li>
                                <a href="<?php echo esc_url($menu['footer_bottom_menu_item_url']); ?>">
                                    <?php echo esc_html($menu['footer_bottom_menu_item_title']); ?>
                                </a>
                            </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>