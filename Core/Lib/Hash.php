<?php

namespace Lib;

/**
 * Class Hash
 * @package Lib
 */
class Hash{

    /**
     * @var
     */
    private $stringToHash;
    /**
     * @var string
     */
    private $selString;

    /**
     * Hash constructor.
     * @param $stringToHash
     * @param string $selString
     */
    public function __construct($stringToHash, $selString = 'Mpgfjdsqijoip')
    {
        $this->stringToHash = $stringToHash;
        $this->selString = md5($selString);
    }

    /**
     * @return string
     */
    private function selStep1() : string
    {

        $chars = str_split($this->stringToHash);

        $finalStr = '';
        $i = 0;

        $sel = $this->selString;

        foreach($chars as $char){

            $finalStr .=  (isset($sel[$i])) ? $sel[$i] . $char : $char;
            $i++;

        }
        return md5($finalStr);
    }

    /**
     * @return string
     */
    private function selStep2() : string
    {
        $chars = str_split($this->stringToHash);

        $finalStr = '';
        $i = 0;

        $sel = $this->selStep1();

        foreach($chars as $char){

            $finalStr =  (isset($sel[$i])) ? $sel[$i] . $char . $sel[-1 - $i] . $finalStr : $char;
            $i++;

        }

        return $finalStr;
    }


    /**
     * @param $hash
     * @param $str
     * @return bool
     */
    public static function verifyHash($hash, $str) : bool
    {
        $str = new Hash($str);
        return password_verify($str->getStringSalted(), $hash);
    }

    /**
     * @return string
     */
    public function getHash() : string
    {
        return password_hash($this->selStep2(), PASSWORD_DEFAULT);
    }

    /**
     * @return string
     */
    public function getStringSalted() : string
    {
        return $this->selStep2();
    }

}