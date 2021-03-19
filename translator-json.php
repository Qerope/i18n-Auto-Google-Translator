<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  $size = 0;
  $last = 0;
  $a = 1;
  $file = $argv[1];
  $from = $argv[2];
  $user = json_decode(file_get_contents($file), true);
  $cc = 0;
  array_map('countItems', $user);
  $langs = explode(',',$argv[3]);
  $langu = "";
  foreach ($langs as $key) {
    $arr = array();
    $arrt = array();      
    $langu = $key;
    $arr = array_map('test_print', $user);
    $a = 1;
    $es = $key;
    file_put_contents($es . ".json", json_encode($arr));
    echo "\n\n\n" . $es . ".json Completed Successfully!\n\n\n" ;
  }
  function test_print($item){
        global $size;
        global $last;
        global $a;
        global $cc;
        global $langu;
        global $from;
        $arr = array();
        echo number_format((float)($size / 1000000), 5, '.', '') . " MB " . progress_bar($a, $cc, " $last Bytes, Current Context: $item\n") ;
        $a = $a + 1;
        if(is_string($item))
            return translate($from, $langu, $item);
        else
            return array_map('test_print', $item);
    }
  function countItems($item){
        global $cc;
        if(!is_string($item))
            array_map('countItems', $item);
        $cc += 1;
    }

  function progress_bar($done, $total, $info="", $width=50) {
    $perc = round(($done * 100) / $total);
    $bar = round(($width * $perc) / 100);
    return sprintf("%s%%[%s>%s]%s\r", $perc, str_repeat("=", $bar), str_repeat(" ", $width-$bar), $info);
  }

  function translate($source, $target, $text) {
      $response 		= requestTranslation($source, $target, $text);
      $translation 	= getSentencesFromJSON($response);
      return $translation;
  }


  function requestTranslation($source, $target, $text) {
      global $size;
      global $last;
      $url = "https://translate.google.com/translate_a/single?client=at&dt=t&dt=ld&dt=qca&dt=rm&dt=bd&dj=1&hl=es-ES&ie=UTF-8&oe=UTF-8&inputm=2&otf=2&iid=1dd3b944-fa62-4b55-b330-74909a99969e";
      $fields = array(
          'sl' => urlencode($source),
          'tl' => urlencode($target),
          'q' => urlencode($text)
      );
      $fields_string = "";
      foreach($fields as $key=>$value) {
          $fields_string .= $key.'='.$value.'&';
      }
      rtrim($fields_string, '&');
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, count($fields));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 120);
      curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_USERAGENT, 'AndroidTranslate/5.3.0.RC02.130475354-53000263 5.1 phone TRANSLATE_OPM5_TEST_1');
      $result = curl_exec($ch);
      $size = $size + curl_getinfo($ch)['request_size'];
      $last = curl_getinfo($ch)['request_size'];
      curl_close($ch);
      return $result;
  }
  function getSentencesFromJSON($json) {
      $sentencesArray = json_decode($json, true);
      $sentences = "";
      $sentences .= $sentencesArray["sentences"][0]["trans"];
      return $sentences;
  }

 ?>
