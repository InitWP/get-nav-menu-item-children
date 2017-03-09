<?php
/**
* Returns all children menu items of a parent nav_menu_item
*
* @param int the parent nav_menu_item ID
* @param array nav_menu_items (get by using wp_get_nav_menu_items(...))
* @param bool gives all children or direct children only
* @return array returns filtered array of nav_menu_items
*/
function NAMESPACE_get_nav_menu_item_children( $parent_id, $nav_menu_items, $depth = true ) {
	$nav_menu_item_list = array();
	foreach ( (array) $nav_menu_items as $nav_menu_item ) {
		if ( $nav_menu_item->menu_item_parent == $parent_id ) {
			$nav_menu_item_list[] = $nav_menu_item;
			if ( $depth ) {
				if ( $children = NAMESPACE_get_nav_menu_item_children( $nav_menu_item->ID, $nav_menu_items ) ) {
					$nav_menu_item_list = array_merge( $nav_menu_item_list, $children );
				}
			}
		}
	}
	return $nav_menu_item_list;
}
