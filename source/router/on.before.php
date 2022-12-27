<?php
namespace fmihel;

router::on('before',function($pack){

    if ($pack['to'] ==='session/autorize'){
        
        if (session::autorize(router::$data))
            router::out(['session'=>['enabled'=>1]]);        

    }if ($pack['to'] ==='session/logout'){

        session::logout();
        router::out(['session'=>['enabled'=>0]]);        

    }else{
        if (  !isset($pack['session']) || ! session::autorize($pack['session']) )  {
            throw new \Exception('need autorize');
        };
    }
    return $pack;
});
