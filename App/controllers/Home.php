<?php

class Home
{
    public function index()
    {

        echo '<br> executando home index';
    }

    public function teste()
    {
        echo '<br>executando home teste';
    }

    public function teste2()
    {
        echo '<br>executando home teste2';
    }

    public function info($p1 = 'p1', $p2 = 'p2')
    {
        echo '<br>executando info<br/>';
        echo "$p1<br/>";
        echo "$p2<br />";
    }
}
