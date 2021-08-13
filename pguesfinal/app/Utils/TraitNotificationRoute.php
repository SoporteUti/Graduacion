<?php  

namespace sispg\Utils\Traits;

trait TraitNotificationRoute {
    public function getUrlDestination($id,$type){
        switch ($type) {
            case 0:
                return "/ues/grupos/vista_asesor/$id";
                break;
            case 1:
                return "/ues/grupos/steps/$id";
                break;
            case 2:
                return "/ues/grupos/vista_director/$id";
                break;
            case 3:
                return "ues/estudiantes/";
                break;

            default:
                return "/";
                break;
        }
    }
}
