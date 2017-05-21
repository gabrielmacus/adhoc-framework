<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:16
 */
interface ISeccion
{
    /** Create **/
    public function insertSeccion(Seccion $s);
    /** **/

    /** Read **/
    public function selectSecciones();
    public function selectSeccionById($id);
    public function selectSeccionesSubsecciones($cantPosts);
    public function selectSeccionesByTipo($tipo);
    /** **/

    /** Update**/
    public function updateSeccion(Seccion $s);
    /** */

    /** Delete **/
    public function deleteSeccionById($id);
    /** **/

    /**Validate **/
    public function validate(Seccion $s);
    /*** */
}