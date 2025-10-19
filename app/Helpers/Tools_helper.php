<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

// namespace Tools;
/**
 * Tools class
 */
class Tools {

    public static function pvd($param1) {
        ob_start(); ?>
            <pre>
                <?php var_dump( $var ); ?>
            </pre>
        <?php
        $o = ob_get_clean();
        echo $o;
    }

    public static function extract_options_array($data, $key, $value) 
    {
        $o  = [];
        foreach($data as $d )
        {  
            $o[$d[$key]]    = $d[$value];
        }

        return $o;
    }

}


?>