<?php
function json($output=array(),$security=false)
{
	if($security)
	{
		$output['security'] = token();
	}
	$CI =& get_instance();
	return $CI->output
	->set_status_header(200)
	->set_content_type('application/json','utf-8')
	->set_output(json_encode($output));
}
function token()
{
	$CI =& get_instance();
	return $CI->security->get_csrf_hash();
}
function user_info($key='')
{
	$CI =& get_instance();
	$ses = $CI->session->userdata('artsky_nft_login');
	if(!is_array($ses) && !empty($ses))
	{
		$ses = (array) $ses;
	}
	$output = '';
	if(strpos($key,'.')!==false)
	{
		$ex = explode('.',$key);
		for($i=0;$i<count($ex);$i++)
		{
			if(is_numeric($ex[$i]))
				$ex[$i] = $ex[$i];
			else
				$ex[$i] = "'".$ex[$i]."'";
		}
		eval("\$output=isset(\$ses[".implode("][",$ex)."])?\$ses[".implode("][",$ex)."]:'';");
		return $output;
	}
	if(!empty($key) && isset($ses[$key]))
	{
		return $ses[$key];
	}
	elseif(empty($key) && !isset($ses[$key]))
	{
		return '';
	}
	elseif(empty($key))
	{
		return $ses;
	}
}
function user_brand($key='')
{
	$id = user_info("id");
	$CI =& get_instance(); 	
	$rs = $CI->db->where('id_nft_users',$id)->get("nft_brand")->row_array();
	return isset($rs[$key])?$rs[$key]:"";
}

function user_wallet($key='')
{
	$CI =& get_instance();
	$ses = $CI->session->userdata('artsky_nft_wallet');
	if(!is_array($ses) && !empty($ses))
	{
		$ses = (array) $ses;
	}
	$output = '';
	if(strpos($key,'.')!==false)
	{
		$ex = explode('.',$key);
		for($i=0;$i<count($ex);$i++)
		{
			if(is_numeric($ex[$i]))
				$ex[$i] = $ex[$i];
			else
				$ex[$i] = "'".$ex[$i]."'";
		}
		eval("\$output=isset(\$ses[".implode("][",$ex)."])?\$ses[".implode("][",$ex)."]:'';");
		return $output;
	}
	if(!empty($key) && isset($ses[$key]))
	{
		return $ses[$key];
	}
	elseif(empty($key) && !isset($ses[$key]))
	{
		return '';
	}
	elseif(empty($key))
	{
		return $ses;
	}
}
 
function get_unique_file($name,$path='',$inc=0)
{
	$CI =& get_instance();
	if(empty($path))
	{
		$path = config_item('upload_path');
	}
	$t_name = url_title(pathinfo($name,PATHINFO_FILENAME));
	$t_ext  = pathinfo($name,PATHINFO_EXTENSION);
	$old_name = $name;
	$old_path = $path;
	if($inc>0)
	{
		$name = $t_name.'('.$inc.').'.$t_ext;
	}
	else
	{
		$name = $t_name.'.'.$t_ext;
	}
	if(file_exists($path.$name))
	{
		$name = get_unique_file($old_name,$old_path,$inc+1);
	}
	return $name;
}
function get_unique_file_manage($name,$path='',$inc=0)
{
	$CI =& get_instance();
	if(empty($path))
	{
		$path = config_item('tmp_image_path');
	}
	$t_name = url_title(pathinfo($name,PATHINFO_FILENAME));
	$t_ext  = pathinfo($name,PATHINFO_EXTENSION);
	$old_name = $name;
	$old_path = $path;
	if($inc>0)
	{
		$name = $t_name.'('.$inc.').'.$t_ext;
	}
	else
	{
		$name = $t_name.'.'.$t_ext;
	}
	if(file_exists($path.$name))
	{
		$name = get_unique_file_manage($old_name,$old_path,$inc+1);
	}
	return $name;
}
function getThumb($image,$width,$height,$path='')
{
	$CI =& get_instance();
	$CI->load->library('SmartThumb');
	$path = empty($path)?config_item('upload_path'):$path;
	$info = pathinfo($path.$image);
	if(!file_exists(config_item('cache_path').$info['filename'].'x'.$width.'x'.$height.'.'.$info['extension']))
	{
		$CI->smartthumb->PathImgOld = $path.$image;
		$CI->smartthumb->PathImgNew = config_item('cache_path').$info['filename'].'x'.$width.'x'.$height.'.'.$info['extension'];
		$CI->smartthumb->NewWidth = $width;
		$CI->smartthumb->NewHeight = $height;
		$CI->smartthumb->create_thumbnail_images();
	}
	return $info['filename'].'x'.$width.'x'.$height.'.'.$info['extension'];
}
function getCID($prefix,$id)
{
	$alpha = range('A','Z');
	if($id<100)
	{
		return $prefix.$alpha[0].$alpha[0].$alpha[0].(strlen($id)==1?'0'.$id:$id);
	}
	else
	{	
		$length = strlen($id);
		//get numeric
		$numeric = substr($id,$length-2,2);
		$id = substr($id,0,$length-2);
		$loop_length = strlen($id)>3?3:strlen($id);
		$al = '';
		for($i=0;$i<$loop_length;$i++)
		{
			$al = $al.($alpha[substr($id,$i,1)]);
		}
		$id = substr($id,strlen($al),strlen($id));
		$lt = 4-strlen($al);
		for($i=1;$i<=$lt;$i++)
		{
			$al = 'A'.$al;
		}
		$al = $prefix.substr($al,1,strlen($al));
		return $al.$id.$numeric;
	}
}
 
function getUserIP()
{
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP))
	{
		$ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP))
	{
		$ip = $forward;
	}
	else
	{
		$ip = $remote;
	}

	return $ip;
}
function get_unique_users_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',6);
	$rs = $CI->db->where('activation_code',$rand)->get('users');
	if($rs->num_rows()>0)
	{
		return get_unique_users_code();
	}
	return $rand;
}
function sendmail($in = array())
{
	$CI =& get_instance();
	$message = '<html><body>';
	$message .= '<img src="//'.$_SERVER['SERVER_NAME'].'/uploads/'.get_setting('logo').'" alt="'.get_setting('site_name').' Activation User" />';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Activation Code :</strong> </td><td>" . strip_tags($in['activation_code']) . "</td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	$CI->load->library('email');
    $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    $CI->email->initialize($config);
    $CI->email->from(get_setting('email'), setting('website_title'));
    $CI->email->to($in['email']);
    $CI->email->subject(setting('website_title').' Activation User');
    $CI->email->message($message);
    if($CI->email->send())
	{
		
	}
}

function check_urls($url)
{
	//$url = 'yoururl';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (200==$retcode) {
        return true;
    } else {
		return false;
    }	
	return false;
}
function bulan_name($i = 0)
{
	$v = array("","Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Agus","Sep","Okt","Nov","Des");
	return isset($v[$i])?$v[$i]:"";
}
function bulan_name_long($i = 0)
{
	$v = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober","November","Desember");
	return isset($v[$i])?$v[$i]:"";
}
function get_urls($url)
{
	//$url = 'yoururl';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $resp = curl_exec($ch);
    $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (200==$retcode) {
        return $resp;
    } 
	return "";
}
function post_curl($url,$send)
{
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'mozilla firefox',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $send/*array(
			item1 => 'value',
			item2 => 'value2'
		)*/
	));
	// Send the request & save response to $resp
	
	$resp = curl_exec($curl);
	$retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	// Close request to clear up some resources
	curl_close($curl);	
	//print_r($retcode);
	//exit;
	if (200==$retcode) {
        return $resp;
    } else {
		return false;
    }
	 
}

function getOS($userAgent) {
    // Create list of operating systems with operating system name as array key 
    $oses = array (
        'iPhone'            => '(iPhone)',
        'Windows 3.11'      => 'Win16',
        'Windows 95'        => '(Windows 95)|(Win95)|(Windows_95)',
        'Windows 98'        => '(Windows 98)|(Win98)',
        'Windows 2000'      => '(Windows NT 5.0)|(Windows 2000)',
        'Windows XP'        => '(Windows NT 5.1)|(Windows XP)',
        'Windows 2003'      => '(Windows NT 5.2)',
        'Windows Vista'     => '(Windows NT 6.0)|(Windows Vista)',
        'Windows 7'         => '(Windows NT 6.1)|(Windows 7)',
        'Windows NT 4.0'    => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
        'Windows ME'        => 'Windows ME',
        'Open BSD'          => 'OpenBSD',
        'Sun OS'            => 'SunOS',
        'Linux'             => '(Linux)|(X11)',
        'Safari'            => '(Safari)',
        'Mac OS'            => '(Mac_PowerPC)|(Macintosh)',
        'QNX'               => 'QNX',
        'BeOS'              => 'BeOS',
        'OS/2'              => 'OS/2',
        'Search Bot'        => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
    );
    
    // Loop through $oses array
    foreach($oses as $os => $preg_pattern) {
        // Use regular expressions to check operating system type
        if ( preg_match('@' . $preg_pattern . '@', $userAgent) ) {
            // Operating system was matched so return $oses key
            return $os;
        }
    }
    
    // Cannot find operating system so return Unknown
    
    return 'n/a';
}
#setting
function settings()
{
	$CI =& get_instance();
	return $CI->db->get("setting")->row_array();
}
function setting($name)
{
	$CI =& get_instance();
	$arr = $CI->db->get("setting")->row_array();
	return isset($arr[$name])?$arr[$name]:"";
}
 
function get_unique_seller_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',6);
	$rs = $CI->db->where('verification_code',$rand)->get('seller');
	if($rs->num_rows()>0)
	{
		return get_unique_seller_code();
	}
	return $rand;
}
 
function random_color() {
   return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
} 
function get_mymatch($in = array())
{
	$CI =& get_instance();
	$check = $CI->db->where('address_wallet',user_wallet('wallet_address'))
			->where('id_match',$in['id_match'])
			->get("skor");
	if($check->num_rows()>0)
	{
		return false;
	}
	return true;
}
//
function send_mail_link($in = array())
{
	$CI =& get_instance();
	$configs = email_config();
	 
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Confirmation Email:</strong> </td><td><a href='".strip_tags($in['urls'])."' target='_blan'>" . strip_tags($in['urls']) . "</a></td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	//$CI->load->library('mailer');
	//$CI->mailer->sendEmail($in['email']),);
	
	$CI->load->library('email');
    /*$configs = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    */
	$CI->email->initialize($configs);
    $CI->email->from(config_item('email'), setting('website_title'));
    $CI->email->to($in['email']);
    $CI->email->subject(setting('website_title').' Link Confirmation');
    $CI->email->message($message);
    if($CI->email->send())
	{
		return true;
	}
	return false;
	 
}
function email_config()
{
	/*$config = Array(
		'protocol' => 'smtp',
		  
		'mailtype'  => 'html', 
		//'charset'   => 'iso-8859-1'
	);*/
	$config = Array(
		'protocol' => 'smtp',		'_smtp_auth' => true,		'wordwrap' => true,		'priority' =>3,
		'smtp_host' => 'ssl://smtp.hostinger.com',
		'smtp_port' => 465,
		'smtp_user' => 'noreply@artsky.id',//'info@aleominingpool.com',
		'smtp_pass' => '!Gatekbgt2',//'!Gatekbgt2',
		'mailtype'  => 'html', 		'newline' => "\r\n",
		'charset'   => 'iso-8859-1'
	);
	$config['smtp_timeout'] = '7';
	$config['charset']    = 'utf-8';
	$config['newline']    = "\r\n";
	$config['validation'] = TRUE; 
	return $config;
}
function send_mail_forgot($in = array())
{
	$CI =& get_instance();
	$configs = email_config();
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Confirmation Forgot:</strong> </td><td><a href='".strip_tags($in['urls'])."' target='_blan'>" . strip_tags($in['urls']) . "</a></td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	
	$CI->load->library('email');
    $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    $CI->email->initialize($configs);
    $CI->email->from(config_item('email'), setting('website_title'));
    $CI->email->to($in['email']);
    $CI->email->subject(setting('website_title').' Link Forgot');
    $CI->email->message($message);
    if($CI->email->send())
	{
		return true;
	}
	return false;
 
}
function get_unique_customer_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',8);
	$rs = $CI->db->where('activation_code',$rand)->get('nft_customer');
	if($rs->num_rows()>0)
	{
		return get_unique_users_code();
	}
	return $rand;
}  
function gen_uuid($len=8) {

    $hex = md5("danatul" . uniqid("", true));

    $pack = pack('H*', $hex);
    $tmp =  base64_encode($pack);

    $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);

    $len = max(4, min(128, $len));

    while (strlen($uid) < $len)
        $uid .= gen_uuid(22);

    return substr($uid, 0, $len);
}
function get_profile_id()
{
	$CI =& get_instance();
	 
	$rand = gen_uuid(10);
	$rs = $CI->db->where('uuid',$rand)->get('nft_customer');
	if($rs->num_rows()>0)
	{
		return get_profile_id();
	}
	return $rand;
}
//property
function get_property()
{
	$CI =& get_instance();
	$rs = $CI->db->where('displays',1)->get('nft_category')->result_array(); 
	return $rs;
}
function is_wallet()
{
	$CI =& get_instance();
	$wallet = $CI->session->userdata('artsky_nft_wallet');
	return !empty($wallet)?true:false;	
}
function get_wallet()
{
	$CI =& get_instance();
	$wallet = $CI->session->userdata('artsky_nft_wallet');
	return isset($wallet['wallet_address'])?$wallet['wallet_address']:"";	
}
function get_token_balance()
{
	$CI =& get_instance();
	$wallet = $CI->session->userdata('artsky_nft_wallet');
	return isset($wallet['token_balance'])?$wallet['token_balance']:"0";	
}
function get_token_uri()
{
	$CI =& get_instance();
	 
	$rand = gen_uuid(10);
	$rs = $CI->db->where('tokenuri',$rand)->get('nft_supply');
	if($rs->num_rows()>0)
	{
		return get_token_uri();
	}
	return $rand;
}
function get_function_network($tipe)
{
	$CI =& get_instance(); 
	//$rs = $CI->db->where('network_tipe',$tipe)->where('display',1)->get('network')->row_array(); 
	$rs = $CI->db->where('display',1)->get('network')->row_array(); 
	return $rs;
}
function get_network($name,$tipe)
{
	$CI =& get_instance(); 
	$rs = $CI->db->where('display',1)->get('network')->row_array(); 
	//$CI->db->where('network_tipe',$tipe)->where('display',1)->get('network')->row_array(); 
	
	return isset($rs[$name])?$rs[$name]:"";
}
function gethearts($id)
{
	$CI =& get_instance(); 
	
	$rs = $CI->db
			->where('id_nft_supply',$id) 
			->order_by('id desc')
			->get("nft_heart")->num_rows(); 	
	return $rs;		
}
function set_notif($arr = array())
{
	$CI =& get_instance(); 
	$CI->db->trans_begin();
	$CI->db->insert('nft_notif',$arr);
	$CI->db->trans_commit();
}
function get_notif()
{
	$CI =& get_instance(); 
	$wallet = get_wallet();
	if(!empty($wallet))
	{
		$wallet = strtolower($wallet);
		 
		return $CI->db->where('wallet_to',$wallet)->where_in('type',array(1,2))->where('readed',0)->order_by('id desc')->limit(5)->get('nft_notif')->result_array();
	}
	return array();
}
function get_notif_byfollow()
{
	$CI =& get_instance(); 
	return $CI->db->where('id_nftcustomer',user_info('id'))->where('type',3)->order_by('id desc')->limit(5)->get('nft_notif')->result_array();
	
}
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
function getfollow($id)
{
	$CI =& get_instance(); 
	
	$rs = $CI->db
			->where('nftcustomer_to',$id) 
			->order_by('id desc')
			->get("nft_follow")->num_rows(); 	
	return $rs;		
}

function user_balance($name = "")
{
	$CI =& get_instance();
	$data = $CI->db->where('id',user_info('id'))->get('nft_customer')->row_array();
	return isset($data[$name])?$data[$name]:"0";	
}