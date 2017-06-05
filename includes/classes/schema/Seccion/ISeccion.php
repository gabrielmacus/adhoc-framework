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

    /**
     * @param $seccionId
     * @return mixed
     * 
     * Devuelve un array con el breadcrum de secciones hasta el id requerido
     */
    public function selectSeccionBreadcrumb($seccionId,$recursive=false);

    /**
     * @param $seccionId
     * @param bool $recursive
     * @return mixed
     * Devuelve un array  con el breadcrumb completo, es decir, de la primer seccion a la ultima,segun el id requerido
     */
    public function selectCompleteSeccionBreadcrumb($seccionId,$recursive=false);
    
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