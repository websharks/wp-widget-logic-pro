<?php
/**
 * Widget utils.
 *
 * @author @jaswsinc
 * @copyright WP Sharks™
 */
declare(strict_types=1);
namespace WebSharks\WpSharks\WpWidgetLogic\Pro\Classes\Utils;

use WebSharks\WpSharks\WpWidgetLogic\Pro\Classes;
use WebSharks\WpSharks\WpWidgetLogic\Pro\Interfaces;
use WebSharks\WpSharks\WpWidgetLogic\Pro\Traits;
#
use WebSharks\WpSharks\WpWidgetLogic\Pro\Classes\AppFacades as a;
use WebSharks\WpSharks\WpWidgetLogic\Pro\Classes\SCoreFacades as s;
use WebSharks\WpSharks\WpWidgetLogic\Pro\Classes\CoreFacades as c;
#
use WebSharks\WpSharks\Core\Classes as SCoreClasses;
use WebSharks\WpSharks\Core\Interfaces as SCoreInterfaces;
use WebSharks\WpSharks\Core\Traits as SCoreTraits;
#
use WebSharks\Core\WpSharksCore\Classes as CoreClasses;
use WebSharks\Core\WpSharksCore\Classes\Core\Base\Exception;
use WebSharks\Core\WpSharksCore\Interfaces as CoreInterfaces;
use WebSharks\Core\WpSharksCore\Traits as CoreTraits;
#
use function assert as debug;
use function get_defined_vars as vars;

/**
 * Widget utils.
 *
 * @since 170219.18169 Initial release.
 */
class Widget extends SCoreClasses\SCore\Base\Core
{
    /**
     * On `in_widget_form` action.
     *
     * @since 170219.18169 Initial release.
     *
     * @param WP_Widget          $WP_Widget The widget instance by reference.
     * @param string|scalar|null $return    Set to `null` when adding new fields.
     * @param array|scalar       $instance  Widget instance settings.
     */
    public function onInWidgetForm(\WP_Widget $WP_Widget, $return, $instance)
    {
        $return = null; // Adding fields.

        $instance   = (array) $instance;
        $logic      = (string) ($instance['_logic'] ?? '');

        $id   = $WP_Widget->get_field_id('_logic');
        $name = $WP_Widget->get_field_name('_logic');

        echo '<p class="'.esc_attr($this->App::CORE_CONTAINER_SLUG).'">';
        echo    '<label for="'.esc_attr($id).'">'.__('Widget Logic:', 'wp-widget-logic').'</label>';

        echo    '<textarea name="'.esc_attr($name).'" id="'.esc_attr($id).'"'.
                 ' rows="2" class="widefat" style="font-family:monospace;" spellcheck="false">'.
                    esc_textarea($logic).
                '</textarea>';
        echo '</p>';
    }

    /**
     * On `widget_update_callback` filter.
     *
     * @since 170219.18169 Initial release.
     *
     * @param array|scalar $instance     Widget instance settings.
     * @param array|scalar $new_instance Widget instance settings.
     * @param array|scalar $old_instance Widget instance settings.
     * @param WP_Widget    $WP_Widget    The widget instance by reference.
     *
     * @return array Widget instance settings.
     */
    public function onWidgetUpdateCallback($instance, $new_instance, $old_instance, \WP_Widget $WP_Widget): array
    {
        $instance     = (array) $instance;
        $new_instance = (array) $new_instance;
        $old_instance = (array) $old_instance;

        $instance['_logic'] = (string) ($new_instance['_logic'] ?? '');
        $instance['_logic'] = c::mbTrim($instance['_logic']);

        return $instance;
    }

    /**
     * On `widget_display_callback` filter.
     *
     * @since 170219.18169 Initial release.
     *
     * @param array|scalar $instance  Widget instance settings.
     * @param WP_Widget    $WP_Widget The widget instance by reference.
     * @param array        $args      The widget instance args.
     *
     * @return array|bool Widget instance settings, or `false` to disable.
     */
    public function onWidgetDisplayCallback($instance, \WP_Widget $WP_Widget, $args)
    {
        $instance = (array) $instance;
        $args     = (array) $args;
        $logic    = (string) ($instance['_logic'] ?? '');

        if ($logic && !c::phpEval('return ('.$logic.');')) {
            return false; // `false` = do not display.
        }
        return $instance;
    }
}
