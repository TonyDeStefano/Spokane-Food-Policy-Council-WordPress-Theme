<?php

namespace OnaWhiteAngus;

class Payment {

	const TABLE_NAME = 'ona_white_angus_payments';

	const METHOD_CASH = 'cash';
	const METHOD_CREDIT_CARD = 'credit card';
	const METHOD_CHECK = 'check';

	private $id;
	private $member_id;
	private $payment_amount;
	private $payment_method;
	private $is_annual = FALSE;
	private $is_lifetime = FALSE;
	private $created_at;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 *
	 * @return Payment
	 */
	public function setId( $id )
	{
		$this->id = ( is_numeric( $id ) ) ? intval( $id ) : NULL;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMemberId()
	{
		return $this->member_id;
	}

	/**
	 * @param mixed $member_id
	 *
	 * @return Payment
	 */
	public function setMemberId( $member_id )
	{
		$this->member_id = ( is_numeric( $member_id ) ) ? intval( $member_id ) : NULL;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPaymentAmount()
	{
		return $this->payment_amount;
	}

	/**
	 * @param mixed $payment_amount
	 *
	 * @return Payment
	 */
	public function setPaymentAmount( $payment_amount )
	{
		$this->payment_amount = $fee = preg_replace( '/[^0-9.]*/', '', $payment_amount );

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPaymentMethod()
	{
		return $this->payment_method;
	}

	/**
	 * @param mixed $payment_method
	 *
	 * @return Payment
	 */
	public function setPaymentMethod( $payment_method )
	{
		$this->payment_method = $payment_method;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isAnnual()
	{
		return ( $this->is_annual === TRUE );
	}

	/**
	 * @param boolean $is_annual
	 *
	 * @return Payment
	 */
	public function setIsAnnual( $is_annual )
	{
		$this->is_annual = ( $is_annual === TRUE || $is_annual == 1 );

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isLifetime()
	{
		return ( $this->is_lifetime === TRUE );
	}

	/**
	 * @param boolean $is_lifetime
	 *
	 * @return Payment
	 */
	public function setIsLifetime( $is_lifetime )
	{
		$this->is_lifetime = ( $is_lifetime === TRUE || $is_lifetime == 1 );

		return $this;
	}

	/**
	 * @param string $format
	 *
	 * @return bool|string
	 */
	public function getCreatedAt( $format='Y-m-d H:i:s' )
	{
		return ( $this->created_at === NULL ) ? '' : date( $format, strtotime( $this->created_at ) );
	}

	/**
	 * @param mixed $created_at
	 *
	 * @return Payment
	 */
	public function setCreatedAt( $created_at )
	{
		if ( $created_at === NULL )
		{
			$this->created_at = NULL;
		}
		elseif ( is_numeric( $created_at ) )
		{
			$this->created_at = date( 'Y-m-d H:i:s', $created_at );
		}
		else
		{
			$this->created_at = date( 'Y-m-d H:i:s', strtotime( $created_at ) );
		}

		return $this;
	}

	/**
	 * @return array
	 */
	public static function getPaymentMethods()
	{
		return array(
			self::METHOD_CASH,
			self::METHOD_CREDIT_CARD,
			self::METHOD_CHECK
		);
	}
}