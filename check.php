<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Language Differ</title>
</head>
<body>
<h1>These languages does not found in "EN" translation:</h1>
<?php

$trans_path = "../resources/translation/";
$fa_path = $trans_path . "fa/";
$en_path = $trans_path . "en/";

foreach ( glob( $fa_path . '*.php' ) as $fullpath ) {

    $file_name = str_replace( $fa_path, "", $fullpath );

    if ( file_exists( $en_path . $file_name ) ) {

        $reader_fa = require_once $fa_path . $file_name;
        $reader_en = require_once $en_path . $file_name;

        arrayReader( explode(".", $file_name )[0] , $reader_fa, $reader_en );

    }

}

/**
 * Recursively read two arrays and find differ on indexes
 * @param $file_name
 * @param $reader_fa
 * @param $reader_en
 * @param string $parent
 * @author Mohammadreza Yektamaram <mohammad.1ta@gmail.com>
 * @since 2020-01-01 1:13 PM
 */
function arrayReader( $file_name, $reader_fa, $reader_en, $parent = "" ) {

    foreach( $reader_fa as $key => $value ) {

        if ( is_array( $value ) ) {

            arrayReader( $file_name, $reader_fa[ $key ], $reader_en[ $key ], $parent . "." . $key );

        } else {

            if ( !isset( $reader_en[ $key ] ) ) {
                echo "<div class='box'>" . $file_name . $parent . "." . $key . "</div>";
            }

        }

    }

}

?>
<style>
* { box-sizing: border-box }
html, body { margin: 0; padding: 0; background: #eceef1; }
h1 { display: block; margin: 0 auto; font-weight: normal; font: 17px arial; text-align: center; padding: 10px 0 4px; }
.box { background: #FFF; color: #555; display: inline-block; padding: 6px; float: left; width: 48%; margin: 6px 1%; font: 12px tahoma; border-radius: 2px; box-shadow: 0 1px 2px rgba(0,0,0,.1); }
</style>
</body>
</html>
