<?php

class Bend
{

    public static function read()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("
        
                    select 
                    sifra,
                    naziv,
                    korisnickoime,
                    lozinka,
                    email
                    from bend

        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("select * from bend where sifra=:sifra");
        $izraz->execute(["sifra"=>$id]);
        return $izraz->fetch();
    }

    public static function add()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("insert into bend (naziv,korisnickoime,lozinka,email) 
        values (:naziv,:korisnickoime,:lozinka,:email)");
        $izraz->execute(self::podaci());
    }

    public static function update($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("update bend set 
        naziv=:naziv,
        korisnickoime=:korisnickoime,
        lozinka=:lozinka,
        email=:email
        where sifra=:sifra");
        $podaci = self::podaci();
        $podaci["sifra"]=$id;
        $izraz->execute($podaci);
    }



    public static function delete($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("delete from bend where sifra=:sifra");
        $podaci = [];
        $podaci["sifra"]=$id;
        $izraz->execute($podaci);
    }

    private static function podaci(){
        return [
            "naziv"=>Request::post("naziv"),
            "korisnickoime"=>Request::post("korisnickoime"),
            "lozinka"=>Request::post("lozinka"),
            "email"=>Request::post("email")
        ];
    }


}