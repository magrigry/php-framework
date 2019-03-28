<?php
namespace Core;
class ObjectArrayAccess implements \ArrayAccess {

    public static $data = array();

    public function offsetUnset($index) {}

    public function offsetSet($index, $value) {
//    echo ("SET: ".$index."<br>");

        if(isset($data[$index])) {
            unset($data[$index]);
        }

        $u = &self::$data[$index];
        if(is_array($value)) {
            $u = new ObjectArrayAccess();
            foreach($value as $idx=>$e)
                $u[$idx]=$e;
        } else
            $u=$value;
    }

    public function offsetGet($index) {
//    echo ("GET: ".$index."<br>");

        if(!isset(self::$data[$index]))
            self::$data[$index]=new ObjectArrayAccess();

        return self::$data[$index];
    }

    public function offsetExists($index) {
//    echo ("EXISTS: ".$index."<br>");

        if(isset(self::$data[$index])) {
            if(self::$data[$index] instanceof ObjectArrayAccess) {
                if(count(self::$data[$index]->data)>0)
                    return true;
                else
                    return false;
            } else
                return true;
        } else
            return false;
    }

}