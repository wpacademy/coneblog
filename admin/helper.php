<?php
/**
 * Custom Settinmg Field outoput function.
 *
 * @param string $page
 * @param string $field_id
 * @return string
 */
function coneblog_settings_section_field($page, $field_id) {
    global $wp_settings_sections, $wp_settings_fields;

    if ( ! isset( $wp_settings_sections[$page] ) )
        return;

    foreach ( (array) $wp_settings_sections[$page] as $section ) {

        if ( $section['callback'] )
            call_user_func( $section['callback'], $section );

        if ( ! isset( $wp_settings_fields[$page][$section['id']] ) )
            continue;

        foreach ( (array) $wp_settings_fields[$page][$section['id']] as $field ) {
            if ( $field['id'] !== $field_id )
                continue;

            call_user_func($field['callback'], $field['args']);
        }
    }
}