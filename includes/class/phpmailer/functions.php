<?php
function text($data) {
  $data = strip_tags($data);
  $data = mysql_escape_string($data);
  $data = trim($data);
  return $data;
}
function content($data) {
  $data = mysql_escape_string($data);
  return $data;
}

function onlyNumbers($string){ 
    $string = preg_replace("/[^0-9]/", "", $string); 
    return (int) $string; 
}

function limpiar2($String){
    $String = str_replace("'","’",$String);
    $String = str_replace('"',"",$String);
	    $String = strip_tags($String);

    return $String;
}

function limpiar3($String){
 $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
    $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
    $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
    $String = str_replace(array('í','ì','î','ï'),"i",$String);
    $String = str_replace(array('é','è','ê','ë'),"e",$String);
    $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
    $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
    $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
    $String = str_replace(array('ú','ù','û','ü'),"u",$String);
    $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
    $String = str_replace(array('[','^','´','`','¨','~',']',",",".",";",":","¡","!","¿","?","/","*","+","´","{","}","¨","â","ê","î","ô","û", "^","#","|","°","=","[","]","<",">","`","(",")","&","%","$","¬","@","_","\\",'"'),"",$String);
    $String = str_replace("ç","c",$String);
    $String = str_replace("Ç","C",$String);
    $String = str_replace("ñ","n",$String);
    $String = str_replace("Ñ","N",$String);
    $String = str_replace("Ý","Y",$String);
    $String = str_replace("ý","y",$String);
	    return $String;
}

function limpiar($String){
    $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
    $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
    $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
    $String = str_replace(array('í','ì','î','ï'),"i",$String);
    $String = str_replace(array('é','è','ê','ë'),"e",$String);
    $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
    $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
    $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
    $String = str_replace(array('ú','ù','û','ü'),"u",$String);
    $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
    $String = str_replace(array('[','^','´','`','¨','~',']',",",".",";",":","¡","!","¿","?","/","*","+","´","{","}","¨","â","ê","î","ô","û", "^","#","|","°","=","[","]","<",">","`","(",")","&","%","$","¬","@","_","\\",'"'),"",$String);
    $String = str_replace("ç","c",$String);
    $String = str_replace("Ç","C",$String);
    $String = str_replace("ñ","n",$String);
    $String = str_replace("Ñ","N",$String);
    $String = str_replace("Ý","Y",$String);
    $String = str_replace("ý","y",$String);
    $String = str_replace(" ","-",$String);

    $String = str_replace("&aacute;","a",$String);
    $String = str_replace("&Aacute;","A",$String);
    $String = str_replace("&eacute;","e",$String);
    $String = str_replace("&Eacute;","E",$String);
    $String = str_replace("&iacute;","i",$String);
    $String = str_replace("&Iacute;","I",$String);
    $String = str_replace("&oacute;","o",$String);
    $String = str_replace("&Oacute;","O",$String);
    $String = str_replace("&uacute;","u",$String);
    $String = str_replace("&Uacute;","U",$String);
    return $String;
}
// Valida si un email es valido, si el email tiene formato correcto devuelve true
// caso contrario false.
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

//limpia un string de caracteres extraños
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
 
