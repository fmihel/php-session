<?php
namespace fmihel;

require_once __DIR__.'/session/iSession.php';
require_once __DIR__.'/session/SessionDefault.php';

class session {

    public static $session;

    public static function use($sessionClass = 'fmihel\session\SessionDefault'){
        session::$session = new  $sessionClass();
    }

    public static function autorize($param = []){
        return self::$session->autorize($param);
    }

    public static function logout(){
        self::$session->logout();
    }
    public static function enabled(){
        return self::$session->enabled();
    }

}


router::on('before',function($pack){

    if ($pack['to'] ==='session/autorize'){
        
        router::out(session::autorize(router::$data));        

    }if ($pack['to'] ==='session/logout'){

        session::logout();
        router::out(['session'=>[]]);        

    }else{
        if ( !isset($pack['session']) || empty(session::autorize($pack['session']))) {
                router::error('need autorize',['logout'=>1]);
        };
    }
    return $pack;
});
