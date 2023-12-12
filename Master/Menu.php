<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/utsku/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'alokon', 'Link' => $base . 'alokon'),
            array('Text' => 'distribusi', 'Link' => $base . 'distribusi'),
            array('Text' => 'user', 'Link' => $base . 'user'),
        ];
        return $data;
    }
}
