<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:51
 */
interface IComentario
{
    /** Create **/
    public function insertComentario(Comentario $c);
    /** **/

    /** Read **/
    public function selectComentarios();
    public function selectComentarioById($id);
    /** **/

    /** Update**/
    public function updateComentario(Comentario $c);
    /** */

    /** Delete **/
    public function deleteComentarioById($id);
    /** **/


    /**Validate **/
    public function validate(Comentario $c);
    /*** */
}