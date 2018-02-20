<?php
namespace watchdog;

use pocketmine\utils\TextFormat;

use watchdog\Base;
use watchdog\lang\Language;

class Watchdog{
    
    public function __construct(Base $base){
        $base->loadConfig();
        //$base->loadCommand();
        
        $base->sendToTerminal(\LogLevel::INFO, TextFormat::BOLD.TextFormat::GREEN.Language::translate("message.protected"));
    }

}
