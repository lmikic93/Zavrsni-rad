<?php

class SviracController extends ProtectedController
{

    
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
                'sviraci/edit',
                [
                "poruka"=>$kontrola
                ]
            );
        }

    }

    function kontrola()
    {
        if(Request::post("ime")===""){
            return "Ime je obavezno";
        }
        if(strlen(Request::post("naziv"))>100){
            return "Ime ne smije biti veće od 100 znakova";
        }
        $db = Db::getInstance();
        $izraz = $db->prepare("select count(sifra) from svirac where ime=:ime and sifra<>:sifra");
        $izraz->execute(["ime"=>Request::post("ime"), "sifra"=> Request::post("sifra")]);
        $ukupno = $izraz->fetchColumn();
        
        if(strlen(Request::post("prezime"))>100){
            return "Prezime ne smije biti veće od 100 znakova";
        }
        if(Request::post("email")===""){
            return "Email obavezan";
        }

        if(Request::post("bend")===""){
            return "Bend obavezno";
        }

       
        return true;
    }

    function prepareadd()
    {
        $view = new View();
        $view->render(
            'sviraci/new',
            [
            "poruka"=>""
            ]
        );
    }

    function prepareedit($id)
    {
        $view = new View();
        $svirac = Svirac::find($id);
        $_POST["ime"]=$svirac->ime;
        $_POST["prezime"]=$svirac->prezime;
        $_POST["email"]=$svirac->email;
        $_POST["bend"]=$svirac->bend;
        $_POST["sifra"]=$svirac->sifra;
        $view->render(
            'sviraci/edit',
            [
            "poruka"=>""
            ]
        );
     }

    

    function add()
    {
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Svirac::add();
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'sviraci/new',
                [
                "poruka"=>$kontrola
                ]
            );
        }
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
             'sviraci/index',
            [
             "sviraci"=>Svirac::read($stranica),
            "prethodna"=>$prethodna,
            "sljedeca"=>$sljedeca
            ]
         );
     }
    
   //  function index(){
      //  $view = new View();
      //  $view->render(
          //  'sviraci/index',
         //   [
           //     "sviraci"=>Svirac::read()
          //  ]
     //   );
   // }


   
}