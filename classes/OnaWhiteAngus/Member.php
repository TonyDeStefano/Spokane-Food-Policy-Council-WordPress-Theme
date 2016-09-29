<?php

namespace OnaWhiteAngus;

class Member {

	const TABLE_NAME = 'ona_white_angus_members';

	private $id;
	private $wp_user_id;
	private $email;
	private $first_name;
	private $last_name;
	private $farm_name;
	private $address;
	private $city;
	private $state;
	private $zip;
	private $phone;
	private $website;
	private $is_active = FALSE;
	private $created_at;
	private $updated_at;

	/** @var Payment[] $payments */
	private $payments;

	/** @var \WP_User $user */
	private $user;

	public function __construct( $id = NULL )
	{
		$this
			->setId( $id )
			->read();
	}

	public function create()
	{
		/** @var \wpdb $wpdb */
		global $wpdb;

		if ( $this->wp_user_id !== NULL )
		{
			$this
				->setIsActive( TRUE )
				->setCreatedAt( time() )
				->setUpdatedAt( time() );

			$wpdb->insert(
				$wpdb->prefix . self::TABLE_NAME,
				array(
					'wp_user_id' => $this->wp_user_id,
					'email' => $this->email,
					'first_name' => $this->first_name,
					'last_name' => $this->last_name,
					'farm_name' => $this->farm_name,
					'address' => $this->address,
					'city' => $this->city,
					'state' => $this->state,
					'zip' => $this->zip,
					'phone' => $this->phone,
					'is_active' => ( $this->isActive() ) ? 1 : 0,
					'created_at' => $this->getCreatedAt( 'Y-m-d H:i:s' ),
					'updated_at' => $this->getUpdatedAt( 'Y-m-d H:i:s' )
				),
				array(
					'%d',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%d',
					'%s',
					'%s'
				)
			);

			$this->setId( $wpdb->insert_id );
		}
	}

	public function read()
	{
		/** @var \wpdb $wpdb */
		global $wpdb;

		if ( $this->id !== NULL )
		{
			$sql = $wpdb->prepare("
				SELECT
					*
				FROM
					" . $wpdb->prefix . self::TABLE_NAME . "
				WHERE
					id = %d",
					$this->id
			);

			if ( $row = $wpdb->get_row( $sql ) )
			{
				$this->loadFromRow( $row );
			}
			else
			{
				$this->setWpUserId( NULL );
			}
		}
	}

	public function readFromWordPressId( $wp_user_id )
	{
		/** @var \wpdb $wpdb */
		global $wpdb;

		$this->setWpUserId( $wp_user_id );

		$sql = $wpdb->prepare("
			SELECT
				*
			FROM
				" . $wpdb->prefix . self::TABLE_NAME . "
			WHERE
				wp_user_id = %d",
			$this->wp_user_id
		);

		if ( $row = $wpdb->get_row( $sql ) )
		{
			$this->loadFromRow( $row );
		}
		else
		{
			$this->setWpUserId( NULL );
		}
	}

	public function loadFromRow( $row )
	{
		$this
			->setId( $row->id )
			->setWpUserId( $row->wp_user_id )
			->setEmail( $row->email )
			->setFirstName( $row->first_name )
			->setLastName( $row->last_name )
			->setFarmName( $row->farm_name )
			->setAddress( $row->address )
			->setCity( $row->city )
			->setState( $row->state )
			->setZip( $row->zip )
			->setPhone( $row->phone )
			->setIsActive( $row->is_active )
			->setCreatedAt( $row->created_at )
			->setUpdatedAt( $row->updated_at );
	}

	public function update()
	{

	}

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
	 * @return Member
	 */
	public function setId( $id )
	{
		$this->id = ( is_numeric( $id ) ) ? intval( $id ) : NULL;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getWpUserId()
	{
		return $this->wp_user_id;
	}

	/**
	 * @param mixed $wp_user_id
	 *
	 * @return Member
	 */
	public function setWpUserId( $wp_user_id )
	{
		$this->wp_user_id = ( is_numeric( $wp_user_id ) ) ? intval( $wp_user_id ) : NULL;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return ( $this->email === NULL ) ? '' : $this->email;
	}

	/**
	 * @param mixed $email
	 *
	 * @return Member
	 */
	public function setEmail( $email )
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFirstName()
	{
		return ( $this->first_name === NULL ) ? '' : $this->first_name;
	}

	/**
	 * @param mixed $first_name
	 *
	 * @return Member
	 */
	public function setFirstName( $first_name )
	{
		$this->first_name = $first_name;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLastName()
	{
		return ( $this->last_name === NULL ) ? '' : $this->last_name;
	}

	/**
	 * @param mixed $last_name
	 *
	 * @return Member
	 */
	public function setLastName( $last_name )
	{
		$this->last_name = $last_name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFullName()
	{
		return $this->getFirstName() . ' ' . $this->getLastName();
	}

	/**
	 * @return mixed
	 */
	public function getFarmName()
	{
		return ( $this->farm_name === NULL ) ? '' : $this->farm_name;
	}

	/**
	 * @param mixed $farm_name
	 *
	 * @return Member
	 */
	public function setFarmName( $farm_name )
	{
		$this->farm_name = $farm_name;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAddress()
	{
		return ( $this->address === NULL ) ? '' : $this->address;
	}

	/**
	 * @param mixed $address
	 *
	 * @return Member
	 */
	public function setAddress( $address )
	{
		$this->address = $address;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCity()
	{
		return ( $this->city === NULL ) ? '' : $this->city;
	}

	/**
	 * @param mixed $city
	 *
	 * @return Member
	 */
	public function setCity( $city )
	{
		$this->city = $city;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getState()
	{
		return ( $this->state === NULL ) ? '' : $this->state;
	}

	/**
	 * @param mixed $state
	 *
	 * @return Member
	 */
	public function setState( $state )
	{
		$this->state = $state;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getZip()
	{
		return ( $this->zip === NULL ) ? '' : $this->zip;
	}

	/**
	 * @param mixed $zip
	 *
	 * @return Member
	 */
	public function setZip( $zip )
	{
		$this->zip = $zip;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPhone()
	{
		return ( $this->phone === NULL ) ? '' : $this->phone;
	}

	/**
	 * @param mixed $phone
	 *
	 * @return Member
	 */
	public function setPhone( $phone )
	{
		$this->phone = $phone;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getWebsite()
	{
		return ( $this->website === NULL ) ? '' : $this->website;
	}

	/**
	 * @param mixed $website
	 *
	 * @return Member
	 */
	public function setWebsite( $website )
	{
		$this->website = $website;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isActive()
	{
		return ( $this->is_active === TRUE );
	}

	/**
	 * @param boolean $is_active
	 *
	 * @return Member
	 */
	public function setIsActive( $is_active )
	{
		$this->is_active = ( $is_active === TRUE || $is_active == 1 );

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
	 * @return Member
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
	 * @param string $format
	 *
	 * @return bool|string
	 */
	public function getUpdatedAt( $format='Y-m-d H:i:s' )
	{
		return ( $this->updated_at === NULL ) ? '' : date( $format, strtotime( $this->updated_at ) );
	}

	/**
	 * @param mixed $updated_at
	 *
	 * @return Member
	 */
	public function setUpdatedAt( $updated_at )
	{
		if ( $updated_at === NULL )
		{
			$this->updated_at = NULL;
		}
		elseif ( is_numeric( $updated_at ) )
		{
			$this->updated_at = date( 'Y-m-d H:i:s', $updated_at );
		}
		else
		{
			$this->updated_at = date( 'Y-m-d H:i:s', strtotime( $updated_at ) );
		}

		return $this;
	}

	/**
	 * @return Payment[]
	 */
	public function getPayments()
	{
		return ( $this->payments === NULL ) ? array() : $this->payments;
	}

	/**
	 * @param Payment $payment
	 *
	 * @return $this
	 */
	public function addPayment( $payment )
	{
		if ( $this->payments === NULL )
		{
			$this->payments = array();
		}

		$this->payments[ $payment->getId() ] = $payment;

		return $this;
	}

	/**
	 * @return \WP_User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @param \WP_User $user
	 *
	 * @return Member
	 */
	public function setUser( $user )
	{
		$this->user = $user;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isMember()
	{
		return ( $this->id !== NULL );
	}

	public function isCurrent()
	{
		foreach( $this->getPayments() as $payment )
		{
			if ( $payment->isLifetime() || strtotime( $payment->getCreatedAt() ) > strtotime( '-1 year' ) )
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * @return Member[]
	 */
	public static function getActiveMembers()
	{
		/** @var \wpdb $wpdb */
		global $wpdb;

		/** @var Member[] $members */
		$members = array();

		$sql = "
			SELECT
				m.*,
				p.id AS payment_id,
				p.payment_amount,
				p.payment_method,
				p.is_annual,
				p.is_lifetime,
				p.created_at AS payment_created_at
			FROM
				" . $wpdb->prefix . self::TABLE_NAME . " m
				LEFT JOIN " . $wpdb->prefix . Payment::TABLE_NAME . " p
					ON m.id = p.member_id
			WHERE
				m.is_active = 1
			ORDER BY
				m.state ASC,
				m.farm_name ASC,
				m.last_name ASC,
				m.first_name ASC,
				m.id ASC,
				p.id DESC";

		$rows = $wpdb->get_results( $sql );
		foreach( $rows as $row )
		{
			if ( ! array_key_exists( $row->id, $members ) )
			{
				$member = new Member;
				$member->loadFromRow( $row );
				$members[ $member->getId() ] = $member;
			}

			if ( $row->payment_id !== NULL )
			{
				$payment = new Payment;
				$payment
					->setId( $row->payment_id )
					->setMemberId( $row->id )
					->setPaymentAmount( $row->payment_amount )
					->setPaymentMethod( $row->payment_method )
					->setIsAnnual( $row->is_annual )
					->setIsLifetime( $row->is_lifetime )
					->setCreatedAt( $row->payment_created_at );

				$members[ $row->id ]->addPayment( $payment );
			}
		}

		return $members;
	}
}