<?php 
 
class Customer 
{
	 
	public function __construct()
	{
		 
	} 
	/**
	* Get All of current user's Bookings (includes all sites)
	* @return array (multidimensional)
	*/
	public function getAllBookings()
	{
		if ( is_user_logged_in() ) {
			$all_bookings = $this->getLoggedInBookings();
		} else {
			$all_bookings = $this->getCookieBookings() ; 	
		}
		 
		return $all_bookings;
	}

	/**
	* Get User's Bookings by Site ID (includes a single site)
	* @return array (flat)
	*/
	public function getBookings($user_id = null, $site_id = null, $group_id = null)
	{
		if ( is_user_logged_in() && !$user_id ) $user_id = get_current_user_id();
		if ( is_user_logged_in() || $user_id ) {
			$bookings = $this->getLoggedInBookings($user_id, $site_id, $group_id);
		} else { 
			$bookings =  $this->getCookieBookings($site_id, $group_id) ;
		} 
		return $bookings;
	}

	 
	/**
	* Get Logged In User Bookings
	*/
	private function getLoggedInBookings($user_id = null, $site_id = null, $group_id = null)
	{
		$user_id = ( is_null($user_id) ) ? get_current_user_id() : $user_id;
		$bookings = get_user_meta($user_id, 'booking_cookie');
		if ( empty($bookings) ) return array(array('site_id'=> 'ymh', 'order' => array(), 'items' => array())); 
 
		return $bookings;
	}
 

	/**
	* Get Cookie Bookings
	*/
	private function getCookieBookings($site_id = null, $group_id = null)
	{
		if ( !isset($_COOKIE['booking_cookie']) ) $_COOKIE['booking_cookie'] = json_encode([]);
		$bookings = json_decode(stripslashes($_COOKIE['booking_cookie']), true); 
		  
		return $bookings;
	}
  
	/**
	* Has the user consented to cookies (if applicable)
	*/
	public function consentedToCookies()
	{
		
		if ( isset($_COOKIE['booking_cookie']) ){
			$cookies = json_decode(stripslashes($_COOKIE['booking_cookie']), true);
			if ( isset($cookies[0]['consent_provided']) ) return true;
			if ( isset($cookies[0]['consent_denied']) ) return false;
		}
		return false;
	}

	/**
	* Has the user denied consent to cookies explicitly
	*/
	public function deniedCookies()
	{
		if ( isset($_COOKIE['booking_cookie']) ){
			$cookie = json_decode(stripslashes($_COOKIE['booking_cookie']), true);
			if ( isset($cookie[0]['consent_denied']) ) return true;
		}
		return false;
	}
}