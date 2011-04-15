<?php

class WelcomeController extends Framework_Controller
{
    /**
     * Instance of messages model
     * 
     * @var object
     */
    private $_messages;

    public function __construct()
    {
        parent::__construct();
        $this->_messages = new Application_Models_Messages();
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
    
    public function messages()
    {
        $messages = $this->_messages->get();

        $this->_view->title = 'Messages';
        $data = array('messages' => $messages);
        $this->_view->content = $this->_view->fetch('messages', $data);
        $this->_view->render();
    }
}
