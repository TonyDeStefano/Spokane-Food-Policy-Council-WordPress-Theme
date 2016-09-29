<?php

namespace OnaWhiteAngus;

class HomepageBox {

	const OPTION_NAME = 'one_white_angus_homepage_boxes';

	private $index;
	private $title;
	private $content;
	private $link;
	private $link_text;

	public function __construct( $index = NULL )
	{
		$this
			->setIndex( $index )
			->read();
	}

	public function read()
	{
		if ( $this->index !== NULL )
		{
			$homepage_boxes = self::getAllHomepageBoxes();

			if ( array_key_exists( $this->index, $homepage_boxes ) )
			{
				$this
					->setTitle( $homepage_boxes[ $this->index ]->getTitle() )
					->setContent( $homepage_boxes[ $this->index ]->getContent() )
					->setLink( $homepage_boxes[ $this->index ]->getLink() )
					->setLinkText( $homepage_boxes[ $this->index ]->getLinkText() );
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function getIndex() {
		return $this->index;
	}

	/**
	 * @param mixed $index
	 *
	 * @return HomepageBox
	 */
	public function setIndex( $index ) {
		$this->index = ( is_numeric( $index )) ? intval( $index ) : NULL;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return ( $this->title === NULL ) ? '' : trim( $this->title );
	}

	/**
	 * @param mixed $title
	 *
	 * @return HomepageBox
	 */
	public function setTitle( $title ) {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getContent() {
		return ( $this->content === NULL ) ? '' : trim( $this->content );
	}

	/**
	 * @param mixed $content
	 *
	 * @return HomepageBox
	 */
	public function setContent( $content ) {
		$this->content = $content;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLink() {
		return ( $this->link === NULL ) ? '' : $this->link;
	}

	/**
	 * @param mixed $link
	 *
	 * @return HomepageBox
	 */
	public function setLink( $link ) {
		$this->link = $link;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLinkText() {
		return ( $this->link_text === NULL ) ? '' : $this->link_text;
	}

	/**
	 * @param mixed $link_text
	 *
	 * @return HomepageBox
	 */
	public function setLinkText( $link_text ) {
		$this->link_text = $link_text;

		return $this;
	}

	public function hasData()
	{
		return ( strlen( $this->getTitle() ) > 0 || strlen( $this->getContent() ) > 0 || strlen( $this->getLinkText() ) );
	}

	public static function getOptionValue()
	{
		return get_option( self::OPTION_NAME , '' );
	}

	/**
	 * @return HomepageBox[]
	 */
	public static function getAllHomepageBoxes()
	{
		$homepage_boxes = array();

		$data = self::getOptionValue();

		if ( strlen( $data ) > 0 )
		{
			$datum = json_decode( $data, TRUE );

			foreach ( $datum as $data )
			{
				$homepage_box = new HomepageBox();
				$homepage_box
					->setIndex( $data['index'] )
					->setTitle( $data['title'] )
					->setContent( $data['content'] )
					->setLink( $data['link'] )
					->setLinkText( $data['link_text'] );

				$homepage_boxes[ $homepage_box->getIndex() ] = $homepage_box;
			}
		}

		return $homepage_boxes;
	}

	public static function getHomepageBoxCount()
	{
		$count = 0;
		$homepage_boxes = self::getAllHomepageBoxes();
		foreach ( $homepage_boxes as $homepage_box )
		{
			if ( $homepage_box->hasData() )
			{
				$count ++;
			}
		}

		return $count;
	}
}