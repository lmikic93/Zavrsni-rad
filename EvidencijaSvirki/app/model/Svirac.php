<?php

class Svirac
{

    public static function delete($id)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        
        $izraz = $db->prepare("select bend from svirac where sifra=:sifra");
        $izraz->execute(["sifra"=>$id]);
        $sifrabend=$izraz->fetchColumn(0);
        $izraz = $db->prepare("delete from svirac where sifra=:sifra");
        $izraz->execute(["sifra"=>$id]);
        $izraz = $db->prepare("delete from bend where sifra=:sifra");
        $izraz->execute(["sifra"=>$sifrabend]);
        $db->commit();
    }

    public static function update($id)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        
        $izraz = $db->prepare("update bend set 
        oib=:oib,
        ime=:ime,
        prezime=:prezime,
        email=:email 
        where sifra=:sifra");
        $izraz->execute([
            "sifra"=>$_POST["sifrabend"],
            "oib"=>$_POST["oib"],
            "ime"=>$_POST["ime"],
            "prezime"=>$_POST["prezime"],
            "email"=>$_POST["email"]
        ]);
        $izraz = $db->prepare("update svirac set 
        brojugovora=:brojugovora
        where sifra=:sifra");
        $izraz->execute([
            "sifra"=>$_POST["sifra"],
            "brojugovora"=>$_POST["brojugovora"]
        ]);
        $db->commit();
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("
                    select
                    b.sifra,
                    a.sifra as sifrabend,
                    a.oib,
                    a.ime,
                    a.prezime,
                    a.email,
                    b.brojugovora
                    from bend a inner join svirac b
                    on a.sifra=b.bend where b.sifra=:sifra;
        ");
        $izraz->execute(["sifra"=>$id]);
        return $izraz->fetch();
    }

    public static function add(){
        $db=Db::getInstance();
        $db->beginTransaction();
       
        $izraz=$db->prepare("insert into bend (sifra,oib,ime,prezime,email) values
        (null,null,'','','')");
        $izraz->execute();
        $sifra = $db->lastInsertId();

        $izraz=$db->prepare("insert into svirac(sifra,bend,brojugovora) values 
        (null,$sifra,null)");
        $izraz->execute();
        $db->commit();
        return $db->lastInsertId();
    }

    public static function read($stranica=1)
    {
        $poStranici=8;
        $db = Db::getInstance();
        $izraz = $db->prepare("
                                select 
                                b.sifra, 
                                a.ime,
                                a.prezime,
                                a.email,
                                a.oib,
                                b.brojugovora,
                                count(c.grupa) as brojgrupa
                            from bend a 
                            inner join svirac b on a.sifra=b.bend
                            left join svirac_nastup c on b.sifra=c.svirac
                            group by
                                b.sifra, 
                                a.ime,
                                a.prezime,
                                a.email,
                                a.oib,
                                b.brojugovora
                            limit " . (($stranica*$poStranici) - $poStranici)  . ",$poStranici
        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }


    public static function traziSvirac($uvjet)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("
                                select 
                                b.sifra, 
                                a.ime,
                                a.prezime,
                                a.email,
                                a.oib,
                                b.brojugovora,
                                count(c.grupa) as brojgrupa
                            from bend a 
                            inner join svirac b on a.sifra=b.bend
                            left join svirac_nastup c on b.sifra=c.svirac
                            where concat(a.ime, ' ', a.prezime) like :uvjet
                            group by
                                b.sifra, 
                                a.ime,
                                a.prezime,
                                a.email,
                                a.oib,
                                b.brojugovora

         ");
        $izraz->execute(["uvjet"=>"%" . $uvjet . "%"]);
        return $izraz->fetchAll();
    }

    public static function readGroups($grupa)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("
                                select 
                                b.sifra, 
                                concat(a.ime, ' ', a.prezime) as svirac,
                                a.email,
                                a.oib,
                                b.brojugovora
                            from bend a 
                            inner join svirac b on a.sifra=b.bend
                            inner join svirac_nastup c on b.sifra=c.svirac
                            where c.grupa=:grupa
        ");
        $izraz->execute(["grupa"=>$grupa]);
        return $izraz->fetchAll();
    }
}