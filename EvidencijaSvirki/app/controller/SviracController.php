<?php

class SviracController extends ProtectedController
{

    function traziSvirac(){
        echo json_encode(Svirac::traziSvirac($_GET["term"]));
    }

    function delete($id)
    {
            Svirac::delete($id);
            $this->index();
    }


    function edit($id)
    {
        $_POST["sifra"]=$id;
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Svirac::update($id);
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'polaznici/edit',
                [
                "poruka"=>$kontrola
                ]
            );
        }

    }

    private function kontrola(){

        if(!Utillity::checkOib(Request::post("oib"))){
            return "OIB nije u dobrom formatu";
        }

        return true;
    }

    function prepareedit($id){
        $view = new View();
        $svirac = Svirac::find($id);
        $_POST = (array)$svirac;
        $view->render(
            'polaznici/edit',
            [
            "poruka"=>""
            ]
        );
    }

    function add(){
        $this->prepareedit(Svirac::add());
    }


    function index($stranica=1){
        if($stranica<=0){
            $stranica=1;
        }
        if($stranica===1){
            $prethodna=1;
        }else{
            $prethodna=$stranica-1;
        }
        $sljedeca=$stranica+1;

        $view = new View();
        $view->render(
            'polaznici/index',
            [
            "polaznici"=>Svirac::read($stranica),
            "prethodna"=>$prethodna,
            "sljedeca"=>$sljedeca
            ]
        );
    }


   public function __bulkinsert()
   {

    $db = Db::getInstance();

    $db->beginTransaction();
    for($i=1;$i<=2225;$i++){
        $izraz = $db->prepare("insert into bend (sifra,oib,ime,prezime,email) values
        (null,null,'Svirac','$i','svirac$i@gmail.com')");
        $izraz->execute();
        $zadnjaBendSifra = $db->lastInsertId();
        $izraz = $db->prepare("insert into svirac(sifra,bend,brojugovora) values 
        (null,$zadnjaBendSifra,null)");
        $izraz->execute();
        
    }
    $db->commit();
    echo "Sve OK";
   } 
}