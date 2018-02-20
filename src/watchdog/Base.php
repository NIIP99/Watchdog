<?php
namespace watchdog;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\entity\Entity;
use pocketmine\Player;
use pocketmine\level\Location;
use pocketmine\level\Position;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\math\Vector3;

use watchdog\EventRouter;
use watchdog\Watchdog;
use watchdog\lang\Language;

class Base extends PluginBase{
    
    private static $instance = null;
    
    public function onEnable(){
        
        new Language("en");
        $this->watchdog = new Watchdog($this);
        new EventRouter($this);
    }
    
    public function onDisable(){
        
    }
    
    public function getRootDirectory() : string{
        return __DIR__;
    }
    
    public function sendToTerminal($level, string $message){
        $this->getLogger()->log($level, $message);
    }
    
    public function sendBroadcast($level, string $message){
        $this->sendToTerminal($level, $message);
        /*foreach($this->getWatchdog()->getOnlineAdmins() as $admin){
            
        }*/
    }
    
    public function completeEnableSeq($res){
        
    }
    
    public function loadConfig(){
        
        if(!is_dir($this->getDataFolder())){
            mkdir($this->getDataFolder());
            $this->saveDefaultConfig();
        }
    }
    
    public function loadCommand(){
        $cm = $this->getServer()->getCommandMap();
        
    }

    public static function getInstance(){
        return self::$instance;
    }

    public function onLoad(){
        self::$instance = $this;
    }

}
