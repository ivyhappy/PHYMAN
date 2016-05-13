<?php
Class Message {
    public $from;
    public $to;
    public $content;
    public $viewlevel;
    public $action;

    public function toArray() {
        return (array)$this;
    }
}