<?php
add_action('after_setup_theme', 'theme_register_nav');
if (!function_exists('theme_register_nav')) :
    function theme_register_nav()
    {
        register_nav_menus(
            [
                'header-menu-en' => 'Header menu en',
                'header-menu-fr' => 'Header menu fr',
                'footer-menu-en' => 'Footer menu en',
                'footer-menu-fr' => 'Footer menu fr',
            ]
        );
    }
endif;

function show_menu($curr_loc, $curr_menu, $container, $container_class)
{
    if (has_nav_menu($curr_loc))
        wp_nav_menu(
            [
                'theme_location'  => $curr_loc,
                'menu'            => $curr_menu,
                'container'       => $container,
                'container_class' => $container_class,
                'menu_class'      => 'nav__list',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
                'walker'          => new My_Walker_Nav_Menu(),
            ]
        );
}

// Your menu building class (new walker)
class My_Walker_Nav_Menu extends Walker_Nav_Menu
{
    // add classes to ul sub-menus
    function start_lvl(&$output, $depth = 0, $args = NULL)
    {
        // depth dependent classes
        $indent = ($depth > 0  ? str_repeat("\t", $depth) : ''); // code indent
        $display_depth = ($depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'nav__sub-list-' . $display_depth
        );
        $class_names = implode(' ', $classes);

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    // add main/sub classes to li's and links
    function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0)
    {
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent

        // depth dependent classes
        $depth_classes = array(
            ($depth == 0 ? 'nav__item' : 'nav__sub-item-' . $depth),
        );
        $depth_class_names = esc_attr(implode(' ', $depth_classes));

        // passed classes
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        // Remove unwanted classes here
        $unwanted_classes = array(
            'menu-item-type-custom',
            'menu-item-object-custom',
            'menu-item',
            'menu-item-object-post',
            'menu-item-type-post_type',
            'menu-item-object-page',
            'menu-item-type-taxonomy',
            'menu-item-object-category',
            'current-menu-ancestor',
            'current-menu-parent'
        );
        $classes = array_diff($classes, $unwanted_classes);

        // Check if the current item has the class 'menu-item-has-children'
        $has_children_class = in_array('menu-item-has-children', $classes);

        // Replace 'menu-item-has-children' class with 'nav__parent' class if it exists
        if ($has_children_class) {
            $classes = array_diff($classes, array('menu-item-has-children'));
            $classes[] = 'nav__parent';
        }

        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

        // menu item icon 
        preg_match('/\b' . preg_quote('icon-', '/') . '([^ ]+)\b/', $class_names, $matches);

        if (!empty($matches[1])) {
            $icon = $matches[0]; // Obtaining the full found class, for example, "icon-favicon"
            $class_names = str_replace($icon, '', $class_names); // Remove the "icon-" class from the wrapper class
        } else {
            $icon = ''; // No "icon-" class found
        }

        // build html
        $output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';

        // link attributes
        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';

        // if menu item contain class 'add-domen' add domain to item url
        if (strripos($class_names, 'add-domain') !== false) :
            if (!empty($item->url)) :
                $item->url = site_url($item->url);
            endif;
        endif;

        if (
            strripos($class_names, 'span') === false ||
            strripos($class_names, 'span') !== false && strripos($class_names, 'except-mainpage') !== false && is_front_page()
        ) :
            $structure = '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s';
            if (!empty($item->url)) :
                $attributes .= ' href="'   . esc_attr($item->url) . '"';
            endif;

        else :
            $structure = '%1$s<span%2$s>%3$s%4$s%5$s</span>%6$s';
            if (!empty($item->url)) :
                $attributes .= $item->url !== '#'  ?  ' data-url="'   . esc_attr($item->url) . '"' : '';
            endif;

        endif;

        $attributes .= ' class="' . ($depth > 0 ? 's4-t nav__sub-link-' . $depth : 'nav__link s2-t') . '"';

        // var_dump($args);
        if (strpos($attributes, 'nav__sub-link-') !== false) {
            $item_output = sprintf(
                $structure,
                $args->before,
                $attributes,
                (!empty($icon) ? $args->link_before . '<i class="menu-icon ' . $icon . '"></i><span>' : $args->link_before . '<span>'),
                apply_filters('the_title', $item->title, $item->ID),
                $args->link_after,
                $args->after
            );
        } else {
            $item_output = sprintf(
                $structure,
                $args->before,
                $attributes,
                $args->link_before,
                apply_filters('the_title', $item->title, $item->ID),
                $args->link_after,
                $args->after
            );
        }

        // build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
#################################################################################################################