<?php
namespace fmihel;

use fmihel\session\SessionDefault;

require_once __DIR__.'/session/iSession.php';
require_once __DIR__.'/router/on.before.php';
require_once __DIR__.'/session/default.php';

class session {

    public static $session;

    public static function autorize($param = []){
        if (self::$session){
            return self::$session->autorize($param);
        }
        throw new \Exception('session::$session = false');   
    }

    public static function logout(){
        if (self::$session){
            self::$session->logout();
        }
        throw new \Exception('session::$session = false');   
    }
    public static function enabled(){
        if (self::$session){
            return self::$session->enabled();
        };
        throw new \Exception('session::$session = false');   
    }

}

session::$session = new SessionDefault();