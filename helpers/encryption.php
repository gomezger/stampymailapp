<?php

class Encryption {


    static function encrypt (string $value): string {
        return urlencode(base64_encode($value));
    }

    static function decrypt (string $value): string {
        return urldecode(base64_decode($value));
    }

}

?>