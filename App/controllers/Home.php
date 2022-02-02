<?php


use App\Core\BaseController;




class Home extends BaseController
{

    public function index()
    {
        $artigoModel = $this->model('ArtigoModel');


        $artigos = $artigoModel->read()->fetchAll(\PDO::FETCH_ASSOC);
        $data = ['artigos' => $artigos];
        $this->view('home/index', $data);
    }
}
