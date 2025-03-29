<?php



file_put_contents('log/'.date("Y-m-d").'clicklog.txt',date("Y-m-d H:i:s")."|".ip()."|".$_GET['d'].'|'.$_SERVER['HTTP_USER_AGENT'].PHP_EOL,FILE_APPEND);


function ip()
{
    // 判断是否使用 Cloudflare 代理
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        // Cloudflare 代理下获取用户真实 IP 地址
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // 如果存在 HTTP_X_FORWARDED_FOR 头部，可能是代理
        $ipAddresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ipAddress = trim(end($ipAddresses));

        // 检查 IP 是否是私有或保留地址，如果是，则返回 REMOTE_ADDR
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return $ipAddress;
        }
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // 如果存在 HTTP_CLIENT_IP 头部
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // 如果上述条件都不满足，则使用 REMOTE_ADDR
    return $_SERVER['REMOTE_ADDR'];
}

?>