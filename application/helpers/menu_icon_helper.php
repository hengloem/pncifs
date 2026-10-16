<?php
/**
 * Inline line-icons for the sidebar menu ("Lilac Hush" redesign).
 * Inline SVG so the icons inherit the menu's colour through currentColor.
 * @author  Base44
 * @since   0.2.0
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('menu_icon')) {

    /**
     * Get the inline SVG for a sidebar menu icon
     * @param string $name Icon name (home, edit, survey, report, presentation, folder, user, calendar, list, bell)
     * @return string SVG markup, or an empty string for an unknown name
     * @author Base44
     */
    function menu_icon($name) {
        $paths = array(
            'home' => '<rect x="3" y="3" width="8" height="8" rx="1.5"/><rect x="13" y="3" width="8" height="5" rx="1.5"/><rect x="13" y="10" width="8" height="11" rx="1.5"/><rect x="3" y="13" width="8" height="8" rx="1.5"/>',
            'edit' => '<path d="M4 20h16M6 17l1-4 9-9a2 2 0 0 1 3 3l-9 9-4 1z"/><path d="m14 6 4 4"/>',
            'survey' => '<path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21z"/><path d="M4 5.5v13A2.5 2.5 0 0 1 6.5 16H20M8 7h8M8 10h8"/>',
            'report' => '<path d="M6 3h9l4 4v14H6z"/><path d="M15 3v5h5M9 13h7M9 17h7"/>',
            'presentation' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="m10 8 6 4-6 4z"/>',
            'folder' => '<path d="M4 7h6l2 2h8v11H4z"/><path d="M4 7V5h7l2 2"/>',
            'user' => '<circle cx="12" cy="8" r="3"/><path d="M5 20a7 7 0 0 1 14 0"/>',
            'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M7 3v4M17 3v4M3 10h18M7 14h3M14 14h3"/>',
            'list' => '<path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"/>',
            'bell' => '<path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/>'
        );

        if ( ! isset($paths[$name])) {
            return '';
        }

        return '<svg viewBox="0 0 24 24" aria-hidden="true">' . $paths[$name] . '</svg>';
    }

}
