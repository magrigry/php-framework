<?php

namespace Core;

/**
 * Class Session
 * @package Core
 */
class Session
{

    /**
     * @var array
     */
    private $session = array();

    /**
     * @var
     */
    private static $_instance;

    /**
     * Session constructor.
     * @param array $session
     */
    public function __construct(array $session)
    {
        foreach ($session as $key => $data) {
            $this->session[$key] = $data;
        }
    }

    /**
     * @param $session
     * @return Session
     */
    public static function getInstance($session): Session
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Session($session);
        }
        return self::$_instance;
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function add($key, $value): bool
    {
        $this->session[$key] = $value;
        return true;
    }

    /**
     * @param $key
     * @return bool
     */
    public function del($key): bool
    {
        if (!isset($this->session[$key])) {
            $debug = debug_backtrace();
            trigger_error("<p>Framework warning: Undefined index $key in Session->del() " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>');
            return false;
        }

        unset($this->session[$key]);
        return true;
    }

    /**
     * @return bool
     */
    public function destroy(): bool
    {
        foreach ($this->session as $key => $value) {
            unset($this->session[$key]);
        }

        return true;
    }

    /**
     * @param $key
     * @return bool
     */
    public function check($key): bool
    {
        if (!isset($this->session[$key])) {
            return false;
        }

        return true;
    }

    /**
     * @param $key
     * @return string
     */
    public function get($key): string
    {
        if (!isset($this->session[$key])) {
            $debug = debug_backtrace();
            trigger_error("<p>Framework warning: Undefined index $key in Session->get() " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>');
            return null;
        }

        return $this->session[$key];
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->session;
    }

    /**
     *
     */
    public function __destruct()
    {
        foreach ($_SESSION as $key => $data) {
            unset($_SESSION[$key]);
        }
        foreach ($this->getAll() as $key => $data) {
            $_SESSION[$key] = $data;
        }
    }

}