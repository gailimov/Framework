<?php

class Welcome
{
    public function index($name = 'World')
    {
        echo 'Hello, ' . $name . '!';
    }

    public function hello($name = 'dude')
    {
        echo 'Welcome to the Framework, ' . $name . '!';
    }
}
