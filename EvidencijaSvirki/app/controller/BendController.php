<?php

class BendController extends ProtectedController
{
    function add()
    {
        
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Bend::add();
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'bendovi/new',
                [
                "poruka"=>$kontrola
                ]
            );
        }

    }

    function edit($id)
    {
        $_POST["sifra"]=$id;
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Bend::update($id);
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'bendovi/edit',
                [
                "poruka"=>$kontrola
                ]
            );
        }

    }

    function delete($id)
    {
            Bend::delete($id);
            $this->index();
    }

    function kontrola()
    {
        if(Request::post("naziv")===""){
            return "Naziv obavezno";
        }

        if(strlen(Request::post("naziv"))>50){
            return "Naziv ne smije biti veći od 50 znakova";
        }

        $db = Db::getInstance();
        $izraz = $db->prepare("select count(sifra) from bend where naziv=:naziv and sifra<>:sifra");
        $izraz->execute(["naziv"=>Request::post("naziv"), "sifra" => Request::post("sifra")]);
        $ukupno = $izraz->fetchColumn();
        if($ukupno>0){
            return "Naziv postoji, odaberite drugi";
        }

        if(Request::post("korisnickoime")===""){
            return "Korisničko ime obavezno";
        }

        if(Request::post("lozinka")===""){
            return "Lozinka obavezno";
        }

       if(Request::post("email")===""){
            return "Email obavezan";
        }


        return true;
    }

    function prepareadd()
    {
        $view = new View();
        $view->render(
            'bendovi/new',
            [
            "poruka"=>""
            ]
        );
    }

    function prepareedit($id)
    {
        $view = new View();
        $bend = Bend::find($id);
        $_POST["naziv"]=$bend->naziv;
        $_POST["korisnickoime"]=$bend->korisnickoime;
        $_POST["lozinka"]=$bend->lozinka;
        $_POST["email"]=$bend->email;
        $_POST["sifra"]=$bend->sifra;

        $view->render(
            'bendovi/edit',
            [
            "poruka"=>""
            ]
        );
    }


    function index(){
        $view = new View();
        $view->render(
            'bendovi/index',
            [
            "bendovi"=>Bend::read()
            ]
        );
    }
}