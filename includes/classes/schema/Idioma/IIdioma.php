<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:16
 */
interface IIdioma
{
    /** Create **/
    public function insertIdioma(Idioma $i);
    /** **/

    /** Read **/
    public function selectIdiomas();
    public function selectIdiomaById($id);
    public function selectIdiomaByShort($short);
    public function selectIdiomaByName($name);
    public function selectIdiomaPredeterminado();
    /** **/

    /** Update**/
    public function updateIdioma(Idioma $i);
    
    /** */

    /** Delete **/
    public function deleteIdiomaById($id);
    /** **/

    /**Validate **/
    public function validate(Idioma $s);
    /*** */
}