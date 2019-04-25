<?php
class NastupController extends ProtectedController
{
    public function __construct()
    {
        if(!Session::getInstance()->isLogiran()){
            $view = new View();
            $view->render('index',["poruka"=>"Nemate ovlasti"]);
            exit;
        }
    }
    function add()
    {
        
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Nastup::add();
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'nastupi/new',
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
            Nastup::update($id);
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'nastupi/edit',
                [
                "poruka"=>$kontrola
                ]
            );
        }
    }
    function delete($id)
    {
            Nastup::delete($id);
            $this->index();
    }
    function kontrola()
    {
    if(Request::post("adresa")===""){
            return "Naziv obavezno";
        }
       
        $db = Db::getInstance();
        $izraz = $db->prepare("select count(sifra) from nastup where adresa=:adresa and sifra<>:sifra");
        $izraz->execute(["adresa"=>Request::post("adresa"), "sifra" => Request::post("sifra")]);
        $ukupno = $izraz->fetchColumn();

        return true;
    }
    function prepareadd()
    {
        $view = new View();
        $view->render(
            'nastupi/new',
            [
            "poruka"=>""
            ]
        );
    }
    function prepareedit($id)
    {
        $view = new View();
        $nastup = Nastup::find($id);
        $_POST["datumpocetka"]=$nastup->datumpocetka;
        $_POST["cijena"]=$nastup->cijena;
        $_POST["adresa"]=$nastup->adresa;
        $_POST["vrstasvirke"]=$nastup->vrstasvirke;
        $_POST["bend"]=$nastup->bend;
        $_POST["sifra"]=$nastup->sifra;
        $view->render(
            'nastupi/edit',
            [
            "poruka"=>""
            ]
        );
    }
    function index(){
        $view = new View();
        $view->render(
            'nastupi/index',
            [
            "nastupi"=>Nastup::read()
            ]
        );
    }
}