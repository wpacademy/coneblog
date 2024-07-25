<?php
/**
 * Add the top level menu page.
 */
function coneblog_options_page() {
    add_menu_page(
        'ConeBlog Widgets',
        'ConeBlog',
        'manage_options',
        'coneblog',
        'coneblog_options_page_html',
        'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDIwMDEwOTA0Ly9FTiIKICJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy1TVkctMjAwMTA5MDQvRFREL3N2ZzEwLmR0ZCI+CjxzdmcgdmVyc2lvbj0iMS4wIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiB3aWR0aD0iNTEyLjAwMDAwMHB0IiBoZWlnaHQ9IjUxMi4wMDAwMDBwdCIgdmlld0JveD0iMCAwIDUxMi4wMDAwMDAgNTEyLjAwMDAwMCIKIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIG1lZXQiPgoKPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsNTEyLjAwMDAwMCkgc2NhbGUoMC4xMDAwMDAsLTAuMTAwMDAwKSIKZmlsbD0iIzAwMDAwMCIgc3Ryb2tlPSJub25lIj4KPHBhdGggZD0iTTc2MCA0NTQ1IGwwIC0yMTUgMjIwIDAgMjIwIDAgMCAyMTUgMCAyMTUgLTIyMCAwIC0yMjAgMCAwIC0yMTV6Ii8+CjxwYXRoIGQ9Ik0xNTcwIDQ2MjAgbDAgLTEzMCAxMzUgMCAxMzYgMCAtMyAxMjggLTMgMTI3IC0xMzIgMyAtMTMzIDMgMCAtMTMxeiIvPgo8cGF0aCBkPSJNMTI5MCA0MzY1IGwwIC0xMjUgLTEzMCAwIC0xMzAgMCAwIC0xMzUgMCAtMTM1IDI2NSAwIDI2NSAwIDAgMjYwIDAKMjYwIC0xMzUgMCAtMTM1IDAgMCAtMTI1eiIvPgo8cGF0aCBkPSJNMTY4OCA0MTA4IGwtMyAtMjYzIC0yNjcgLTMgLTI2OCAtMiAwIC0xNzQ1IDAgLTE3NDUgMTYwNSAwIDE2MDUgMAowIDgwNSAwIDgwNSAtNDAwIDAgLTQwMCAwIDAgNDAwIDAgNDAwIDM5OCAyIDM5NyAzIDMgODAzIDIgODAyIC0xMzM1IDAgLTEzMzUKMCAtMiAtMjYyeiBtMTgzMiAtOTQzIGwwIC00MDUgLTc4NSAwIC03ODUgMCAwIDQwNSAwIDQwNSA3ODUgMCA3ODUgMCAwIC00MDV6Cm0wIC0xNjA1IGwwIC00MDAgLTc4NSAwIC03ODUgMCAwIDQwMCAwIDQwMCA3ODUgMCA3ODUgMCAwIC00MDB6Ii8+CjxwYXRoIGQ9Ik03NjAgMzg0MCBsMCAtMTMwIDEyOSAwIDEzMCAwIDMgMTI2IGMyIDY5IDEgMTI4IC0xIDEzMCAtMiAyIC02MiA0Ci0xMzMgNCBsLTEyOCAwIDAgLTEzMHoiLz4KPC9nPgo8L3N2Zz4K',
        30
    );
}
add_action( 'admin_menu', 'coneblog_options_page' );

/**
 * Add sub-menu page.
 */
function coneblog_options_page_builders() {
    add_submenu_page(
        'coneblog',
        'ConeBlog Builders',
        'Builders',
        'manage_options',
        'coneblog',
        'coneblog_options_page_html' );
}
add_action('admin_menu', 'coneblog_options_page_builders');
function coneblog_options_page_widgets() {
    add_submenu_page(
        'coneblog',
        'ConeBlog Widgets',
        'Widgets',
        'manage_options',
        'cb-widgets',
        'coneblog_options_page_html' );
}
add_action('admin_menu', 'coneblog_options_page_widgets');

function coneblog_options_page_tools() {
    add_submenu_page(
        'coneblog',
        'ConeBlog Tools',
        'Tools',
        'manage_options',
        'cb-tools',
        'coneblog_options_page_html' );
}
add_action('admin_menu', 'coneblog_options_page_tools');

function coneblog_options_page_support() {
    add_submenu_page(
        'coneblog',
        'ConeBlog Support',
        'Support',
        'manage_options',
        'cb-support',
        'coneblog_options_page_html' );
}
add_action('admin_menu', 'coneblog_options_page_support');