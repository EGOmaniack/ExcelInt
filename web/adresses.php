<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 3);
ini_set('xdebug.var_display_max_data', 1024);

// var_dump (getlog('matmerge_versions_log.txt'));

function getadresses(){
  if(file_exists("./files/adresses.xml")){
    $handle = fopen("./files/adresses.xml","r");

    $adresses = []; //все адреса по райоонам
    $district; //адреса района
    $distName; //название района
    if($handle){
        while(($line = fgets($handle)) !== false) {
            
            if (strpos($line, "район") !== false) {
                if(count($district) > 0){
                    $adresses[$distName] = $district;
                    unset($district);
                }
                $distName = $line;
            }else{
                $district[] = $line;
            }
        }
    }
    //var_dump($adresses);
    
    echo "ZadressesX\n";
        foreach($adresses as $key => $value) {
            echo "\tZdistrict name='".$key."'X\n";
                foreach($value as $adr) {
                    echo "\t\tZaddres firm_id='".random_int (1,2)."' pack_id='".random_int(1,6)."'";
                    echo $adr;
                    echo "Z/addresX <br>\n";
                }
            echo "\tZ/districtX\n";
        }
    echo "Z/adressesX";
    }
}
getadresses();
?>