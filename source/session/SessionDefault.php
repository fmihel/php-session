<?php
namespace fmihel\session;

use fmihel\console;

class SessionDefault implements iSession{
    private $enable = false;
    public $current = [/*'login'=>false,'id'=>false*/];

    public $users = [
        '74893'=>['login'=>'admin','pass'=>'xxx']
    ];

    
    public function autorize($params=[]):array{
        
        if (isset($params['id'])){
            if (isset($this->users[$params['id']])){
                $user = $this->users[$params['id']];
                $this->current = ['login'=>$user['login'],'id'=>$params['id']];
                return $this->current;
            }
        }elseif (isset($params['login']) && isset($params['pass'])){
            foreach($this->users as $id=>$user){
                if ($params['login'] === $user['login'] && $params['pass'] === $user['pass']){
                    $this->enable = true;
                    $this->current = ['login'=>$params['login'],'id'=>$id];
                    return $this->current;
                };
            }
        }
        
        return [];
    }
    public function logout(){
        $this->enable = false;
        $this->current = [];
    }
    public function enabled():bool{
        return $this->enable;
    }

}

