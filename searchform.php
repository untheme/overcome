<?php
/**
 * Search Form
 * 
 * @package UnBreak
 * @subpackage UnBreak
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="searchform-wrap">
        <input type="text" placeholder="<?php esc_attr_e('Type and hit enter ...', 'unbreak'); ?>" name="s" class="search-field" />
        <button type="submit"></button>
    </div>
</form>