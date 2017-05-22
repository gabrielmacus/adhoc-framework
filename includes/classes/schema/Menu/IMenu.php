<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 22/05/2017
 * Time: 01:32 PM
 */
interface IMenu
{
    /** Create/Update */
    
      public function saveMenu($menuArray);
    
    /* */
    
    /** Read* */

    public function readMenu();
    /***/
    

}