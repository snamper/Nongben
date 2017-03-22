<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/11
 * Time: 21:12
 */

/**
 * @param $string 明文 或 密文
 * @param string $operation DECODE表示解密,其它表示加密
 * @param string $key 密匙
 * @param int $expiry 密文有效期
 * @return string
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
    // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
    $ckey_length = 4;

    // 密匙
    $key = md5($key ? $key : C('AU_KEY'));

    // 密匙a会参与加解密
    $keya = md5(substr($key, 0, 16));
    // 密匙b会用来做数据完整性验证
    $keyb = md5(substr($key, 16, 16));
    // 密匙c用于变化生成的密文
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
    // 参与运算的密匙
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
    // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    // 产生密匙簿
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    // 核心加解密部分
    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        // 从密匙簿得出密匙进行异或，再转成字符
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {
        // substr($result, 0, 10) == 0 验证数据有效性
        // substr($result, 0, 10) - time() > 0 验证数据有效性
        // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
        // 验证数据有效性，请看未加密明文的格式
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
        // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}

/**
 * 系统邮件发送函数
 * @param string $to    接收邮件者邮箱
 * @param string $name  接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body    邮件内容
 * @param string $attachment 附件列表
 * @return boolean
 */
function send_mail($to, $name, $subject = '', $body = '', $attachment = null){
    $config = C('THINK_EMAIL');
    vendor('PHPMailer.PHPMailerAutoload'); //从PHPMailer目录导class.phpmailer.php类文件
    $mail             = new PHPMailer(); //PHPMailer对象
    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();  // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    //$mail->SMTPSecure = 'ssl';                 // 使用安全协议
    $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
    $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
    $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
    $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
    $replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
    $replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject    = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if(is_array($attachment)){ // 添加附件
        foreach ($attachment as $file){
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}

/**
 * 汉字转拼音
 * @param $chinese
 * @param bool $flag true:去掉默认的空格分割
 * @return mixed
 */
function pinyin($chinese,$flag=false){
    vendor('ChinesePinyin.ChinesePinyin#class');
    $Pinyin = new ChinesePinyin();

    if($flag){
        return preg_replace_callback('/\s+/',function(){
            return '';
        },$Pinyin->TransformWithoutTone($chinese,' '));
    }else{
        return $Pinyin->TransformWithoutTone($chinese,' ');
    }

}

/**
 * 根据文件后缀获取mime类型
 * @param  string $ext 文件后缀
 * @return string      mime类型
 */
function get_mime_type($ext){
    static $mime_types = array (
        'apk'     => 'application/vnd.android.package-archive',
        '3gp'     => 'video/3gpp',
        'ai'      => 'application/postscript',
        'aif'     => 'audio/x-aiff',
        'aifc'    => 'audio/x-aiff',
        'aiff'    => 'audio/x-aiff',
        'asc'     => 'text/plain',
        'atom'    => 'application/atom+xml',
        'au'      => 'audio/basic',
        'avi'     => 'video/x-msvideo',
        'bcpio'   => 'application/x-bcpio',
        'bin'     => 'application/octet-stream',
        'bmp'     => 'image/bmp',
        'cdf'     => 'application/x-netcdf',
        'cgm'     => 'image/cgm',
        'class'   => 'application/octet-stream',
        'cpio'    => 'application/x-cpio',
        'cpt'     => 'application/mac-compactpro',
        'csh'     => 'application/x-csh',
        'css'     => 'text/css',
        'dcr'     => 'application/x-director',
        'dif'     => 'video/x-dv',
        'dir'     => 'application/x-director',
        'djv'     => 'image/vnd.djvu',
        'djvu'    => 'image/vnd.djvu',
        'dll'     => 'application/octet-stream',
        'dmg'     => 'application/octet-stream',
        'dms'     => 'application/octet-stream',
        'doc'     => 'application/msword',
        'dtd'     => 'application/xml-dtd',
        'dv'      => 'video/x-dv',
        'dvi'     => 'application/x-dvi',
        'dxr'     => 'application/x-director',
        'eps'     => 'application/postscript',
        'etx'     => 'text/x-setext',
        'exe'     => 'application/octet-stream',
        'ez'      => 'application/andrew-inset',
        'flv'     => 'video/x-flv',
        'gif'     => 'image/gif',
        'gram'    => 'application/srgs',
        'grxml'   => 'application/srgs+xml',
        'gtar'    => 'application/x-gtar',
        'gz'      => 'application/x-gzip',
        'hdf'     => 'application/x-hdf',
        'hqx'     => 'application/mac-binhex40',
        'htm'     => 'text/html',
        'html'    => 'text/html',
        'ice'     => 'x-conference/x-cooltalk',
        'ico'     => 'image/x-icon',
        'ics'     => 'text/calendar',
        'ief'     => 'image/ief',
        'ifb'     => 'text/calendar',
        'iges'    => 'model/iges',
        'igs'     => 'model/iges',
        'jnlp'    => 'application/x-java-jnlp-file',
        'jp2'     => 'image/jp2',
        'jpe'     => 'image/jpeg',
        'jpeg'    => 'image/jpeg',
        'jpg'     => 'image/jpeg',
        'js'      => 'application/x-javascript',
        'kar'     => 'audio/midi',
        'latex'   => 'application/x-latex',
        'lha'     => 'application/octet-stream',
        'lzh'     => 'application/octet-stream',
        'm3u'     => 'audio/x-mpegurl',
        'm4a'     => 'audio/mp4a-latm',
        'm4p'     => 'audio/mp4a-latm',
        'm4u'     => 'video/vnd.mpegurl',
        'm4v'     => 'video/x-m4v',
        'mac'     => 'image/x-macpaint',
        'man'     => 'application/x-troff-man',
        'mathml'  => 'application/mathml+xml',
        'me'      => 'application/x-troff-me',
        'mesh'    => 'model/mesh',
        'mid'     => 'audio/midi',
        'midi'    => 'audio/midi',
        'mif'     => 'application/vnd.mif',
        'mov'     => 'video/quicktime',
        'movie'   => 'video/x-sgi-movie',
        'mp2'     => 'audio/mpeg',
        'mp3'     => 'audio/mpeg',
        'mp4'     => 'video/mp4',
        'mpe'     => 'video/mpeg',
        'mpeg'    => 'video/mpeg',
        'mpg'     => 'video/mpeg',
        'mpga'    => 'audio/mpeg',
        'ms'      => 'application/x-troff-ms',
        'msh'     => 'model/mesh',
        'mxu'     => 'video/vnd.mpegurl',
        'nc'      => 'application/x-netcdf',
        'oda'     => 'application/oda',
        'ogg'     => 'application/ogg',
        'ogv'     => 'video/ogv',
        'pbm'     => 'image/x-portable-bitmap',
        'pct'     => 'image/pict',
        'pdb'     => 'chemical/x-pdb',
        'pdf'     => 'application/pdf',
        'pgm'     => 'image/x-portable-graymap',
        'pgn'     => 'application/x-chess-pgn',
        'pic'     => 'image/pict',
        'pict'    => 'image/pict',
        'png'     => 'image/png',
        'pnm'     => 'image/x-portable-anymap',
        'pnt'     => 'image/x-macpaint',
        'pntg'    => 'image/x-macpaint',
        'ppm'     => 'image/x-portable-pixmap',
        'ppt'     => 'application/vnd.ms-powerpoint',
        'ps'      => 'application/postscript',
        'qt'      => 'video/quicktime',
        'qti'     => 'image/x-quicktime',
        'qtif'    => 'image/x-quicktime',
        'ra'      => 'audio/x-pn-realaudio',
        'ram'     => 'audio/x-pn-realaudio',
        'ras'     => 'image/x-cmu-raster',
        'rdf'     => 'application/rdf+xml',
        'rgb'     => 'image/x-rgb',
        'rm'      => 'application/vnd.rn-realmedia',
        'roff'    => 'application/x-troff',
        'rtf'     => 'text/rtf',
        'rtx'     => 'text/richtext',
        'sgm'     => 'text/sgml',
        'sgml'    => 'text/sgml',
        'sh'      => 'application/x-sh',
        'shar'    => 'application/x-shar',
        'silo'    => 'model/mesh',
        'sit'     => 'application/x-stuffit',
        'skd'     => 'application/x-koan',
        'skm'     => 'application/x-koan',
        'skp'     => 'application/x-koan',
        'skt'     => 'application/x-koan',
        'smi'     => 'application/smil',
        'smil'    => 'application/smil',
        'snd'     => 'audio/basic',
        'so'      => 'application/octet-stream',
        'spl'     => 'application/x-futuresplash',
        'src'     => 'application/x-wais-source',
        'sv4cpio' => 'application/x-sv4cpio',
        'sv4crc'  => 'application/x-sv4crc',
        'svg'     => 'image/svg+xml',
        'swf'     => 'application/x-shockwave-flash',
        't'       => 'application/x-troff',
        'tar'     => 'application/x-tar',
        'tcl'     => 'application/x-tcl',
        'tex'     => 'application/x-tex',
        'texi'    => 'application/x-texinfo',
        'texinfo' => 'application/x-texinfo',
        'tif'     => 'image/tiff',
        'tiff'    => 'image/tiff',
        'tr'      => 'application/x-troff',
        'tsv'     => 'text/tab-separated-values',
        'txt'     => 'text/plain',
        'ustar'   => 'application/x-ustar',
        'vcd'     => 'application/x-cdlink',
        'vrml'    => 'model/vrml',
        'vxml'    => 'application/voicexml+xml',
        'wav'     => 'audio/x-wav',
        'wbmp'    => 'image/vnd.wap.wbmp',
        'wbxml'   => 'application/vnd.wap.wbxml',
        'webm'    => 'video/webm',
        'wml'     => 'text/vnd.wap.wml',
        'wmlc'    => 'application/vnd.wap.wmlc',
        'wmls'    => 'text/vnd.wap.wmlscript',
        'wmlsc'   => 'application/vnd.wap.wmlscriptc',
        'wmv'     => 'video/x-ms-wmv',
        'wrl'     => 'model/vrml',
        'xbm'     => 'image/x-xbitmap',
        'xht'     => 'application/xhtml+xml',
        'xhtml'   => 'application/xhtml+xml',
        'xls'     => 'application/vnd.ms-excel',
        'xml'     => 'application/xml',
        'xpm'     => 'image/x-xpixmap',
        'xsl'     => 'application/xml',
        'xslt'    => 'application/xslt+xml',
        'xul'     => 'application/vnd.mozilla.xul+xml',
        'xwd'     => 'image/x-xwindowdump',
        'xyz'     => 'chemical/x-xyz',
        'zip'     => 'application/zip'
    );

    return isset($mime_types[$ext]) ? $mime_types[$ext] : 'application/octet-stream';
}

/**
 * 字符串截取，支持中文和其他编码
 * static
 * access public
 * @param string $str 需要转换的字符串
 * @param int|string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param bool|string $suffix 截断显示字符
 * @return string
 */
function mc_substr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }

    if(function_exists("mb_strlen")){
        $strlen = mb_strlen($str);
    }else{
        $strlen = strlen($str);
    }
    return $suffix ? (($strlen > $length && !empty($str)) ? $slice.'...' : $slice) : $slice;
}

/**
 * @param $data 二维码包含的文字内容
 * @param $filename 保存二维码输出的文件名称，*.png
 * @param bool $picPath 二维码输出的路径
 * @param bool $logo 二维码中包含的LOGO图片路径
 * @param string $size 二维码的大小
 * @param string $level 二维码编码纠错级别：L、M、Q、H
 * @param int $padding 二维码边框的间距
 * @param bool $saveandprint 是否保存到文件并在浏览器直接输出，true:同时保存和输出，false:只保存文件
 * @return string|保存二维码输出的文件名称
 */
function qrcode($data,$filename,$picPath=false,$logo=false,$size='8',$level='H',$padding=2,$saveandprint=false){
    vendor("phpqrcode.phpqrcode");//引入工具包

    $path = $picPath ? C('PUBLIC_UPLOAD_PATH'). 'uploads/QRcodes/' . $picPath :
        C('PUBLIC_UPLOAD_PATH'). 'uploads/QRcodes/admin'; //图片输出路径

    if(!is_dir($path)){
        mkdir($path,0777,true);
    }

    //在二维码上面添加LOGO
    if(empty($logo) || $logo=== false) { //不包含LOGO
        if ($filename==false) {
            QRcode::png($data, false, $level, $size, $padding, $saveandprint); //直接输出到浏览器，不含LOGO
        }else{
            $filename=$path.'/'.$filename .'.png'; //合成路径
            QRcode::png($data, $filename, $level, $size, $padding, $saveandprint); //直接输出到浏览器，不含LOGO
        }
    }else {
        //包含LOGO
        if ($filename == false) {
            //$filename=tempnam('','').'.png';//生成临时文件
            die('参数错误');
        } else {
            //生成二维码,保存到文件
            $filename = $path . '\\' . $filename; //合成路径
        }
        QRcode::png($data, $filename, $level, $size, $padding);
        $QR = imagecreatefromstring(file_get_contents($filename));
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        $logo_qr_width = $QR_width / 5;
        $scale = $logo_width / $logo_qr_width;
        $logo_qr_height = $logo_height / $scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;
        $from_height = ($QR_height - $logo_qr_height) / 2;
        imagecopyresampled($QR, $logo, $from_width, $from_height, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        if ($filename === false) {
            Header("Content-type: image/png");
            imagepng($QR);
        }else {
            if ($saveandprint === true) {
                imagepng($QR, $filename);
                header("Content-type: image/png");//输出到浏览器
                imagepng($QR);
            } else {
                imagepng($QR, $filename);
            }
        }
    }

    return $filename;
}

/**
 * 将字符串转换为指定的编码格式
 * @param $data
 * @param string $to
 * @return array|string
 */
function php_charset($data, $to='UTF-8') {
    if(is_array($data)) {
        foreach($data as $key => $val) {
            $data[$key] = php_charset($val, $to);
        }
    } else {
        $encode_array = array('ASCII', 'UTF-8', 'GBK', 'GB2312', 'BIG5');
        $encoded = mb_detect_encoding($data, $encode_array);
        $to = strtoupper($to);
        if($encoded != $to) {
            $data = mb_convert_encoding($data, $to, $encoded);
        }
    }
    return $data;
}

/**
 * 判断访问设备是手机还是PC端
 * @return bool
 */
function isMobile(){// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))  return true; //此条摘自TPM智能切换模板引擎，适合TPM开发
    if (isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])  return true; //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))//找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;//判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array( 'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile');//从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }//协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {// 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
    return false;
}

/**
 * discuz中检查手机端还是PC端
 * @return bool|string
 */
function checkmobile() {
    global $_G;
    $mobile = array();
    static $touchbrowser_list =array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
        'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
        'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
        'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
        'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
        'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
        'benq', 'haier', '^lct', '320x320', '240x320', '176x220', 'windows phone');
    static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom',
        'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh',
        'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');

    static $pad_list = array('ipad');

    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

    if(dstrpos($useragent, $pad_list)) {
        return false;
    }
    if(($v = dstrpos($useragent, $touchbrowser_list, true))){
        $_G['mobile'] = $v;
        return '2';
    }
    if(($v = dstrpos($useragent, $wmlbrowser_list))) {
        $_G['mobile'] = $v;
        return '3'; //wml版
    }
    $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
    if(dstrpos($useragent, $brower)) return false;

    $_G['mobile'] = 'unknown';
    if(isset($_G['mobiletpl'][$_GET['mobile']])) {
        return true;
    } else {
        return false;
    }
}

function dstrpos($string, $arr, $returnvalue = false) {
    if(empty($string)) return false;
    foreach((array)$arr as $v) {
        if(strpos($string, $v) !== false) {
            $return = $returnvalue ? $v : true;
            return $return;
        }
    }
    return false;
}


/**
 * 随机字符
 * @param number $length 长度
 * @param string $type 类型
 * @param number $convert 转换大小写
 * @return string
 */
function random($length=6, $type='string', $convert=0){
    $config = array(
        'number'=>'1234567890',
        'letter'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string'=>'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );

    if(!isset($config[$type])) $type = 'string';
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) -1;
    for($i = 0; $i < $length; $i++){
        $code .= $string{mt_rand(0, $strlen)};
    }
    if(!empty($convert)){
        $code = ($convert > 0)? strtoupper($code) : strtolower($code);
    }
    return $code;
}