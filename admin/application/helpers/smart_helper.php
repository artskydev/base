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
	$ses = $CI->session->userdata('adminmeong_login');
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
function user_front($key='')
{
	$CI =& get_instance();
	$ses = $CI->session->userdata('customermeong_login');
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
function get_unique_order()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',15);
	$rand = "P-".$rand;
	$rs = $CI->db->where('pid',$rand)->get('order');
	if($rs->num_rows()>0)
	{
		return get_unique_users_code();
	}
	return $rand;
}
function get_unique_customer_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',6);
	$rs = $CI->db->where('activation_code',$rand)->get('customer');
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
	$message .= '<img src="//'.$_SERVER['SERVER_NAME'].'/uploads/'.config_item('logo').'" alt="'.config_item('site_name').' Activation User" />';
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
    $CI->email->from(get_setting('email'), get_setting('site_name'));
    $CI->email->to($in['email']);
    $CI->email->subject(get_setting('site_name').' Activation User');
    $CI->email->message($message);
    if($CI->email->send())
	{
		
	}
}
function send_mail_link($in = array())
{
	$CI =& get_instance();
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Confirmation Email:</strong> </td><td><a href='".strip_tags($in['urls'])."' target='_blan'>" . strip_tags($in['urls']) . "</a></td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	$CI->load->library('email');
    $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    $CI->email->initialize($config);
    $CI->email->from(config_item('email'), config_item('site_name'));
    $CI->email->to($in['email']);
    $CI->email->subject(config_item('site_name').' Link Confirmation');
    $CI->email->message($message);
    if($CI->email->send())
	{
		return true;
	}
	return false;
}
function send_mail_forgot($in = array())
{
	$CI =& get_instance();
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
    $CI->email->initialize($config);
    $CI->email->from(config_item('email'), config_item('site_name'));
    $CI->email->to($in['email']);
    $CI->email->subject(config_item('site_name').' Link Forgot');
    $CI->email->message($message);
    if($CI->email->send())
	{
		return true;
	}
	return false;
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
function order_read($in = array())
{
	$CI =& get_instance();
	return $CI->db->where('reads',0)->get('order')->num_rows();
}
function order_read_presale($in = array())
{
	$CI =& get_instance();
	return $CI->db->where('reads',0)->get('order')->num_rows();
}
#payment
function varpayment()
{
	$arr = array("Waiting","Approve","Failed");	
	return $arr;
}
function payments($no = "")
{
	$xx = varpayment();
	return isset($xx[$no])?$xx[$no]:"";		
}
function orderpersale_read($in = array())
{
	$CI =& get_instance();
	return $CI->db->where('reads',0)->get('order_presale')->num_rows();
} 
function gen_uuid($len=8) {

    $hex = md5("yourSaltHere" . uniqid("", true));

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
function nft_tipe($no)
{
	$s = array("Fixed Price","","Time Action");	
	return isset($s[$no])?$s[$no]:"";
}