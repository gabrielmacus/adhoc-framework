<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 25/03/2017
 * Time: 15:11
 */
interface IUser
{
    /** Create **/
    public function insertUsuario(User $u);
    /** **/

    /** Read **/
    public function selectUsuarios();
    public function selectUsuarioById($id);
    public function selectToken($user,$password);
    /** * */
    /** Update**/
    public function updateUsuario(User $u);
    /** */

    /** Delete **/
    public function deleteUsuarioById($id);
    /** **/

    /**Validate **/
    public function validate(User $u);
    /*** */
}