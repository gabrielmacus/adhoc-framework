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
    public function insertArchivo( $a,$versionName="original",$versionId=0);
    /** **/

    /** Read **/
    public function selectArchivos($process=true);
    public function selectArchivoById($id,$process=true);
    public function selectArchivoByRepositorioId($in,$process=true,$version=false);
    public function selectArchivoOriginalByRepositorioId($in,$process=true);
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