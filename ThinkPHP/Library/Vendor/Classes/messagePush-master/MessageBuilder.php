<?php
require(dirname(__FILE__).'/Message.php');

Class MessageBuilder {
    private $config;
    private $message;

    public function __construct($config) {
        if(!$this->validateConfig($config)) {
            throw new Exception("Error config format.", 1);
        }
        $this->config = $config;
        $this->message = new Message();
    }

    public function build() {
        $this->message->from = $this->config['from'];
        $this->message->to = $this->config['to'];
        $this->message->content = $this->config['content'];
        $this->message->viewlevel = $this->config['viewlevel'];
        $this->message->action = $this->config['action'];

        return $this->message->toArray();
    }

    private function validateConfig($config) {
        $rule = array(
            'from' =>'from',
            'to' =>'to',
            'content' =>'content',
            'viewlevel' =>'viewlevel',
            'action' =>'action');
        $count = 0;
        foreach ($rule as $key => $value) {
            if(array_key_exists($key, $config)) {
                ++$count;
            }
        }
        return count($rule) == $count ? true : false;
    }
}