<?php
include_once 'models/documentos.php';
class DocumentoModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($datos)
    {
        try {
            $query = $this->db->connect()->prepare('INSERT INTO documentacion (id_personal, nombre, descripcion, estatus) VALUES(:id_personal, :nombre, :descripcion, :estatus)');
            $query->execute(['id_personal' => $datos['id_personal'], 'nombre' => $datos['nombre'], 'descripcion' => $datos['descripcion'], 'estatus' => $datos['estatus']]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function get($id)
    {
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM documentacion WHERE id_personal = :id_personal");
        try {
            $query->execute(['id_personal' => $id]);
            while ($row = $query->fetch()) {
                $item = new Documentos();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    public function getAll()
    {
        $items = [];
        try {
            $query = $this->db->connect()->query('SELECT * FROM documentacion WHERE id_personal IN (SELECT id_personal FROM personal WHERE estatus="Activo")');

            while ($row = $query->fetch()) {
                $item = new Documentos();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    public function delete($id, $nombre)
    {
        $query = $this->db->connect()->prepare("DELETE FROM documentacion WHERE id_personal = :id_personal AND nombre = :nombre");
        try {
            $query->execute([
                'id_personal' => $id,
                'nombre' => $nombre,
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getBusqueda($c)
    {
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre_personal, d.id_personal, d.nombre,d.descripcion, d.estatus
            FROM documentacion as d 
            INNER JOIN personal as p
            ON d.id_personal = p.id_personal WHERE (d.id_personal like '%" . $c . "%' OR d.nombre like '%" . $c . "%')");
            while ($row = $query->fetch()) {
                $item = new Documentos();
                $item->id_personal = $row['id_personal'];
                $item->nombre_personal = $row['nombre_personal'];
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
}