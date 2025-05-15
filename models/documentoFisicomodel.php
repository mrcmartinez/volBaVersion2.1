<?php
include_once 'models/documentosFisicos.php';
class DocumentoFisicoModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function prueba(){
        echo "modelprueba";
    }

    public function getById($id){
        $item = new DocumentosFisicos();
        $query = $this->db->connect()->prepare("SELECT*FROM documentofisico WHERE id_personal = :id_personal");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item->id_personal = $row['id_personal'];
                $item->acta = $row['acta'];
                $item->curp = $row['curp'];
                $item->carta = $row['carta'];
                $item->comprobante = $row['comprobante'];
                $item->datos = $row['datos'];
                $item->estudio = $row['estudio'];
                $item->examen = $row['examen'];
                $item->ine = $row['ine'];
                $item->solicitud = $row['solicitud'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE documentoFisico SET acta = :acta, curp = :curp, carta = :carta, comprobante = :comprobante, datos = :datos, estudio = :estudio, examen = :examen, ine = :ine, solicitud = :solicitud WHERE id_personal = :id_personal');
        try{
            $query->execute([
                'id_personal' => $item['id_personal'],
                'acta' => $item['acta'],
                'curp' => $item['curp'],
                'carta' => $item['carta'],
                'comprobante' => $item['comprobante'],
                'datos' => $item['datos'],
                'estudio' => $item['estudio'],
                'examen' => $item['examen'],
                'ine' => $item['ine'],
                'solicitud' => $item['solicitud']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO documentofisico (ID_PERSONAL, ACTA, CURP, CARTA, COMPROBANTE, DATOS,ESTUDIO,EXAMEN,INE,SOLICITUD) VALUES(:id_personal, :acta, :curp, :carta, :comprobante, :datos, :estudio, :examen, :ine, :solicitud)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'acta' => $datos['acta'],
                'curp' => $datos['curp'],
                'carta' => $datos['carta'],
                'comprobante' => $datos['comprobante'],
                'datos' => $datos['datos'],
                'estudio' => $datos['estudio'],
                'examen' => $datos['examen'],
                'ine' => $datos['ine'],
                'solicitud' => $datos['solicitud']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function getBusqueda($c)
    {
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre_personal,p.estatus,d.*
            FROM documentoFisico as d 
            INNER JOIN personal as p
            ON d.id_personal = p.id_personal WHERE p.estatus='Activo' AND (d.id_personal like '%" . $c . "%' OR CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) like '%" . $c . "%') order by nombre_personal");
            while ($row = $query->fetch()) {
                $item = new DocumentosFisicos();
                $item->id_personal = $row['id_personal'];
                $item->nombre_personal = $row['nombre_personal'];
                $item->acta = $row['acta'];
                $item->curp = $row['curp'];
                $item->carta = $row['carta'];
                $item->comprobante = $row['comprobante'];
                $item->datos = $row['datos'];
                $item->estudio = $row['estudio'];
                $item->examen = $row['examen'];
                $item->ine = $row['ine'];
                $item->solicitud = $row['solicitud'];
                array_push($items, $item);
            }
            return $items;
            // print_r($items);
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
}