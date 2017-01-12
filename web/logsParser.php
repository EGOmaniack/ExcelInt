<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

// var_dump (getlog('matmerge_versions_log.txt'));

function getlog($logname){
  if(file_exists("./logs/".$logname)){
    $ver;
    $handle = fopen("./logs/".$logname,"r");
    if($handle){
        while(($line = fgets($handle)) !== false){
            if(strpos($line , "v") !== false/*substr($line, 0, 1) === 'v'*/){
                if(count($verslog) != 0){
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