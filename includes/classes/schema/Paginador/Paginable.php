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
    protected $pages;
    function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param mixed $pages
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
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

           

            $this->setPages($pages);
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
                $actualPage =$this->getActualPage();
                /*** Páginas hacia atras **/

                $control=0;



                for ($i=$actualPage;$i>0;$i--)
                {

                   $control++;
                    if($control<=$this->getPadding())
                    {

                        $pager[]["number"]=$i;
                    }
                    else
                    {
                        break;
                    }


                }
                $pager = array_reverse($pager);


                /** Paginas hacia adelante **/


                for ($i=1;$i<=$this->getPadding()+1;$i++)
                {
                    $n=$i+$actualPage;
                    if($n<=$pages)
                    {
                        $pager[]["number"]=$n;

                    }


                }



                //paginas hacia atras

                /*
                for($i=$this->getActualPage()-$this->getPadding();$i<=$this->getActualPage();$i++ )
                {
                    if($i>0)
                    {
                        $pager[]["number"]=$i;

                    }

                }*/

                // paginas hacia adelante

              /*  for($i=1;$i<=$this->getPadding();$i++)
                {
                    if(($this->getActualPage()+$i)<=$pages)
                    {
                        $pager[]["number"]=$this->getActualPage()+$i;
                    }
                }*/


                foreach($pager as $k=>$v)
                {

                    if( $pager[$k]["number"]==1)
                    {
                        $pager[$k]["class"].=" first";
                    }
                    if($pager[$k]["number"]==$pages)
                    {
                        $pager[$k]["class"].=" last";
                    }
                    if($v["number"]==($actualPage+1))
                    {
                        $pager[$k]["class"].=" active";

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