<?php
namespace fmihel;

require_once __DIR__.'/session/iSession.php';
require_once __DIR__.'/session/SessionDefault.php';

class session {

    public static $session;

    public static function init($sessionClass = 'fmihel\session\SessionDefault'){
        session::$session = new  $sessionClass();
    }

    public static function autorize($param = []){
        if (self::$session){
            return self::$session->autorize($param);
        }else
            throw new \Exception('session::$session = false');   
    }

    public static function logout(){
        if (self::$session){
            self::$session->logout();
        }else
            throw new \Exception('session::$session = false');   
    }
    public static function enabled(){
        if (self::$session){
            return self::$session->enabled();
        }else
            throw new \Exception('session::$session = false');   
    }

}


router::on('before',function($pack){

    if ($pack['to'] ==='session/autorize'){
        
        router::out(session::autorize(router::$data));        

    }if ($pack['to'] ==='session/logout'){

        session::logout();
        router::out(['session'=>[]]);        

    }else{
        if (  !isset($pack['session']) || ! session::autorize($pack['session']) )  {
            throw new \Exception('need autorize');
        };
    }
    return $pack;
});
