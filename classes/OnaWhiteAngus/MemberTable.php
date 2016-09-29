<?php

namespace OnaWhiteAngus;

if ( ! class_exists( 'WP_List_Table' ) )
{
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class MemberTable extends \WP_List_Table {

	/**
	 * PhotographerTable constructor.
	 */
	public function __construct()
	{
		parent::__construct( array(
			'singular' => 'Member',
			'plural' => 'Members',
			'ajax' => TRUE
		) );
	}

	/**
	 * @return array
	 */
	public function get_columns()
	{
		$return = array(
			'name' => 'Name',
			'farm' => 'Farm',
			'city' => 'City',
			'state' => 'State',
			'is_active' => 'Active',
			'view' => 'View'
		);

		return $return;
	}

	/**
	 * @return array
	 */
	public function get_sortable_columns()
	{
		$return =  array(
			'name' => array( 'last_name,first_name', TRUE ),
			'farm' => array( 'farm_name', TRUE ),
			'city' => array( 'city', TRUE ),
			'state' => array( 'state', TRUE ),
			'is_active' => array( 'is_active', TRUE )
		);

		return $return;
	}

	/**
	 * @param object $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default( $item, $column_name )
	{
		switch( $column_name ) {
			case 'name':
				return $item->first_name . ' ' . $item->last_name;
			case 'view':
				return '<a href="?page=' . $_REQUEST['page'] . '&action=view&id=' . $item->ID . '" class="button-primary">View</a>';
			default:
				return $item->$column_name;
		}
	}

	/**
	 *
	 */
	public function prepare_items()
	{
		global $wpdb;

		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();

		$sql = "
			SELECT
				*
			FROM
				" . $wpdb->prefix . Member::TABLE_NAME;
		if ( isset( $_GET[ 'orderby' ] ) )
		{
			foreach ( $sortable as $s )
			{
				if ( $s[ 0 ] == $_GET[ 'orderby' ] )
				{
					$sql .= "
						ORDER BY " . $_GET[ 'orderby' ] . " " . ( ( isset( $_GET['order']) && strtolower( $_GET['order'] == 'desc' ) ) ? "DESC" : "ASC" );
					break;
				}
			}
		}
		else
		{
			$sql .= "
				ORDER BY
					last_name ASC,
					first_name ASC";
		}

		$total_items = $wpdb->query( $sql );

		$max_per_page = 50;
		$paged = ( isset( $_GET[ 'paged' ] ) && is_numeric( $_GET['paged'] ) ) ? abs( round( $_GET[ 'paged' ])) : 1;
		$total_pages = ceil( $total_items / $max_per_page );

		if ( $paged > $total_pages )
		{
			$paged = $total_pages;
		}

		$offset = ( $paged - 1 ) * $max_per_page;
		$offset = ( $offset < 0 ) ? 0 : $offset; //MySQL freaks out about LIMIT -10, 10 type stuff.

		$sql .= "
			LIMIT " . $offset . ", " . $max_per_page;

		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => $total_pages,
			'per_page' => $max_per_page
		) );

		$this->_column_headers = array( $columns, $hidden, $sortable );
		$this->items = $wpdb->get_results( $sql );
	}
}