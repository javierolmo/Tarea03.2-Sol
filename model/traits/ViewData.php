<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

/**
 *
 * @author maria
 */
trait ViewData {
    ## add types

    private $status = Util::NO_OPERATION;

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }
    //Prepara la ruta para que sea interpretable desde la Vista
    public function relativePathToView(string $fileName): string{
        $path= "..".DIRECTORY_SEPARATOR.IMAGES_FOLDER.DIRECTORY_SEPARATOR.$fileName;
        
       
        if (!file_exists($path) || trim($fileName)=="") {
            $path = ".." . DIRECTORY_SEPARATOR . IMAGES_FOLDER . DIRECTORY_SEPARATOR . IMAGE_DEFAULT;
        }
        return $path;
    }

}
