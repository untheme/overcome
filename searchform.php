<?php
/**
 * Search Form
 * 
 * @package EF5 Theme
 * @subpackage OverCome
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="searchform-wrap">
        <input type="text" placeholder="<?php esc_attr_e('Type and hit enter ...', 'overcome'); ?>" name="s" class="search-field" />
        <button type="submit"></button>
    </div>
</form>