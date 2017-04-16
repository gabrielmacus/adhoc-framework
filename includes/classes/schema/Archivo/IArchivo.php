<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 25/03/2017
 * Time: 15:11
 */
interface IArchivo
{
    /** Create **/
    public function insertArchivo(IArchivo $a,$versionName="original",$versionId=0);
    /** **/

    /** Read **/
    public function selectArchivos();
    public function selectArchivoById($id);
    public function selectArchivoByRepositorioId($in);
    public function selectArchivoOriginalByRepositorioId($in);
    /** **/

    /** Update**/
    public function updateArchivo(IArchivo $a);
    /** */

    /** Delete **/
    public function deleteArchivoById($id);
    /** **/
    
    /**Validate **/
    public function validate(IArchivo $a);
   /*** */

}