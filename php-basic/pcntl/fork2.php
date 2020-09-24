<?php 


DEFINE(MAXPROCESS,25); 

for ($i=0;$i<100;$i++){ 
    $pid = pcntl_fork(); 
    
    if ($pid == -1) { 
       die("could not fork"); 
    } elseif ($pid) { 
                echo "I'm the Parent $i\n"; 
        $execute++; 
        if ($execute>=MAXPROCESS){ 
            pcntl_wait($status); 
            $execute--; 
        } 
    } else { 
       echo "I am the child, $i pid = $pid \n"; 
       sleep(rand(1,3)); 
       echo "Bye Bye from $i\n";        
       exit; 
    } 
} 