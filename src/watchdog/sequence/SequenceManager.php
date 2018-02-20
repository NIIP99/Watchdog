<?php
namespace watchdog\sequence;

class SequenceManager{
    
    private $pool = [];
    
    public function __construct(){
        
    }
    
    public function add($seq, $pool){
        $this->pool[$seq];
        Server::getInstance()->getScheduler()->scheduleAsyncTask($seq);
    }
    
    public function remove($seq, $pool){
        $this->pool[$seq];
        Server::getInstance()->getScheduler()->scheduleAsyncTask($seq);
    }

}
