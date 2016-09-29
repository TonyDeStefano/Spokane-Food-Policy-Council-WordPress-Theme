<?php

namespace OnaWhiteAngus;

class MenuItem {

	private $title;
	private $url;

	/** @var MenuItem[] $children */
	private $children;

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return ( $this->title === NULL ) ? '' : $this->title;
	}

	/**
	 * @param mixed $title
	 *
	 * @return MenuItem
	 */
	public function setTitle( $title ) {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUrl() {
		return ( $this->url === NULL ) ? '' : $this->url;
	}

	/**
	 * @param mixed $url
	 *
	 * @return MenuItem
	 */
	public function setUrl( $url ) {
		$this->url = $url;

		return $this;
	}

	/**
	 * @return MenuItem[]
	 */
	public function getChildren() {
		return ( $this->children === NULL ) ? array() : $this->children;
	}

	/**
	 * @param MenuItem $menu_item
	 *
	 * @return $this
	 */
	public function addChild( $menu_item ) {

		if ( $this->children === NULL ) {
			$this->children = array();
		}

		$this->children[] = $menu_item;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getChildCount() {
		return count( $this->getChildren() );
	}

	/**
	 * @return bool
	 */
	public function hasChildren(){
		return ( count( $this->getChildren() ) > 0 );
	}

}