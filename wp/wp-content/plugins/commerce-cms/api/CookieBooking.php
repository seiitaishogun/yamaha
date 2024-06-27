<?php
 
class CookieBooking
{
	
	private $consent;
	
	private	$site_id;
	private	$order_id;
	 
	public $user_customer;
	private $user;

	public function __construct()
	{
		$this->user_customer = new Customer();
		$this->site_id = 'ymh';
		$this->order_id = '0';
		$this->setConsent();
		//$this->respond();
	}
	 
	private function setConsent()
	{
		$this->consent = true; 
		if ( $this->consent ){
			$this->setApprove();
			return;
		}
		$this->setDeny();
	}

	private function setApprove()
	{
		$cookie = array();
		if ( isset($_COOKIE['booking_cookie']) ) {
			$cookie = json_decode(stripslashes($_COOKIE['booking_cookie']), true);
		} else {
			$cookie = $this->user_customer->getBookings();
		}
		 
		setcookie( 'booking_cookie', json_encode( $cookie ), time() + 31556926, "/" );
	}

	private function setDeny()
	{
		$cookie = array();
		 
		setcookie( 'booking_cookie', json_encode( $cookie ), time() + 31556926, "/");
	}

	private function respond()
	{
		wp_send_json([
			'status' => 'success',
			'consent' => $this->consent
		]);
	}
	
	/**
	* Sync a Cookie Booking
	*/
	public function SyncCookie()
	{
		if ( $this->user->isBooking($this->order_id, $this->site_id) ){
			$Bookings = $this->removeBooking();
			setcookie( 'booking_cookie', json_encode( $Bookings ), time() + 31556926, "/" );
			return;
		}
		$Bookings = $this->addBooking();
		setcookie( 'booking_cookie', json_encode( $Bookings ), time() + 31556926, "/" );
		return;
	}

	/**
	* Update User Meta (logged in only)
	*/
	public function updateUserMeta($bookings)
	{
		if ( !is_user_logged_in() ) return;
		update_user_meta( intval(get_current_user_id()), 'booking_cookie', $bookings );
	}
	
	public function updateUserBookings($bookings)
	{
		if ( !is_user_logged_in() ) return;
		update_user_meta( intval(get_current_user_id()), 'booking_cookie', $bookings );
	}

	/**
	* Remove a Booking
	*/
	private function removeCookieBookingItem($item_id)
	{
		$Bookings = $this->user_customer->getBookings($user_id = null, $site_id = $this->site_id, $group_id = null);

		foreach($Bookings as $key => $site_Bookings){
			if ( $site_Bookings['site_id'] !== $this->site_id ) continue;
			foreach($site_Bookings['items'] as $k => $fav){
				if ( $fav == $item_id ) unset($Bookings[$key]['items'][$k]);
			} 
		}
		$this->updateUserMeta($Bookings);
		return $Bookings;
	}

	/**
	* Add a Cookie Booking
	*/
	public function addCookieBookingItem($items=array())
	{
		$Bookings = $this->user_customer->getBookings($user_id = null, $site_id = $this->site_id, $group_id = null);
		 
		// Loop through each site's Booking, continue if not the correct site id
		/*foreach($Bookings as $key => $site_Bookings){ 
			$Bookings[$key]['items'][] = $items;
  
		}*/
		$_COOKIE['booking_cookie']['items'][] = $items;
		$Bookings['booking_cookie']['items'][] = $items;
		
		$this->updateUserMeta($Bookings);
		return $Bookings;
	}
	
	public function getCookieBookings(){
		$Bookings = $this->user_customer->getBookings($user_id = null, $site_id = $this->site_id, $group_id = null);
		return $Bookings;
	}
}