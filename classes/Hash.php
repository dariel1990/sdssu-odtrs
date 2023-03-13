<?php
/**
 * Created by Chris on 9/29/2014 3:55 PM.
 */

class Hash {
    public static function make($string) {
        return hash('sha256', $string);
    }

    public static function unique() {
        return self::make(uniqid());
    }
}