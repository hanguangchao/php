<?php
chdir('/tmp');
umask(0066);
mkdir('test_umask', 0777);
