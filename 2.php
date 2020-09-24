<?php 
echo '例子：';
fastcgi_finish_request(); /* 响应完成, 关闭连接 */
 
/* 记录日志 */
file_put_contents('log.txt', '生存还是毁灭,这是个问题.');

