<?php

class Svirac
{


    
public static function read()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("
            select
                   a.sifra,
                   a.ime,
                   a.prezime,
                   a.email,
                   a.bend,
                   b.naziv as naziv_bend
                   from svirac a left join
                   bend b on a.bend=b.sifra
                  
       ");
        $izraz->execute();
        return $izraz->fetchAll();
    }
    public static function find($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("select * from svirac where sifra=:sifra");
        $izraz->execute(["sifra"=>$id]);
        return $izraz->fetch();
    }
    public static function add()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("insert into svirac (ime,prezime,email,bend)
        values (:ime,:prezime,:email,:bend)");
        $izraz->execute(self::podaci());
    }
    public static function update($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("update svirac set 
        ime=:ime,
        prezime=:prezime,
        email=:email,
        bend=:bend
        where sifra=:sifra");
        $podaci = self::podaci();
        $podaci["sifra"]=$id;
        $izraz->execute($podaci);
    }
    public static function delete($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("delete from svirac where sifra=:sifra");
        $podaci = [];
        $podaci["sifra"]=$id;
        $izraz->execute($podaci);
    }
    private static function podaci(){
        return [
            "ime"=>Request::post("ime"),
            "prezime"=>Request::post("prezime"),
            "email"=>Request::post("email"),
            "bend"=>Request::post("bend")
        ];
    }
}