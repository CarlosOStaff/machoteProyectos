<?php
class Views extends Control
{
//vista por default
    public function inicio()
    {
        $datos = [
            "title" => "Inicio"
        ];
        $this->load_view('inicio', $datos);
    }

    public function update($id)
    {
        echo "Update view " . $id;
    }
}
