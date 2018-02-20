<?php
namespace watchdog\lang;

use watchdog\Base;

class Language{
    
    const FALLBACK_LANG_ID = "en";
    
    private static $cache = [];
    private $id = null;
    private $name = null;
    
    public function __construct(string $langId){
        $file = Base::getInstance()->getRootDirectory()."\\lang\\locale\\".$langId.".yml";
        if(!file_exists($file)){
            $file = Base::getInstance()->getRootDirectory()."\\lang\\locale\\".self::FALLBACK_LANG_ID.".yml";
        }
        
        $contents = $this->fixYAMLIndexes(file_get_contents($file));
        $nodes = yaml_parse($contents);
        
        $id = $nodes["language"]["id"];
        $name = $nodes["language"]["name"];
        if(isset($id) && isset($name)){
            $this->id = $id;
            $this->name = $name;

            foreach($nodes as $nodeKey => $node){
                foreach($node as $key => $str){
                    self::$cache[$nodeKey.".".$key] = $str;
                }
            }
        }else{
            // To do invalid language
        }
    }
    
    public static function translate(string $key, array $vars = []) : string{
        if(empty($msg = self::$cache[$key])){
            return $key;
        }else{
            $i = 0;
            foreach($vars as $var){           
                $msg = str_replace("%$i%", self::translate($var), $msg);
                $i++;
            }
            return $msg;
        }
    }
    
    public function getName() : string{
        return $this->name;
    }
    
    public function getId() : string{
        return $this->id;
    }
    
    private function fixYAMLIndexes($str) : string{
        return preg_replace("#^([ ]*)([a-zA-Z_]{1}[ ]*)\\:$#m", "$1\"$2\":", $str);
    }

}
