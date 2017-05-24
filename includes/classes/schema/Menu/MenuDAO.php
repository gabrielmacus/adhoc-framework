<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 22/05/2017
 * Time: 01:32 PM
 */

require_once "IMenu.php";
class MenuDAO implements IMenu
{
    protected $menuDir;
    protected  $menu;

    /**
     * MenuDAO constructor.
    
     */
    public function __construct($menuDir)
    {
        $this->menuDir =$menuDir;
    }


    public function saveMenu($menuArray)
    {
        // TODO: Implement saveMenu() method.
        
    }

    public function readMenu()
    {
        
        // TODO: Implement readMenu() method.
       $menu= file_get_contents($this->menuDir);
        
        $menu= json_decode($menu,true);
        $this->menu = $menu["sidenav"];

        return $this->menu;

    }


}