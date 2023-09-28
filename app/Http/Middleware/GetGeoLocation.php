<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Common;

class GetGeoLocation {

    /**
     * purpose : To get IP Address
     * @author : Trideep Dakua
     * @email  : <trideepdakua@gmail.com>
     * @return String
     */
    public static function getIpaddress(){
        return isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    }

    /**
     * purpose : To get browser related information
     * @author : Trideep Dakua
     * @email  : <trideepdakua@gmail.com>
     * @return Array
     */
    public static function getDeviceBrowserInfo($server)
    {
        $u_agent = isset($server['HTTP_USER_AGENT']) ? $server['HTTP_USER_AGENT'] : '';
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";
        if (!empty($u_agent)) {
            try {
                //First get the platform?
                if (preg_match('/linux|ubuntu/i', $u_agent)) {
                    $platform = 'linux';
                } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
                    $platform = 'mac';
                } elseif (preg_match('/windows|win|win32/i', $u_agent)) {
                    $platform = 'windows';
                } elseif (preg_match('/iphone/i', $u_agent)) {
                    $platform = 'iphone';
                } elseif (preg_match('/ipad/i', $u_agent)) {
                    $platform = 'ipad';
                } elseif (preg_match('/ipod/i', $u_agent)) {
                    $platform = 'ipod';
                } elseif (preg_match('/blackberry/i', $u_agent)) {
                    $platform = 'blackberry';
                } elseif (preg_match('/android/i', $u_agent)) {
                    $platform = 'android';
                }

                // Next get the name of the useragent yes seperately and for good reason
                if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
                    $bname = 'Internet Explorer';
                    $ub = "MSIE";
                } elseif (preg_match('/Firefox/i', $u_agent)) {
                    $bname = 'Mozilla Firefox';
                    $ub = "Firefox";
                } elseif (preg_match('/OPR/i', $u_agent)) {
                    $bname = 'Opera';
                    $ub = "Opera";
                } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
                    $bname = 'Google Chrome';
                    $ub = "Chrome";
                } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
                    $bname = 'Apple Safari';
                    $ub = "Safari";
                } elseif (preg_match('/Netscape/i', $u_agent)) {
                    $bname = 'Netscape';
                    $ub = "Netscape";
                } elseif (preg_match('/Edge/i', $u_agent)) {
                    $bname = 'Edge';
                    $ub = "Edge";
                } elseif (preg_match('/Trident/i', $u_agent)) {
                    $bname = 'Internet Explorer';
                    $ub = "MSIE";
                }

                // finally get the correct version number
                $known = array('Version', $ub, 'other');
                $pattern = '#(?<browser>' . join('|', $known) .
                        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
                if (!preg_match_all($pattern, $u_agent, $matches)) {
                    // we have no matching number just continue
                }
                // see how many we have
                $i = count($matches['browser']);
                if ($i != 1) {
                    //we will have two since we are not using 'other' argument yet
                    //see if version is before or after the name
                    if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                        $version = $matches['version'][0];
                    } else {
                        $version = $matches['version'][1];
                    }
                } else {
                    $version = $matches['version'][0];
                }

                // check if we have a number
                if ($version == null || $version == "") {
                    $version = "?";
                }
            } catch (Exception $php_errormsg) {
                echo $php_errormsg->getMessage();
            }
        }
        return array(
            'user_agent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform
        );
    }
    
    /**
     * purpose : To get location information
     * @author : Trideep Dakua
     * @email  : <trideepdakua@gmail.com>
     * @return Array
     */
    public static function getGeoLocationInfo($ip){
        return unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
    }
}

