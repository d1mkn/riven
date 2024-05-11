<?php
/*Allow .svg in Media Uploader*/
add_filter('upload_mimes', 'svg_mime_types');
function svg_mime_types($mimes)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg';
    $file_types = array_merge($mimes, $new_filetypes);

    return $file_types;
}
############################################################################

/* Fix fatal error when use wp function "is_plugin_active" */
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
// ###############################################################################################

/* Function for print html element if it's not empty */
function print_elem($tag, $class, $content, $attr = null)
{
    if (!empty($content)) :
        echo '<' . $tag . ' class="' . $class . '" ' . $attr . '>' . $content . '</' . $tag . '>';
    endif;
}
// ###############################################################################################

/* Function for print link element if it's not empty */
function print_link($href, $class = null, $content = null, $attr = null, $email = false, $tel = false)
{
    if (empty($href)) return;
    $href_attribute = '';
    if ($email) {
        $href_attribute = 'mailto:' . $href;
    } elseif ($tel) {
        $href_attribute = 'tel:' . $href;
    } else {
        $href_attribute = $href;
    }
    echo '<a class="' . $class . '" href="' . $href_attribute . '" ' . $attr . '>' . $content . '</a>';
}
###############################################################################################

/* Function to print picture element */
function print_picture($img_desk_tag = null,  $img_mob_url = null, $class = null)
{
    if (empty($img_desk_tag)) return;

    $source = $img_mob_url ? '<source media="(max-width: 576px)" srcset="' . esc_url($img_mob_url) . '">' : '';

    echo '<picture' . ($class ? ' class="' . $class . '"' : '') . '>' . $source . $img_desk_tag . '</picture>';
}

###############################################################################################