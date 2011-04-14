<?php

class Welcome extends Framework_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_view->title = 'Framework';
    }

    public function index($name = 'World')
    {
        $this->_view->title = 'Hello | Framework';
        $data = array('message' => 'Hello, ' . $name . '!');
        $footerData = array('name' => 'Framework');
        $this->_view->content = $this->_view->fetch('welcome', $data);
        $this->_view->footer = $this->_view->fetch('footer', $footerData);
        $this->_view->render();
    }

    public function welcome($name = 'dude')
    {
        $data = array('message' => 'Welcome to the Framework, ' . $name . '!');
        $this->_view->renderPartial('welcome', $data);
    }
}
