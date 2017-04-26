<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 25/04/2017
 * Time: 21:19
 */
require_once "IPaginable.php";
class Paginable implements IPaginable
{

    protected $actualPage;
    protected $results;
    protected $limit;
    protected $padding;
    protected $redirect;
    function __construct()
    {
    }

    function getOffset()
    {
        return $this->getActualPage()*$this->getLimit();
    }

    /**
     * @return mixed
     */
    public function getActualPage()
    {
        return $this->actualPage;
    }

    /**
     * @param mixed $actualPage
     */
    public function setActualPage($actualPage)
    {
        if($actualPage>0)
        {
            $actualPage=$actualPage-1;
        }
        $this->actualPage = $actualPage;
    }



    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $results
     */
    public function setResults($results)
    {
        $this->results = $results;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return mixed
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * @param mixed $padding
     */
    public function setPadding($padding)
    {
        $this->padding = $padding;
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param mixed $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }



    function getPaginador()
    {


        if($this->getLimit())
        {
            $pager =array();

            $pages = ceil($this->getResults() / $this->getLimit());

  /*          echo "<div><pre>";

            echo "Results ".($this->getResults());
            echo "Actual page".($this->getActualPage());
            echo "Total pages".($pages);
            echo "</pre></div>";
*/
            if($pages>0)
            {



            if($this->getActualPage()>=$pages)
            {

                $_GET["p"]=$pages;
                $qs=http_build_query($_GET);

                header("Location: {$this->redirect}?{$qs}");
                exit();

            }


                //paginas hacia atras

                var_dump($this->getPadding());
                for($i=$this->getActualPage()-$this->getPadding();$i<=$this->getActualPage();$i++ )
                {
                    if($i>0)
                    {
                        $pager[]["number"]=$i;

                    }

                }

                // paginas hacia adelante
                for($i=1;$i<=$this->getPadding();$i++)
                {
                    if(($this->getActualPage()+$i)<=$pages)
                    {
                        $pager[]["number"]=$this->getActualPage()+$i;
                    }
                }


                foreach($pager as $k=>$v)
                {
                    /*
                    if($v["number"]==$this->getActualPage())
                    {
                        $pager[$k]["class"]="active";
                    }*/

                    if($k==$this->getActualPage())
                    {
                        $pager[$k]["class"]="active";
                    }

                }


                return $pager;


            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }




    }
}