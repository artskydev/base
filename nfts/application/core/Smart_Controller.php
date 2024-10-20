<?php
class Smart_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->encryption->initialize(array('driver' => 'openssl'));
		
		$this->checkauth();
		
	}
	private  function checkauth()
	{
		//$ses = $this->session->userdata('artsky_game_login');
		
		$ses = user_wallet("artsky_nft_wallet");
		if(empty($ses))
		{
			redirect('home');
			return;
		} 
		 
		/*$class = $this->router->fetch_class();
		if($class=='login' && !empty($ses))
		{
			redirect('home');
			return;
		}
		if(empty($ses))
		{
			//$this->session->sess_destroy();
			$this->session->unset_userdata('artsky_game_login');
			redirect('login');
			return;
		}*/
		
	}
}