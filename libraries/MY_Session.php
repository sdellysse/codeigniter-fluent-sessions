<?php defined('BASEPATH') or die('No direct script access allowed.');

class MY_Session extends CI_Session {
    static function decode_json_if_json ($possible_json, $other_retval = 'not json') {
        $retval = @json_decode($possible_json, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $retval;
        } else {
            return $other_retval;
        }
    }

    public $flash;

    function __construct () {
        parent::__construct();
        $this->flash = new MY_Session_Flash;
    }

    function __get ($key) {
        $retval = $this->userdata($key);
        $json = MY_Session::decode_json_if_json($retval);

        if ($json === 'not json') {
            return $retval;
        } else {
            return $json;
        }
    }

    function __isset ($key) {
        return $this->userdata($key) !== false;
    }


    function __set ($key, $value) {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        $this->set_userdata($key, $value);
    }

    function __unset ($key) {
        $this->unset_userdata($key);
    }

    function clear () {
        foreach (array_keys($this->userdata) as $key) {
            unset($this->$key);
        }
    }

    function destroy () {
        $this->sess_destroy();
    }

}

class MY_Session_Flash {
    public $notices;
    public $messages;
    public $warnings;

    function __construct () {
        $this->notices = new MY_Session_Flash_Container('notices');
        $this->messages = new MY_Session_Flash_Container('messages');
        $this->warnings = new MY_Session_Flash_Container('warnings');
    }

    function __get ($key) {
        $retval = get_instance()->session->flashdata($key);
        $json = MY_Session::decode_json_if_json($retval);

        if ($json === 'not json') {
            return $retval;
        } else {
            return $json;
        }
    }

    function __isset ($key) {
        return get_instance()->session->flashdata($key) !== false;
    }

    function __set ($key, $value) {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        get_instance()->session->set_flashdata($key, $value);
    }

    function keep ($key) {
        get_instance()->session->keep_flashdata($key);
    }

}

class MY_Session_Flash_Container implements ArrayAccess, IteratorAggregate, Countable {
    private $__flashkey;
    function __construct ($name) {
        $this->__flashkey = "__container_{$name}";
    }

    function count () {
        $key = $this->__flashkey;
        if (isset(get_instance()->session->flash->$key)) {
            $array = get_instance()->session->flash->$key;
        } else {
            $array = array();
        }

        return count($array);
    }

    function getIterator () {
        $key = $this->__flashkey;
        if (isset(get_instance()->session->flash->$key)) {
            $array = get_instance()->session->flash->$key;
        } else {
            $array = array();
        }

        return new ArrayIterator($array);
    }

    function offsetExists ($offset) {
        $key = $this->__flashkey;
        if (isset(get_instance()->session->flash->$key)) {
            $array = get_instance()->session->flash->$key;
            return isset($array[$offset]);
        } else {
            return false;
        }
    }

    function offsetGet ($offset) {
        $key = $this->__flashkey;
        if (isset(get_instance()->session->flash->$key)) {
            $array = get_instance()->session->flash->$key;
        } else {
            $array = array();
        }

        return $array[$offset];
    }

    function offsetSet ($offset, $value) {
        $key = get_instance()->session->flashdata_key.':new:'.$this->__flashkey;
        if (get_instance()->session->$key) {
            $array = get_instance()->session->$key;
        } else {
            $array = array();
        }

        if (is_null($offset)) {
            $array []= $value;
        } else {
            $array[$offset] = $value;
        }

        get_instance()->session->$key = $array;
    }

    function offsetUnset ($offset) {
        $key = get_instance()->session->flashdata_key.':new:'.$this->__flashkey;
        if (get_instance()->session->$key) {
            $array = get_instance()->session->$key;
            unset($array[$offset]);
            get_instance()->session->$key = $array;
        }
    }
}
