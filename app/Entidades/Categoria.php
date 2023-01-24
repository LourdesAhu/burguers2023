<?php 

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    public $timestames = false;

    protected $fillable = [
        'idcategoria','nombre',
    ];
    protected $hidden = [

    ];

    
    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
            nombre,
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->nombre,
        ]);
        return $this->idcategoria = DB::getPdo()->lastInsertId();
    }


    public function guardar()
    {
        $sql = "UPDATE categorias SET
            nombre= '$this->nombre',
            WHERE idcategoria=?";
        $affected = DB::update($sql, [
            $this->nombre,
            $this->idcategoria]);
    }


    public function eliminar()
    {
        $sql = "DELETE FROM categorias WHERE 
        idcategoria=?";
        $affected = DB::delete($sql, [$this->idcategoria]);
    }


    public function obtenerTodos()
    {
        $sql = "SELECT
                idcategoria,
                nombre
                FROM categorias ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idcategoria)
    {
        $sql = "SELECT
            idcategoria,
            nombre
            FROM categorias WHERE idcategoria = $idcategoria";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno) > 0) {
            $this->idcategoria = $lstRetorno[0]->idcategoria;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }


}
