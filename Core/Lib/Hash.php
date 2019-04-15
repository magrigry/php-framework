<?php
namespace Core\Lib;

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
     * @var \Core\App
     */
    private $app;

    /**
     * Hash constructor.
     * @param $app
     */
    public function __construct(\Core\App $app)
    {
        $this->app = $app;

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
     * @param $stringToHash
     * @return string
     */
    private function selStep2($stringToHash) : string
    {
        $this->stringToHash = $stringToHash;
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
    public function verifyHash($hash, $str) : bool
    {
        $obj = new Hash($this->app);
        return password_verify($obj->getStringSalted($str), $hash);
    }

    /**
     * @param string $stringToHash
     * @return string
     */
    public function getHash($stringToHash) : string
    {
        return password_hash($this->selStep2($stringToHash), PASSWORD_DEFAULT);
    }

    /**
     * @param string $stringToSel
     * @return string
     */
    public function getStringSalted($stringToSel) : string
    {
        return $this->selStep2($stringToSel);
    }

}