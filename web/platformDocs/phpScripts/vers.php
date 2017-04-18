<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

// var_dump (getlog('matmerge_versions_log.txt'));

function getver($logname){
  if(file_exists("./logs/".$logname)){
    $ver;
    echo count($verslog);
    $handle = fopen("./logs/".$logname,"r");
    if($handle){
        while(($line = fgets($handle)) !== false){
            if(strpos($line , "v") !== false){
                if(count($verslog) != 0){/* ругается на отсутствие $verlog */
                    $ver[] = $verslog;
                    unset($verslog);
                }
                $verslog['ver'] = $line;
                }else{
                    $verslog['logs'][] = $line;
                }
            }
        }
        $ver[] = $verslog;
        fclose($handle);
        return $ver;
    }else{
        echo "<br>"."файла logs не вижу";
    }
}

?>