<?php

namespace OnaWhiteAngus;

class HoverCow {

	const OPTION_NAME = 'one_white_angus_hover_cow';

	private $index;
	private $title;
	private $content;

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
			$hover_cows = self::getAllHoverCows();
			if ( array_key_exists( $this->index, $hover_cows ) )
			{
				$this
					->setTitle( $hover_cows[ $this->index ]->getTitle() )
					->setContent( $hover_cows[ $this->index ]->getContent() );
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
	 * @return HoverCow
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
	 * @return HoverCow
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
	 * @return HoverCow
	 */
	public function setContent( $content ) {
		$this->content = $content;

		return $this;
	}

	public function hasData()
	{
		return ( strlen( $this->getTitle() ) > 0 || strlen( $this->getContent() ) > 0 );
	}

	public static function getOptionValue()
	{
		return get_option( self::OPTION_NAME , '' );
	}

	/**
	 * @return HoverCow[]
	 */
	public static function getAllHoverCows()
	{
		$hover_cows = array();

		$data = self::getOptionValue();
		if ( strlen( $data ) > 0 )
		{
			$datum = json_decode( $data, TRUE );
			foreach ( $datum as $data )
			{
				$hover_cow = new HoverCow();
				$hover_cow
					->setIndex( $data['index'] )
					->setTitle( $data['title'] )
					->setContent( $data['content'] );

				$hover_cows[ $hover_cow->getIndex() ] = $hover_cow;
			}
		}

		return $hover_cows;
	}

	public static function getHoverCowCount()
	{
		$count = 0;
		$hover_cows = self::getAllHoverCows();
		foreach ( $hover_cows as $hover_cow )
		{
			if ( $hover_cow->hasData() )
			{
				$count ++;
			}
		}

		return $count;
	}
}