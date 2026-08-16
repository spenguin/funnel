<?php

function pvd($var) {

    ob_start(); ?>
        <pre>
            <?php var_dump( $var ); ?>
        </pre>
    <?php
    $o = ob_get_clean();
    echo $o;
}

/**
 * Create options array from larger array
 * @param array data
 * @param string key associated key
 * @param string value value key
 * @return array
 */
// public static function extract_options_array($data, $key, $value) 
function extract_options_array($data, $key, $value) 
{
    $o  = [];
    foreach($data as $d )
    {  
        $o[$d[$key]]    = $d[$value];
    }

    return $o;
}

?>