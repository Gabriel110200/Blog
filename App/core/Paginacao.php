<?php

namespace App\core;

class Paginacao
{
    private $limit = REGISTROS_PAG;
    private $page;
    private $query;
    private $total;
    private $model;


    public function __construct($model, $sql)
    {
        $this->model = $model;
        $this->query = $sql;
        $conn =  $model::getConexao();
        $dados = $conn->query($sql);
        $this->total = $dados->rowCount();
    }

    public function getData($page = 1)
    {
        $this->page = $page;

        if ($this->limit == 'all') {
            $query = $this->query;
        } else {
            $query = $this->query . " LIMIT " . (($this->page - 1) * $this->limit) . ",$this->limit";
        }

        $conn = $this->model::getConexao();
        $dados = $conn->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $result = new \stdClass();
        $result->page = $this->page;
        $result->limit = $this->limit;
        $result->total = $this->total;

        return $result;
    }


    public function createLinks($url_link)
    {
        $link = "";

        if ($this->total > 0) :
            $totalPaginas = ceil($this->total / $this->limit);
            $link .= '<nav aria-label="Page navigation example"> 
                      <ul class="pagination">';

            for ($page = 1; $page <= $totalPaginas; $page++) {
                $url = URL_BASE . '/' . $url_link . '/' . $page;
                $link .= '<li class="page-item"><a class="page-link" href="' . $url . '">' . $page . '</a></li>';
            }

            $link .= '</ul> </nav>';

        endif;

        return $link;
    }
}
