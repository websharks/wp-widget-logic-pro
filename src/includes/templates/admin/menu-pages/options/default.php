<?php
/**
 * Template.
 *
 * @author @jaswsinc
 * @copyright WP Sharks™
 */
declare (strict_types = 1);
namespace WebSharks\WpSharks\WpWidgetLogic\Pro;

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

if (!defined('WPINC')) {
    exit('Do NOT access this file directly.');
}
$Form = $this->s::menuPageForm('§save-options');
?>
<?= $Form->openTag(); ?>

    <?= $Form->openTable(
        __('General Options', 'wp-widget-logic'),
        sprintf(__('You can browse our <a href="%1$s" target="_blank">knowledge base</a> to learn more about these options.', 'wp-widget-logic'), esc_url(s::brandUrl('/kb')))
    ); ?>

        <?= $Form->inputRow([
            'type'  => 'text',
            'label' => __('Option label.', 'wp-widget-logic'),
            'tip'   => __('Here is a tip.', 'wp-widget-logic'),
            'note'  => sprintf(__('To learn more, see: <a href="%1$s" target="_blank">example KB article</a>.', 'wp-widget-logic'), esc_url(s::brandUrl('/kb-article/example'))),

            'name'  => 'option_name',
            'value' => s::getOption('option_name'),
        ]); ?>

    <?= $Form->closeTable(); ?>

    <?= $Form->submitButton(); ?>
<?= $Form->closeTag(); ?>
