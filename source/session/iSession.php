<?php
namespace fmihel\session;

interface iSession{
    public function autorize($params=[]):bool;
    public function logout();
    public function enabled():bool;
};