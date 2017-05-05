<?php



    /**
     * Created by PhpStorm.
     * User: Puers
     * Date: 30/03/2017
     * Time: 23:16
     */
interface IPost
{

    /** Create **/
    public function insertPost(Post $p);
    /** **/

    /** Read **/
    public function selectPosts($process=true,$processAnexos=true);
    public function selectPostById($id,$process=true,$processAnexos=true);
    public function selectPostByTipo($tipo,$process=true,$processAnexos=true);
    public function selectPostByTipoAndPertenece($tipo,$process=true,$processAnexos=true);
    /** **/

    /** Update**/
    public function updatePost(Post $p);
    /** */

    /** Delete **/
    public function deletePostById($id);
    /** **/

    /**Validate **/
    public function validate(Post $p);
    /*** */

}