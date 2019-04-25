<?php
class Nastup
{
    public static function read()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("
                select 
                a.sifra,
                a.datumpocetka,
                a.cijena,
                a.adresa,
                a.vrstasvirke,
                a.bend,
                b.naziv as bend_nastup
                from nastup a left join
                bend b on a.bend=b.sifra
       ");
        $izraz->execute();
        return $izraz->fetchAll();
    }
    public static function find($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("select * from nastup where sifra=:sifra");
        $izraz->execute(["sifra"=>$id]);
        return $izraz->fetch();
    }
    public static function add()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("insert into nastup (datumpocetka,cijena,adresa,vrstasvirke,bend)
        values (:datumpocetka,:cijena,:adresa,:vrstasvirke,:bend)");
        $izraz->execute(self::podaci());
    }
    public static function update($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("update nastup set 
        datumpocetka=:datumpocetka,
        cijena=:cijena,
        adresa=:adresa,
        vrstasvirke=:vrstasvirke,
        bend=:bend
        where sifra=:sifra");
        $podaci = self::podaci();
        $podaci["sifra"]=$id;
        $izraz->execute($podaci);
    }
    public static function delete($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("delete from nastup where sifra=:sifra");
        $podaci = [];
        $podaci["sifra"]=$id;
        $izraz->execute($podaci);
    }
    private static function podaci(){
        return [
            "datumpocetka"=>Request::post("datumpocetka"),
            "cijena"=>Request::post("cijena"),
            "adresa"=>Request::post("adresa"),
            "vrstasvirke"=>Request::post("vrstasvirke"),
            "bend"=>Request::post("bend")
        ];
    }
}