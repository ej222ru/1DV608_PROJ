<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserClient
 *
 * @author User
 */

class UserClient {
	private $remoteAddr;
	private $userAgent;

	public function __construct($remoteAddr, $userAgent) {
		$this->remoteAddr = $remoteAddr;
		$this->userAgent = $userAgent;
	}

	public function isSame(UserClient $other) {
		return  $other->remoteAddr == $this->remoteAddr && 
				$other->userAgent == $this->userAgent;
	}
}