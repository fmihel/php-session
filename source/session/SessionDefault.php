<?php
namespace fmihel\session;

use fmihel\console;

class SessionDefault implements iSession{
    private $enable = false;
    public $current = [/*'login'=>false,'id'=>false*/];

    public $users = [
        ['id'=>'84893','login'=>'admin','pass'=>'xxx','sid'=>'3992']
    ];

    public function autorize($params=[]):array{
        
        if (isset($params['sid'])){
            $user = self::getUser('sid',$params['sid']);
            if (!empty($user)){
                $this->current = $user;
                return $this->current;
            }
        }elseif (isset($params['login']) && isset($params['pass'])){

            foreach($this->users as $user){
                if ($params['login'] === $user['login'] && $params['pass'] === $user['pass']){
                    $this->enable = true;
                    $this->current = $user;
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

    private function getUser(string $aliasId,$value ):array{
        foreach($this->users as $user){
            if ($user[$aliasId] === $value)
                return $user;
        };
        return [];
    }

}

