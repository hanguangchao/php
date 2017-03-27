<?php
/*
PCRE 函数
preg_filter — 执行一个正则表达式搜索和替换
preg_grep — 返回匹配模式的数组条目
preg_last_error — 返回最后一个PCRE正则执行产生的错误代码
preg_match_all — 执行一个全局正则表达式匹配
preg_match — 执行一个正则表达式匹配
preg_quote — 转义正则表达式字符
preg_replace_callback_array — Perform a regular expression search and replace using callbacks
preg_replace_callback — 执行一个正则表达式搜索并且使用一个回调进行替换
preg_replace — 执行一个正则表达式的搜索和替换
preg_split — 通过一个正则表达式分隔字符串
*/


$match = [];
preg_match("/(\w+)A/", "HelloAA", $match);
var_dump($match);

$match = [];
preg_match("/(\w+?)A/", "HelloAA", $match);
var_dump($match);


//模式分隔符后的"i"标记这是一个大小写不敏感的搜索
if (preg_match("/php/i", "PHP is the web scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}

echo PHP_EOL;

/* 模式中的\b标记一个单词边界，所以只有独立的单词"web"会被匹配，而不会匹配
 * 单词的部分内容比如"webbing" 或 "cobweb" */
if (preg_match("/\bweb\b/i", "PHP is the web scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}

echo PHP_EOL;

if (preg_match("/\bweb\b/i", "PHP is the website scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}

echo PHP_EOL;

//从URL中获取主机名称
preg_match('@^(?:http://)?([^/]+)@i',
    "http://www.php.net/index.html", $matches);
$host = $matches[1];

//获取主机名称的后面两部分
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
echo "domain name is: {$matches[0]}\n";

echo PHP_EOL;




//\\2是一个后向引用的示例. 这会告诉pcre它必须匹配正则表达式中第二个圆括号(这里是([\w]+))
//匹配到的结果. 这里使用两个反斜线是因为这里使用了双引号.
$html = "<b>bold text</b><a href=howdy.html>click me</a>";

preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\2>)/", $html, $matches, PREG_SET_ORDER);

foreach ($matches as $val) {
    echo "matched: " . $val[0] . "\n";
    echo "part 1: " . $val[1] . "\n";
    echo "part 2: " . $val[2] . "\n";
    echo "part 3: " . $val[3] . "\n";
    echo "part 4: " . $val[4] . "\n\n";
}

echo PHP_EOL;

if (preg_match('/[<>\\\′"＂&#=\+]/', "张利", $match)) {
    echo "A match was found.";
    var_dump($match);
    var_dump(ord($match[0]));
} else {
    echo "A match was not found.";
}

echo PHP_EOL;

if (preg_match('/[<>\\\′"＂&#=\+]/u', "张利.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}

echo PHP_EOL;
$match = [];
preg_match('/^.$/', '发', $match);
var_dump($match);

$match = [];
preg_match('/^.$/u', '发', $match);
var_dump($match);

echo PHP_EOL;
//多余的空白字符
$str = '     hello world          abc';
echo $str;
echo PHP_EOL;
echo preg_replace("/(?<!\w)\s+/", '', $str);

echo PHP_EOL;
$pattern = '/^(?=[0-9A-Za-z]*?[A-Z])(?=[0-9A-Za-z]*?[a-z])(?=[0-9A-Za-z]*?[0-9])[0-9A-Za-z]{6,16}$/';
$match = [];
preg_match($pattern, 'aaaaaaa', $match);
var_dump($match);

echo PHP_EOL;
$pattern = '/^(?=[0-9A-Za-z]*?[A-Z])(?=[0-9A-Za-z]*?[a-z])(?=[0-9A-Za-z]*?[0-9])[0-9A-Za-z]{6,16}$/';
$match = [];
preg_match($pattern, '0000000', $match);
var_dump($match);

echo PHP_EOL;
$pattern = '/^(?=[0-9A-Za-z]*?[A-Z])(?=[0-9A-Za-z]*?[a-z])(?=[0-9A-Za-z]*?[0-9])[0-9A-Za-z]{6,16}$/';
$match = [];
preg_match($pattern, 'aa00aA', $match);
var_dump($match);

echo PHP_EOL;
$pattern = '/^(?=.*?[a-zA-Z])(?=.*?[0-9])[a-zA-Z0-9]{6,16}$/';
$match = [];
preg_match($pattern, 'aZaaaaa', $match);
var_dump($match);

$pattern = '/^#((?:\\.|[\w-]|[^\x00-\xa0])+)/';

$pattern = '/^\.((?:\\.|[\w-]|[^\x00-\xa0])+)/';


$pattern = '/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i';

//email
$pattern = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/';

/*
\A：匹配一个字符串（string）的开头

\Z：匹配一个字符串（string）的末尾（如果一个字符串包含\n，则匹配\n之前的内容）

\z：匹配一个字符串的末尾

^：匹配一行的开头

$：匹配一行的末尾
 */
// $pattern = '/\A(?=.*[A-Z].*[A-Z])(?=.*[a-z].*[a-z])(?=.*[0-9].*[0-9])(?=.*[^a-zA-Z0-9].*[^a-zA-Z0-9])/';
// $pattern = '/^(?=.*[A-Z].*[A-Z])(?=.*[a-z].*[a-z])(?=.*[0-9].*[0-9])(?=.*[^a-zA-Z0-9].*[^a-zA-Z0-9])/';
$pattern = '/^(?=[0-9A-Za-z]*?[A-Z])(?=[0-9A-Za-z]*?[a-z])(?=[0-9A-Za-z]*?[0-9])[0-9A-Za-z]{6,16}$/';
var_dump(preg_match($pattern, '11111aaaaa', $match));
var_dump(preg_match($pattern, 'aaaaaAAA', $match));
var_dump(preg_match($pattern, 'AAAA11111aaaaa', $match));
var_dump(preg_match($pattern, '11111aaaaaAAA', $match));


// "好租"
// preg_replace($regex, $replace, $subject [, $limit, &$count])


$pattern = '~^
    ((aaa|aaas|about|acap|acct|acr|adiumxtra|afp|afs|aim|apt|attachment|aw|barion|beshare|bitcoin|blob|bolo|callto|cap|chrome|chrome-extension|cid|coap|coaps|com-eventbrite-attendee|content|crid|cvs|data|dav|dict|dlna-playcontainer|dlna-playsingle|dns|dntp|dtn|dvb|ed2k|example|facetime|fax|feed|feedready|file|filesystem|finger|fish|ftp|geo|gg|git|gizmoproject|go|gopher|gtalk|h323|ham|hcp|http|https|iax|icap|icon|im|imap|info|iotdisco|ipn|ipp|ipps|irc|irc6|ircs|iris|iris.beep|iris.lwz|iris.xpc|iris.xpcs|itms|jabber|jar|jms|keyparc|lastfm|ldap|ldaps|magnet|mailserver|mailto|maps|market|message|mid|mms|modem|ms-help|ms-settings|ms-settings-airplanemode|ms-settings-bluetooth|ms-settings-camera|ms-settings-cellular|ms-settings-cloudstorage|ms-settings-emailandaccounts|ms-settings-language|ms-settings-location|ms-settings-lock|ms-settings-nfctransactions|ms-settings-notifications|ms-settings-power|ms-settings-privacy|ms-settings-proximity|ms-settings-screenrotation|ms-settings-wifi|ms-settings-workplace|msnim|msrp|msrps|mtqp|mumble|mupdate|mvn|news|nfs|ni|nih|nntp|notes|oid|opaquelocktoken|pack|palm|paparazzi|pkcs11|platform|pop|pres|prospero|proxy|psyc|query|redis|rediss|reload|res|resource|rmi|rsync|rtmfp|rtmp|rtsp|rtsps|rtspu|secondlife|service|session|sftp|sgn|shttp|sieve|sip|sips|skype|smb|sms|smtp|snews|snmp|soap.beep|soap.beeps|soldat|spotify|ssh|steam|stun|stuns|submit|svn|tag|teamspeak|tel|teliaeid|telnet|tftp|things|thismessage|tip|tn3270|turn|turns|tv|udp|unreal|urn|ut2004|vemmi|ventrilo|videotex|view-source|wais|webcal|ws|wss|wtai|wyciwyg|xcon|xcon-userid|xfire|xmlrpc\.beep|xmlrpc.beeps|xmpp|xri|ymsgr|z39\.50|z39\.50r|z39\.50s))://                                 # protocol
    (([\pL\pN-]+:)?([\pL\pN-]+)@)?          # basic auth
    (
        ([\pL\pN\pS-\.])+(\.?([\pL]|xn\-\-[\pL\pN-]+)+\.?) # a domain name
            |                                              # or
        \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}                 # an IP address
            |                                              # or
        \[
            (?:(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){6})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:::(?:(?:(?:[0-9a-f]{1,4})):){5})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){4})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,1}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){3})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,2}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){2})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,3}(?:(?:[0-9a-f]{1,4})))?::(?:(?:[0-9a-f]{1,4})):)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,4}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,5}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,6}(?:(?:[0-9a-f]{1,4})))?::))))
        \]  # an IPv6 address
    )
    (:[0-9]+)?                              # a port (optional)
    (/?|/\S+|\?\S*|\#\S*)                   # a /, nothing, a / with something, a query or a fragment
$~ixu';


$pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/'
