<?php

namespace Cms\Controller;

class HomeController extends BaseController
{

    public function index()
    {
        echo 'Index Page';
    }

    public function news($id)
    {
        echo 'News Page with id ' . $id;
    }
}
