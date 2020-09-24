<?php 

/**
 * Stream 基础知识
 * Stream 可以通过<scheme>://<target>方式来引用。其中<scheme>是包装类的名字，<target>中的内容是由包装类的语法指定，不同的包装类的语法会有所不同。

 * PHP默认的包装类是file://，也就是说我们在访问文件系统的时候，其实就是在使用一个stream。
 * 我们可以通过下面两种方式来读取文件中的内容，readfile('/path/to/somefile.txt')或者readfile('file:///path/to/somefile.txt')，这两种方式是等效的。
 * 如果你是使用readfile('http://google.com/')，那么PHP会选取HTTP stream包装类来进行操作。
 * 正如上文所述，PHP提供了不少内建的包转类，protocol以及filter。 按照下文所述的方式，可以查询到本机所支持的包装类：
 */

print_r(stream_get_transports());
print_r(stream_get_wrappers());
print_r(stream_get_filters());

/**
 * Array
(
    [0] => tcp
    [1] => udp
    [2] => unix
    [3] => udg
    [4] => ssl
    [5] => sslv3
    [6] => tls
    [7] => tlsv1.0
    [8] => tlsv1.1
    [9] => tlsv1.2
)
Array
(
    [0] => https
    [1] => ftps
    [2] => compress.zlib
    [3] => compress.bzip2
    [4] => php
    [5] => file
    [6] => glob
    [7] => data
    [8] => http
    [9] => ftp
    [10] => phar
    [11] => zip
)
Array
(
    [0] => zlib.*
    [1] => bzip2.*
    [2] => convert.iconv.*
    [3] => string.rot13
    [4] => string.toupper
    [5] => string.tolower
    [6] => string.strip_tags
    [7] => convert.*
    [8] => consumed
    [9] => dechunk
)
 */