<?php
error_reporting(0);

// function random_color(){ 
// $color = substr(md5(time()), 0, 6);
// echo '#'.$color;
// } 
function randomColor(){
 $str = "#";
 for($i = 0 ; $i < 6 ; $i++){
 $randNum = rand(0, 15);
 switch ($randNum) {
 case 10: $randNum = "A"; 
 break;
 case 11: $randNum = "B"; 
 break;
 case 12: $randNum = "C"; 
 break;
 case 13: $randNum = "D"; 
 break;
 case 14: $randNum = "E"; 
 break;
 case 15: $randNum = "F"; 
 break; 
 }
 $str .= $randNum;
 }
 return $str;
}
function fechaletra ($fecha) {

  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $numeroDia." de ".$nombreMes." de ".$anio;
}
function fechaletraabr ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombreMes." ".$numeroDia." ".$anio;
}



function verNavegador($user_agent){
        if(strpos($user_agent, 'Maxthon') !== FALSE)
            return "Maxthon";
        elseif(strpos($user_agent, 'SeaMonkey') !== FALSE)
            return "SeaMonkey";
        elseif(strpos($user_agent, 'Vivaldi') !== FALSE)
            return "Vivaldi";
        elseif(strpos($user_agent, 'Arora') !== FALSE)
            return "Arora";
        elseif(strpos($user_agent, 'Avant Browser') !== FALSE)
            return "Avant Browser";
        elseif(strpos($user_agent, 'Beamrise') !== FALSE)
            return "Beamrise";
        elseif(strpos($user_agent, 'Epiphany') !== FALSE)
            return 'Epiphany';
        elseif(strpos($user_agent, 'Chromium') !== FALSE)
            return 'Chromium';
        elseif(strpos($user_agent, 'Iceweasel') !== FALSE)
            return 'Iceweasel';
        elseif(strpos($user_agent, 'Galeon') !== FALSE)
            return 'Galeon';
        elseif(strpos($user_agent, 'Edge') !== FALSE)
            return 'Microsoft Edge';
        elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
            return 'Internet Explorer';
        elseif(strpos($user_agent, 'MSIE') !== FALSE)
            return 'Internet Explorer';
        elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
            return "Opera Mini";
        elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
            return "Opera";
        elseif(strpos($user_agent, 'Firefox') !== FALSE)
            return 'Mozilla Firefox';
        elseif(strpos($user_agent, 'Chrome') !== FALSE)
            return 'Google Chrome';
        elseif(strpos($user_agent, 'Safari') !== FALSE)
            return "Safari";
        elseif(strpos($user_agent, 'iTunes') !== FALSE)
            return 'iTunes';
        elseif(strpos($user_agent, 'Konqueror') !== FALSE)
            return 'Konqueror';
        elseif(strpos($user_agent, 'Dillo') !== FALSE)
            return 'Dillo';
        elseif(strpos($user_agent, 'Netscape') !== FALSE)
            return 'Netscape';
        elseif(strpos($user_agent, 'Midori') !== FALSE)
            return 'Midori';
        elseif(strpos($user_agent, 'ELinks') !== FALSE)
            return 'ELinks';
        elseif(strpos($user_agent, 'Links') !== FALSE)
            return 'Links';
        elseif(strpos($user_agent, 'Lynx') !== FALSE)
            return 'Lynx';
        elseif(strpos($user_agent, 'w3m') !== FALSE)
            return 'w3m';
        else
            return 'Navegador desconocido';
    }

    function verSO($user_agent){
        if(strpos($user_agent, 'Windows NT 10.0') !== FALSE)
            return "Windows 10";
        elseif(strpos($user_agent, 'Windows NT 6.3') !== FALSE)
            return "Windows 8.1";
        elseif(strpos($user_agent, 'Windows NT 6.2') !== FALSE)
            return "Windows 8";
        elseif(strpos($user_agent, 'Windows NT 6.1') !== FALSE)
            return "Windows 7";
        elseif(strpos($user_agent, 'Windows NT 6.0') !== FALSE)
            return "Windows Vista";
        elseif(strpos($user_agent, 'Windows NT 5.1') !== FALSE)
            return "Windows XP";
        elseif(strpos($user_agent, 'Windows NT 5.2') !== FALSE)
            return 'Windows 2003';
        elseif(strpos($user_agent, 'Windows NT 5.0') !== FALSE)
            return 'Windows 2000';
        elseif(strpos($user_agent, 'Windows ME') !== FALSE)
            return 'Windows ME';
        elseif(strpos($user_agent, 'Win98') !== FALSE)
            return 'Windows 98';
        elseif(strpos($user_agent, 'Win95') !== FALSE)
            return 'Windows 95';
        elseif(strpos($user_agent, 'WinNT4.0') !== FALSE)
            return 'Windows NT 4.0';
        elseif(strpos($user_agent, 'Windows Phone') !== FALSE)
            return 'Windows Phone';
        elseif(strpos($user_agent, 'Windows') !== FALSE)
            return 'Windows';
        elseif(strpos($user_agent, 'iPhone') !== FALSE)
            return 'iPhone';
        elseif(strpos($user_agent, 'iPad') !== FALSE)
            return 'iPad';
        elseif(strpos($user_agent, 'Debian') !== FALSE)
            return 'Debian';
        elseif(strpos($user_agent, 'Ubuntu') !== FALSE)
            return 'Ubuntu';
        elseif(strpos($user_agent, 'Slackware') !== FALSE)
            return 'Slackware';
        elseif(strpos($user_agent, 'Linux Mint') !== FALSE)
            return 'Linux Mint';
        elseif(strpos($user_agent, 'Gentoo') !== FALSE)
            return 'Gentoo';
        elseif(strpos($user_agent, 'Elementary OS') !== FALSE)
            return 'ELementary OS';
        elseif(strpos($user_agent, 'Fedora') !== FALSE)
            return 'Fedora';
        elseif(strpos($user_agent, 'Kubuntu') !== FALSE)
            return 'Kubuntu';
        elseif(strpos($user_agent, 'Linux') !== FALSE)
            return 'Linux';
        elseif(strpos($user_agent, 'FreeBSD') !== FALSE)
            return 'FreeBSD';
        elseif(strpos($user_agent, 'OpenBSD') !== FALSE)
            return 'OpenBSD';
        elseif(strpos($user_agent, 'NetBSD') !== FALSE)
            return 'NetBSD';
        elseif(strpos($user_agent, 'SunOS') !== FALSE)
            return 'Solaris';
        elseif(strpos($user_agent, 'BlackBerry') !== FALSE)
            return 'BlackBerry';
        elseif(strpos($user_agent, 'Android') !== FALSE)
            return 'Android';
        elseif(strpos($user_agent, 'Mobile') !== FALSE)
            return 'Firefox OS';
        elseif(strpos($user_agent, 'Mac OS X+') || strpos($user_agent, 'CFNetwork+') !== FALSE)
            return 'Mac OS X';
        elseif(strpos($user_agent, 'Macintosh') !== FALSE)
            return 'Mac OS Classic';
        elseif(strpos($user_agent, 'OS/2') !== FALSE)
            return 'OS/2';
        elseif(strpos($user_agent, 'BeOS') !== FALSE)
            return 'BeOS';
        elseif(strpos($user_agent, 'Nintendo') !== FALSE)
            return 'Nintendo';
        else
            return 'Desconocido';
    }
    
function efecto(){
$efecto  = [
    "fadeInDown" => "fadeInDown",
    "fadeInDownBig" => "fadeInDown",
    "fadeInLeft" => "fadeInLeft",
    "fadeInLeftBig" => "fadeInLeftBig",
    "fadeInRight" => "fadeInDown",
    "fadeInRightBig" => "fadeInDown",
    "fadeInUp" => "fadeInUp",
    "fadeInUpBig" => "fadeInUpBig",
    "boundeIn" => "boundeIn",
    "bounceInDown" => "bounceInDown",
    "bounceInLeft" => "bounceInLeft",
    "bounceInRight" => "bounceInRight",
    "bounceInUp" => "bounceInUp",
    "lightSpeedIn" => "lightSpeedIn",
    "rollIn" => "rollIn",
    "jackInTheBox" => "jackInTheBox",
    "zoomIn" => "zoomIn",
    "zoomInDown" => "zoomInDown",
    "slideInUp" => "slideInUp",
    "slideInRight" => "slideInRight",
    "slideInLeft" => "slideInLeft",
    "slideInDown" => "slideInDown",
    "zoomInRight" => "zoomInRight",
    "zoomInLeft" => "zoomInLeft",
    "heartBeat" => "heartBeat",
    "rubberBand" => "rubberBand",
];

return " wow ".array_rand($efecto,1)."";
}


function tiempo_slide($sector) {
    if ($sector == "0"){
        return $sector = "1500-1800-2100-2400-2700";
    }
    if ($sector == "1"){
        return $sector = "1400-1700-2500-2000-2500";
    }
    if ($sector == "2"){
        return $sector = "1500-1800-2100-2400-2700";
    }

    // return $sector;
}

//generador de UUID 4
function hash_id() {
 $uuid = array(
  'time_low'  => 0,
  'time_mid'  => 0,
  'time_hi'  => 0,
  'clock_seq_hi' => 0,
  'clock_seq_low' => 0,
  'node'   => array()
 );

 $uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
 $uuid['time_mid'] = mt_rand(0, 0xffff);
 $uuid['time_hi'] = (4 << 12) | (mt_rand(0, 0x1000));
 $uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
 $uuid['clock_seq_low'] = mt_rand(0, 255);

 for ($i = 0; $i < 6; $i++) {
  $uuid['node'][$i] = mt_rand(0, 255);
 }

 $uuid = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
  $uuid['time_low'],
  $uuid['time_mid'],
  $uuid['time_hi'],
  $uuid['clock_seq_hi'],
  $uuid['clock_seq_low'],
  $uuid['node'][0],
  $uuid['node'][1],
  $uuid['node'][2],
  $uuid['node'][3],
  $uuid['node'][4],
  $uuid['node'][5]
 );

 return $uuid;
}



function hash_id2(){
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


function img_pro($foto) {
    if ($foto == "" || strlen($foto) == null):
        return $foto = 'nopic.jpg';
    else :
        return $foto =''.$foto.'';
    endif;
    // return false;
}
function moneda_($valor) {
    
    $valor=number_format($valor, 2, '.', ',');

    return $valor;
}
function sector($sector) {
    if ($sector == "1"){
        return $sector = "Izquierda superior";
    }
    if ($sector == "2"){
        return $sector = "Medio Superior";
    }
    if ($sector != "2" and $sector !='1'){
        return $sector = "Desconocido";
    
    }

    return $sector;
}

function pingDomain($domain){
    $starttime = microtime(true);
    $file      = @fsockopen ($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;
 
    if (!$file) $status = -1;  // Site is down
    else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    
    if ($status <> -1) {
        return true;
    }
 
    return false;
}



function generarrandom($length = 27) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
} 
// comienza conversion de letra a monedas
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el l?ite a 6 d?itos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya lleg?al l?ite m?imo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d?itos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres d?itos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es n?mero redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Mill?, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aqu?si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma l?ica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta l?ea la puedes cambiar de acuerdo a tus necesidades o a tu pa? -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO SOLES Y $xdecimales/100 SOLES";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN SOL Y $xdecimales/100 SOLES ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " Y $xdecimales/100 SOLES "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para M?ico se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta funci? regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}
// termina conversion de letra a monedas

function cerosizq($valor){
 $res = str_pad($valor, 8, '0', STR_PAD_LEFT);
 return $res;
}

function dosdeci($porcentaje){
	$final=round($porcentaje,2, PHP_ROUND_HALF_UP);
	return $final;
	}
function porcentaje($porcentaje){
	$final=$porcentaje/100;
	return $final;
	}
function porcentajeinv($porcentaje){
	$final=$porcentaje*100;
	return $final;
	}

function estado($estado){
        if($estado=='1'){
            return 'Activo';
        }else if ($estado=='2') {
            return 'Inactivo';
        }else if ($estado=='3') {
            return 'Papelera';
        }else{return 'Desconocido';}
    }
function estadonot($estado){
        if($estado=='1'){
            return 'Publicado';
        }else if ($estado=='2') {
            return 'Borrador';
        }else if ($estado=='3') {
            return 'Papelera';
        }else{return 'Desconocido';}
    }
function principal($principal){
        if($principal=='1'){
            return 'Si';
        }else{return 'No';}
    }
function pagado($estado){
        if($estado=='1'){
            return 'Pagado';
        }else{return 'Por pagar';}
    }
function estado_doc($estado){
		if($estado=='1'){
			return 'No enviado';
		}else{return 'Enviado';}
	}

function cortar($str,$chars,$info=  '')
    {
        if ( strlen( $str ) >= $chars )
        {
            $str = preg_replace( '/\s\s+/', ' ', $str );
            $str = strip_tags( $str );
            $str = preg_replace( '/\s\s+/', ' ', $str );
            $str = substr( $str, 0, $chars );
            $str = preg_replace( '/\s\s+/', ' ', $str );
            $arr = explode( ' ', $str );
            array_pop( $arr );
            //$arr = preg_replace('/\&nbsp;/i',' ',$arr);
            $final = implode( ' ', $arr ) . $info;
        }
        else
        {
            $final = $str;
        }
        return $final;
    }

	
	
function hash_password($password, $salt) 
{
    $hash = hash_hmac('SHA512', $password, $salt);
    for ($i = 0; $i < 5000; $i++) 
    {
        $hash = hash_hmac('SHA512', $hash, $salt);
    }
    
    return $hash;
	}
$salt = str_replace('=', '.', base64_encode("?$%&/(L0ret0S0ft)=??"));



function alfanumerico($string){ 
    $string = preg_replace("/[^a-zA-Z0-9\_ -.:]/", "", $string); 
    return $string; 
}
function correos($string){ 
    $string = preg_replace("/[^a-zA-Z0-9\_ @-.]/", "", $string); 
    return $string; 
}

function IPreal()
{
 
    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }
 
}
function dameURL(){
$url="http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
return $url;
}
function text($data) {
  $data = str_replace("<script>","",$data);
  $data = str_replace("</script>","",$data);
  $data = trim($data);
  
  return $data;
}
function textos($data) {
  // $data = strip_tags($data);
  $data = str_replace("<script>","",$data);
  $data = str_replace("'",'"',$data);
  $data = str_replace("</script>","",$data);
  $data = trim($data);
  
  return $data;
}
function contenido($data) {
  // $data = strip_tags($data);
  $data = str_replace("<script>","",$data);
  $data = str_replace("</script>","",$data);
  $data = trim($data);
  
  return $data;
}
function seguridad($data) {
  $data = strip_tags($data);
  $data = str_replace("<script>","",$data);
  $data = str_replace("</script>","",$data);
  $data = str_replace(array("'",'"','=','#','-'),"",$data);
  $data = trim($data);
  
  return $data;
}

function primera($data) {
	$data = ucfirst($data);
  $data = str_replace("-"," ",$data);
  return $data;
}

function titulo($data) {
	$data = ucwords($data);
  $data = str_replace("-"," ",$data);
  return $data;
}

function mayus($data) {
	$data = strtoupper($data);
  $data = str_replace("-"," ",$data);
  return $data;
}


function text2($data) {
	$data = strip_tags($data);
	$data = str_replace("'","",$data);
    $data = str_replace('"',"",$data);
	$data = strip_tags($data);
	$data = trim($data);
	$data = htmlspecialchars($data);
  return $data;
}
function content($data) {
  $data = trim($data);
  return $data;
}
function invertir($String){
    $String = str_replace("-"," ",$String);
    $String = str_replace("_"," ",$String);
    $String = strip_tags($String);

    return $String;
}

function guiones($String){
    $String = str_replace(" ","-",$String);
    $String = strip_tags($String);

    return $String;
}

function letras($string){ 
    $string = htmlentities($string); 
    $string = preg_replace("[^A-Za-z0-9 _]", "", $string); 
    return  $string; 
}

function normales($string){ 
    $string = htmlentities($string); 
    $String = strip_tags($String);
    return  $string; 
}

function onlyNumbers($string){ 
    $string = preg_replace("/[^0-9-.]/", "", $string); 
   // return (int) $string; 
    return $string; 
}

function tags($String){
    $String = str_replace(", ",",",$String);
    $String = str_replace(" ",",",$String);
    $String = str_replace('-',",",$String);
    $String = str_replace('- ',",",$String);
	    $String = strip_tags($String);

    return $String;
}

function limpiar($String){
    $String = htmlentities($String);
    $String = strip_tags($String);
    $String = str_replace("'","-",$String);
    $String = str_replace(" ","-",$String);
    $String = str_replace(array('&iquest;'),"",$String);
    $String = str_replace(array('&aacute;','&Aacute;'),"a",$String);
    $String = str_replace(array('&eacute;','&Eacute;'),"e",$String);
    $String = str_replace(array('&iacute;','&Iacute;'),"i",$String);
    $String = str_replace(array('&oacute;','&Oacute;'),"o",$String);
    $String = str_replace(array('&uacute;','&Uacute;'),"u",$String);
    $String = str_replace(array('&Ntilde;','&ntilde;'),"nn",$String);
    $String = str_replace(array('[','^','?','`','?','~',']',",",".",";",":","?","!","?","?","/","*","+","?","{","}","?", "^","#","|","?","=","[","]","<",">","`","(",")","&","%","$","?","@","_","\\",'"',"~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]","}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;","â€”", "â€“", ",", "<", ".", ">", "/", "?"),"",$String);
    $String = strtolower($String);
    $String = str_replace(array('----'),"-",$String);
    $String = str_replace(array('---'),"-",$String);
    $String = str_replace(array('--'),"-",$String);
    return $String;
}


function isValidEmail($email){
    return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i', $email);
}

// Valida si un email es valido, si el email tiene formato correcto devuelve true
// caso contrario false. para versiones de php 5.2 +
function fnValidateEmail($email)
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}


//limpia un email y se asegura que todo este bien
function SanitizeEmaill($string) {
     return  preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $string );
}

//limpia un email y se asegura que todo este bien
// versiones php 5.2+
function fnSanitizeEmaill($url)
{
  return filter_var($url, FILTER_SANITIZE_EMAIL);
}


// devuelve true si el valor es del tipo numerico
function fnValidateNumber($value)
{
    return is_numeric($value);
}

// devuelve true si el valor es del tipo numerico php5.2+
function fnSanitizeNumber($value)
{
    return filter_var($value, FILTER_SANITIZE_NUMBER_INT); # int
}


//valida que lo que se ingresa sea un string o cadena de caracteres
function fnValidateStringr($str)
{
    return preg_match('/^[A-Za-z\s ]+$/', $str);
}

//limpia un string de caracteres extra?s
function fnSanitizeStringr($str)
{
    return filter_var($str, FILTER_SANITIZE_STRIPPED); # only 'String' is allowed eg. '<br>HELLO</br>' => 'HELLO'
}

//valida que lo que se ingresa sea un alfanumerico, una variable compuesta de numeros y letras
function fnValidateAlphanumeric($string)
{
    return ctype_alnum ($string);
}

// comprueba la existencia de una URL
function url_exist($url)
{
    $url = @parse_url($url);
 
    if (!$url)
    {
        return false;
    }
 
    $url = array_map('trim', $url);
    $url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
    $path = (isset($url['path'])) ? $url['path'] : '';
 
    if ($path == '')
    {
        $path = '/';
    }
 
    $path .= (isset($url['query'])) ? '?$url[query]' : '';
 
    if (isset($url['host']) AND $url['host'] != @gethostbyname($url['host']))
    {
        if (PHP_VERSION >= 5)
        {
            $headers = @get_headers('$url[scheme]://$url[host]:$url[port]$path');
        }
        else
        {
            $fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30);
 
            if (!$fp)
            {
                return false;
            }
            fputs($fp, 'HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n');
            $headers = fread($fp, 4096);
            fclose($fp);
        }
        $headers = (is_array($headers)) ? implode('\n', $headers) : $headers;
        return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
    }
    return false;
}

// valida que una url sea correcta , si esta bien escrita
function fnValidateUrl($url){
	return preg_match('/^(http(s?):\/\/|ftp:\/\/{1})((\w+\.){1,})\w{2,}$/i', $url);
}

// limpia una url de caracteres raros
function fnSanitizeUrl($url)
{
  return filter_var($url, FILTER_SANITIZE_URL);
}

// comprueba si existe una imagen , si la url de la imagen que se ingresa realmente existe.
function image_exist($url) {
if(@file_get_contents($url,0,NULL,0,1)){return 1;}else{ return 0;}
}

// comprueba si el usuario entro directamente o paso por un proxy para ser intentar visitar
// el sitio de manera anonima, con este codigo se consigue la verdadera ip
function fnValidateProxy(){
    if ($_SERVER['HTTP_X_FORWARDED_FOR']
       || $_SERVER['HTTP_X_FORWARDED']
       || $_SERVER['HTTP_FORWARDED_FOR']
       || $_SERVER['HTTP_VIA']
       || in_array($_SERVER['REMOTE_PORT'], array(8080,80,6588,8000,3128,553,554))
       || @fsockopen($_SERVER['REMOTE_ADDR'], 80, $errno, $errstr, 30))
    {
        exit('Proxy detected');
    }
}

// valida un nombre de usuario con un minimo de 6 caracteres
function fnValidateUsername($username){
    #alphabet, digit, @, _ and . are allow. Minimum 6 character. Maximum 50 characters (email address may be more)
    return preg_match('/^[a-zA-Z\d_@.]{6,50}$/i', $username);
}

// retorna true o false si el password es fuerte, tiene 8 caracteres al menos uno en mayuscula uno en minuscula y por lo menos un numero
function fnValidatePassword($password){
    #must contain 8 characters, 1 uppercase, 1 lowercase and 1 number
    return preg_match('/^(?=^.{8,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/', $password);
}

// verifica si un telefono es valido en EEUU
function fnValidateUSPhone($phoneNo){
    return preg_match('/\(?\d{3}\)?[-\s.]?\d{3}[-\s.]\d{4}/x', $phoneNo);
}

// funcion que verifica un codigo postal
function fnValidateUSPostal($postalcode){
    //#eg. 92345-3214
    return preg_match('/^([0-9]{5})(-[0-9]{4})?$/i',$postalcode);
}
// funcion que verifica un numero social para saber si es valido
function fnValidateUSSocialSecurityCode($ssb){
    //#eg. 531-63-5334
    return preg_match('/^[\d]{3}-[\d]{2}-[\d]{4}$/',$ssn);
}

//funcion que valida si el numero de una tarjeta de credito es correcto
function fnValidateCreditCard($cc){
    //#eg. 718486746312031
    return preg_match('/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/', $cc);
}
// funcion php para validar fechas
function fnValidateDate($date){
	/*
    #05/12/2109
    #05-12-0009
    #05.12.9909
    #05.12.99
	*/
    return preg_match('/^((0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01])[- /.][0-9]?[0-9]?[0-9]{2})*$/', $date);
}


//funcion que valida si un color es valido
function fnValidateColor($color){
    #CCC
    #CCCCC
    #FFFFF
    return preg_match('/^#(?:(?:[a-f0-9]{3}){1,2})$/i', $color);
}


// funcion que limpia un string para ser insertado en base de datos de manera segura  evitando sqlinjection
/* para usarlo ... 
_clean($_POST);
_clean($_GET);
_clean($_REQUEST);
*/
function _clean($str){
return is_array($str) ? array_map('_clean', $str) : str_replace('\\', '\\\\', htmlspecialchars((get_magic_quotes_gpc() ? stripslashes($str) : $str), ENT_QUOTES));
}
 
 function convertir($str){
   if (!isset($GLOBALS["carateres_latinos"])){
      $todas = get_html_translation_table(HTML_ENTITIES, ENT_NOQUOTES);
      $etiquetas = get_html_translation_table(HTML_SPECIALCHARS, ENT_NOQUOTES);
      $GLOBALS["carateres_latinos"] = array_diff($todas, $etiquetas);
   }
   $str = strtr($str, $GLOBALS["carateres_latinos"]);
  $str = str_replace("<script>","",$str);
  $str = str_replace("</script>","",$str);
  $str = trim($str);

   return $str;
}


function paginate($reload, $page, $tpages, $adjacents, $tipo) {
    $prevlabel = "&lsaquo; Anterior";
    $nextlabel = "Siguiente &rsaquo;";
    $out = '<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">';
    // previous label

    if($page==1) {
        $out.= '<li class="page-item disabled"><a class="page-link">'.$prevlabel.'</a></li>';
    } else if($page==2) {
        $out.='<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador(1,'.$tipo.',1)">'.$prevlabel.'</a></li>';
    }else {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador(1,'.$tipo.','.($page-1).')">'.$prevlabel.'</a></li>';

    }
    
    // first label
    if($page>($adjacents+1)) {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador(1,'.$tipo.',1)">1</a></li>';
    }
    // interval
    if($page>($adjacents+2)) {
        $out.='<li class="page-item"><a class="page-link">...</a></li>';
    }

    // pages

    $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
    $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
    for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$page) {
            $out.='<li class="active"><a class="page-link">'.$i.'</a></li>';
        }else if($i==1) {
            $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador(1,'.$tipo.',1)">'.$i.'</a></li>';
        }else {
            $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador(1,'.$tipo.','.$i.')">'.$i.'</a></li>';
        }
    }

    // interval

    if($page<($tpages-$adjacents-1)) {
        $out.= '<li class="page-item"><a class="page-link">...</a></li>';
    }

    // last

    if($page<($tpages-$adjacents)) {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador(1,'.$tipo.','.$tpages.')">'.$tpages.'</a></li>';
    }

    // next

    if($page<$tpages) {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador(1,'.$tipo.','.($page+1).')">'.$nextlabel.'</a></li>';
    }else {
        $out.= '<li class="disabled"><a class="page-link">'.$nextlabel.'</a></li>';
    }
    
    $out.= "</ul>
</nav>";
    return $out;
}



function paginateFront($reload, $page, $tpages, $adjacents, $categoria) {
    $prevlabel = "&lsaquo; Anterior";
    $nextlabel = "Siguiente &rsaquo;";
    $out = '<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">';
    // previous label

    if($page==1) {
        $out.= '<li class="page-item disabled"><a class="page-link">'.$prevlabel.'</a></li>';
    } else if($page==2) {
        $out.='<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador('.$categoria.',1)">'.$prevlabel.'</a></li>';
    }else {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador('.$categoria.','.($page-1).')">'.$prevlabel.'</a></li>';

    }
    
    // first label
    if($page>($adjacents+1)) {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador('.$categoria.',1)">1</a></li>';
    }
    // interval
    if($page>($adjacents+2)) {
        $out.='<li class="page-item"><a class="page-link">...</a></li>';
    }

    // pages

    $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
    $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
    for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$page) {
            $out.='<li class="active"><a class="page-link">'.$i.'</a></li>';
        }else if($i==1) {
            $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador('.$categoria.',1)">'.$i.'</a></li>';
        }else {
            $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador('.$categoria.','.$i.')">'.$i.'</a></li>';
        }
    }

    // interval

    if($page<($tpages-$adjacents-1)) {
        $out.= '<li class="page-item"><a class="page-link">...</a></li>';
    }

    // last

    if($page<($tpages-$adjacents)) {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador('.$categoria.','.$tpages.')">'.$tpages.'</a></li>';
    }

    // next

    if($page<$tpages) {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="paginador('.$categoria.','.($page+1).')">'.$nextlabel.'</a></li>';
    }else {
        $out.= '<li class="disabled"><a class="page-link">'.$nextlabel.'</a></li>';
    }
    
    $out.= "</ul>
</nav>";
    return $out;
}