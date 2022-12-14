<?php

class NotaController {

    public $page_title;
    public $view;
    private $notaServicio;

    public function __construct() {
        $this->view = 'list_note';
        $this->page_title = '';
        $this->notaServicio = new NotaServicio();
    }

    /* List all notes */

    public function list() {
        $this->page_title = 'Listado de notas';

        return $this->notaServicio->getNotas();
    }

    /* Load note for edit */

    public function edit($id = null) {
        $this->page_title = 'Editar nota';
        $this->view = 'edit_note';
        /* Id can from get param or method param */
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            $nota = $this->notaServicio->getNoteById($id);
        } else {
            //para creación
            $nota = new Nota();
        }
        return $nota;
    }

    /* Create or update note */

    public function save() {
        $this->view = 'edit_note';
        $this->page_title = 'Editar nota';

        if (isset($_POST["id"]) && trim($_POST["id"]) !== "" && is_numeric($_POST["id"])) {
            $id = (int) $_POST["id"];
        } else {
            $id = null;
        }

        if (isset($_POST["title"])) {
            $title = $_POST["title"];
        }
        if (isset($_POST["content"])) {
            $content = $_POST["content"];
        }
        if (isset($_POST["comentario"])) {
            $comentario = $_POST["comentario"];
        }
        
        $nota = new Nota();
        $nota->setTitulo($title);
        $nota->setContenido($content);
        $nota->setId($id);
        $nota->setComentario($comentario);
        
         $notaGuardada = $this->notaServicio->save($nota, $_FILES["fichero"]);
        //para saber si ha habido error o no
                  

//        if ($notaGuardada == null) {
//            $notaGuardada->setStatus(Util::OPERATION_NOK);
//        } else {
//            $notaGuardada->setStatus(Util::OPERATION_OK);
//        }


        return $notaGuardada;
    }

    /* Confirm to delete */

    public function confirmDelete() {
        $this->page_title = 'Eliminar nota';
        $this->view = 'confirm_delete_note';
        return $this->notaServicio->getNoteById($_GET["id"]);
    }

    /* Delete */

    public function delete(): bool {
        $this->page_title = 'Listado de notas';
        $this->view = 'delete_note';
        return $this->notaServicio->deleteNoteById($_POST["id"]);
    }

}

?>