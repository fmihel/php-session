<?php
namespace fmihel\session;

class SessionDefault implements iSession{
    public function autorize($params=[]):bool{
        return true;
    }
    public function logout(){

    }
    public function enabled():bool{
        return true;
    }

}

