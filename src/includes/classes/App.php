<?php
/**
 * Application.
 *
 * @author @jaswsinc
 * @copyright WP Sharks™
 */
declare(strict_types=1);
namespace WebSharks\WpSharks\WpWidgetLogic\Pro\Classes;

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
 * Application.
 *
 * @since 170219.18169 Initial release.
 */
class App extends SCoreClasses\App
{
    /**
     * Version.
     *
     * @since 170219.18169
     *
     * @type string Version.
     */
    const VERSION = '170219.18169'; //v//

    /**
     * Constructor.
     *
     * @since 170219.18169 Initial release.
     *
     * @param array $instance Instance args.
     */
    public function __construct(array $instance = [])
    {
        $instance_base = [
            '©di' => [
                '©default_rule' => [
                    'new_instances' => [
                    ],
                ],
            ],

            '§specs' => [
                '§in_wp'           => false,
                '§is_network_wide' => false,

                '§type'            => 'plugin',
                '§file'            => dirname(__FILE__, 4).'/plugin.php',
            ],
            '©brand' => [
                '©acronym'     => 'WIDGET LOGIC',
                '©name'        => 'WP Widget Logic',

                '©slug'        => 'wp-widget-logic',
                '©var'         => 'wp_widget_logic',

                '©short_slug'  => 'wp-wgt-lgc',
                '©short_var'   => 'wp_wgt_lgc',

                '©text_domain' => 'wp-widget-logic',
            ],

            '§pro_option_keys' => [],
            '§default_options' => [],

            '§conflicts' => [
                '§plugins' => [
                    'widget-logic'  => 'Widget Locic',
                ],
            ],
        ];
        parent::__construct($instance_base, $instance);
    }

    /**
     * Early hook setup handler.
     *
     * @since 170219.18169 Initial release.
     */
    protected function onSetupEarlyHooks()
    {
        parent::onSetupEarlyHooks();

        s::addAction('vs_upgrades', [$this->Utils->Installer, 'onVsUpgrades']);
        s::addAction('other_install_routines', [$this->Utils->Installer, 'onOtherInstallRoutines']);
        s::addAction('other_uninstall_routines', [$this->Utils->Uninstaller, 'onOtherUninstallRoutines']);
    }

    /**
     * Other hook setup handler.
     *
     * @since 170219.18169 Initial release.
     */
    protected function onSetupOtherHooks()
    {
        parent::onSetupOtherHooks();

        add_action('in_widget_form', [$this->Utils->Widget, 'onInWidgetForm'], 10, 3);
        add_filter('widget_update_callback', [$this->Utils->Widget, 'onWidgetUpdateCallback'], 10, 4);
        add_filter('widget_display_callback', [$this->Utils->Widget, 'onWidgetDisplayCallback'], 10, 3);
    }
}
