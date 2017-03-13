<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 3);
ini_set('xdebug.var_display_max_data', 1024);

// var_dump (getlog('matmerge_versions_log.txt'));
function get_vlad_adresses($xml){
  if(file_exists("./files/adresses.txt")){
    $handle = fopen("./files/adresses.txt","r");

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
    $town = $xml->createElement("town");

    $town_name = $xml->createAttribute('name');
    $town_name->value = "Khabarovsk";
    $town->appendChild($town_name);

     $district = $xml -> createElement("district");
     $district_name = $xml -> createAttribute('name');

     $town->appendChild($district);

    foreach($adresses as $key => $value) {
        $district_name -> value = $key;
        $district->appendChild($district_name);

        $town->appendChild($district);
    }

    
    echo "&ltadresses&gt\n<br>";
        echo "&lttown name='Khabarovsk'&gt<br>";
        foreach($adresses as $key => $value) {
            echo "\t&ltdistrict name='".$key."'&gt\n<br>";
                foreach($value as $adr) {
                    $lifts = random_int(1, 8);
                    echo "\t\t&ltaddres lifts='".$lifts."' auditory='".(random_int(800,1000)*$lifts)."' pack_id='".random_int(1,6)."'&gt";
                    echo $adr;
                    echo "&lt/addres&gt <br>\n";
                }
            echo "\t&lt/district&gt\n<br>";
        }
        echo"&lt/town&gt\n<br>";
    //echo "Z/adressesX<br>";

    return $town;
    }
}

function get_adresses($xml){
  if(file_exists("./files/vlad.txt")){
    $handle = fopen("./files/vlad.txt","r");

    $adresses = []; //все адреса по райоонам
    $district; //адреса района
    $distName; //название района
    if($handle){
        $distName = "All";
        while(($line = fgets($handle)) !== false) {
                $district[] = $line;
            }
        }
        $adresses[$distName] = $district;

    $town = $xml->createElement("town");

    $town_name = $xml->createAttribute('name');
    $town_name->value = "Vladivostok";
    $town->appendChild($town_name);

    $district = $xml -> createElement("district");
    $district_name = $xml -> createAttribute('name');
    

    
     
    foreach($adresses as $key => $value) {
        $district_name -> value = $key;
        $district->appendChild($district_name);

        $town->appendChild($district);
    }
    
    //echo "ZadressesX\n";&ltadresses&gt
        echo "&lttown name='Vladivostok'&gt\n";
        foreach($adresses as $key => $value) {
            echo "\t&ltdistrict name='".$key."'&gt\n";
                foreach($value as $adr) {
                    $lifts = random_int(1, 8);
                    echo "\t\t&ltaddres lifts='".$lifts."' auditory='".(random_int(800,1000)*$lifts)."' pack_id='".random_int(1,6)."'&gt";
                    echo $adr;
                    echo "&lt/addres&gt <br>\n";
                }
            echo "\t&lt/district&gt\n<br>";
        }
        echo"&lt/town&gt\n<br>";
    echo "&lt/adresses&gt";

    return $town;
  }
}

$xml = new DOMDocument('1.0','UTF-8');


$xmlTown1 = get_vlad_adresses($xml); ////вернуть town khabarovsk
$xmlTown2 = get_adresses($xml); //вернуть town Vladivostok



$xml_root = $xml->createElement("adresses");
$xml_town = $xml->createElement("town");

$xml_town_attr = $xml->createAttribute('test');
$xml_town_attr->value = "test";
$xml_town->appendChild($xml_town_attr);

$xml_root->appendChild( $xmlTown1 );
$xml_root->appendChild( $xmlTown2 );

$xml->appendChild( $xml_root );
//echo "done";
$xml->save("adresses.xml");
?>