<?php 


exec("kill -l", $signal);
// var_dump($signal_constants);
foreach ($signal as $constant) {
    $constant = 'SIG'.$constant;
    try {
        echo sprintf("%s = %d\n", $constant, constant($constant));
    } catch (Exception $e) {
        continue;
    }
    
}

