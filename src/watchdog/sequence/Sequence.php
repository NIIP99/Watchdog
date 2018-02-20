<?php
namespace watchdog\sequence;

use warden\Base;
use pocketmine\Server;
use pocketmine\scheduler\AsyncTask;

class Sequence extends AsyncTask{
    
    private $child = null;
    private $id = null;
    
    public function __construct($id, $child){
        $this->id = $id;
        $this->child = $child;
    }
    
    public function onRun(){
        $this->child->execute();
    }
    
    public function onCompletion(Server $s){
        Base::getInstance()->getSeqManager()->remove($this);
    }
}