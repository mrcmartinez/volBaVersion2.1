
<?php
include_once 'models/personalBanco.php';
// include_once 'models/qrcodigo.php';
class PersonalModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        try{
            $conn=$this->db->connect();
            $query = $conn->prepare('INSERT INTO PERSONAL (ID_PERSONAL,NOMBRE, APELLIDO_PATERNO,
                                                     APELLIDO_MATERNO,CALLE,COLONIA,NUMERO_EXTERIOR,
                                                     FECHA_NACIMIENTO,ESTADO_CIVIL,NUMERO_HIJOS,SEGURO_MEDICO,ESCOLARIDAD,TURNO,HORARIO,ACTIVIDAD,FECHA_INGRESO,OCUPACION,ROLAR,ESTATUS) VALUES(:id_personal,:nombre,
                                                      :apellido_paterno,:apellido_materno,:calle,:colonia,
                                                      :numero_exterior,:fecha_nacimiento,:estado_civil,
                                                      :numero_hijos,:seguro_medico,:escolaridad,:turno,:horario,:actividad,:fecha_ingreso,:ocupacion,:rolar,:estatus)');
            $query->execute(['id_personal' => $datos['id_personal'],'nombre' => $datos['nombre'], 'apellido_paterno' => $datos['apellido_paterno'],
                            'apellido_materno' => $datos['apellido_materno'],'calle' => $datos['calle'],
                            'colonia' => $datos['colonia'],'numero_exterior' => $datos['numero_exterior'],
                            'fecha_nacimiento' => $datos['fecha_nacimiento'],
                            'estado_civil' => $datos['estado_civil'],'numero_hijos' => $datos['numero_hijos'],'seguro_medico' => $datos['seguro_medico'],
                            'escolaridad' => $datos['escolaridad'],'turno' => $datos['turno'],'horario' => $datos['horario'],'actividad' => $datos['actividad'],'fecha_ingreso' => $datos['fecha_ingreso'],'ocupacion' => $datos['ocupacion'],'rolar' => $datos['rolar'],'estatus' => $datos['estatus']]);
            $id = $conn->lastInsertId();
            return array(true, $id);
        }catch(PDOException $e){
            return array(false);
        }   
    }
    public function getBusqueda($c,$f,$h,$r){

         $items = [];
         try{
             $query = $this->db->connect()->query("SELECT ns.tipo, no.tipo as tipo2,vp.* 
                                                    FROM vistapersonalv as vp
                                                    left join notasalud as ns
                                                    ON ns.id_personal = vp.id_personal
                                                    left join notasob as no
                                                    on no.id_personal = vp.id_personal
                                                 WHERE (vp.nombreCompleto like '%".$c."%' OR vp.nombreCompletoR like '%".$c."%' OR vp.turno like '%".$c."%' OR vp.actividad like '%".$c."%' OR vp.id_personal ='$c' OR vp.estatus like '%".$c."%') AND vp.horario like '%".$h."%' AND vp.estatus like '%".$f."%' ORDER BY vp.nombreCompleto");
 
             while($row = $query->fetch()){
                 $item = new PersonalBanco();
                 $item->id_personal = $row['id_personal'];
                 $item->nombre = $row['nombre'];
                 $item->apellido_paterno = $row['apellido_paterno'];
                 $item->apellido_materno = $row['apellido_materno'];
                 $item->turno = $row['turno'];
                 $item->actividad = $row['actividad'];
                 $item->horario = $row['horario'];
                 $item->fecha_ingreso = $row['fecha_ingreso'];
                 $item->estatus = $row['estatus'];
                 $item->rolar = $row['rolar'];
                 $item->tipo = $row['tipo'];
                 $item->tipo2 = $row['tipo2'];
                 array_push($items, $item);         
             }
             return $items;
         }catch(PDOException $e){
             return [];
         }
     }
     public function getBusquedaLista($c,$f,$h){

        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT ns.tipo, no.tipo as tipo2,vp.* 
                                                   FROM vistapersonalv as vp
                                                   left join notasalud as ns
                                                   ON ns.id_personal = vp.id_personal
                                                   left join notasob as no
                                                   on no.id_personal = vp.id_personal
                                                WHERE (vp.nombreCompleto like '%".$c."%' OR vp.nombreCompletoR like '%".$c."%' OR vp.turno like '%".$c."%' OR vp.actividad like '%".$c."%' OR vp.id_personal ='$c' OR vp.estatus like '%".$c."%') AND vp.horario like '%".$h."%' AND vp.estatus like '%".$f."%' ORDER BY vp.nombreCompleto");

            while($row = $query->fetch()){
                $item = new PersonalBanco();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->apellido_paterno = $row['apellido_paterno'];
                $item->apellido_materno = $row['apellido_materno'];
                $item->turno = $row['turno'];
                $item->actividad = $row['actividad'];
                $item->horario = $row['horario'];
                $item->fecha_ingreso = $row['fecha_ingreso'];
                $item->estatus = $row['estatus'];
                $item->rolar = $row['rolar'];
                $item->tipo = $row['tipo'];
                $item->tipo2 = $row['tipo2'];
                array_push($items, $item);         
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    //  public function getBusquedaReport($c,$f,$h){

    //     $items = [];
    //     try{
    //         $query = $this->db->connect()->query("SELECT ns.tipo, no.tipo as tipo2,vp.* 
    //                                                FROM vistapersonalv as vp
    //                                                left join notasalud as ns
    //                                                ON ns.id_personal = vp.id_personal
    //                                                left join notasob as no
    //                                                on no.id_personal = vp.id_personal
    //                                             WHERE (vp.nombreCompleto like '%".$c."%' OR vp.nombreCompletoR like '%".$c."%' OR vp.turno like '%".$c."%' OR vp.actividad like '%".$c."%' OR vp.id_personal ='$c' OR vp.estatus like '%".$c."%') AND vp.horario like '%".$h."%' AND vp.estatus like '%".$f."%' ORDER BY vp.nombreCompleto");

    //         while($row = $query->fetch()){
    //             $item = new PersonalBanco();
    //             $item->id_personal = $row['id_personal'];
    //             $item->nombre = $row['nombre'];
    //             $item->apellido_paterno = $row['apellido_paterno'];
    //             $item->apellido_materno = $row['apellido_materno'];
    //             $item->turno = $row['turno'];
    //             $item->actividad = $row['actividad'];
    //             $item->horario = $row['horario'];
    //             $item->fecha_ingreso = $row['fecha_ingreso'];
    //             $item->estatus = $row['estatus'];
    //             $item->rolar = $row['rolar'];
    //             $item->tipo = $row['tipo'];
    //             $item->tipo2 = $row['tipo2'];
    //             array_push($items, $item);         
    //         }
    //         return $items;
    //     }catch(PDOException $e){
    //         return [];
    //     }
    // }
     public function getBusquedaSig($c,$f,$h){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT v.*, p.*
                                                FROM vistapersonalv as v
                                                INNER JOIN personal as p
                                                ON v.id_personal = p.id_personal
                                                WHERE (v.nombreCompleto like '%".$c."%' OR v.nombreCompletoR like '%".$c."%' OR p.escolaridad like '%".$c."%' OR p.estado_civil like '%".$c."%' OR v.id_personal ='$c' OR DATE_FORMAT(p.fecha_nacimiento,'%M') ='$c' OR p.colonia like '%".$c."%' OR p.calle like '%".$c."%') AND p.horario like '%".$h."%' AND v.estatus like '%".$f."%' ORDER BY v.nombreCompleto");

            while($row = $query->fetch()){
                $item = new PersonalBanco();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->apellido_paterno = $row['apellido_paterno'];
                $item->apellido_materno = $row['apellido_materno'];
                $item->calle = $row['calle'];
                $item->colonia = $row['colonia'];
                $item->numero_exterior = $row['numero_exterior'];
                $item->escolaridad = $row['escolaridad'];
                $item->numero_hijos = $row['numero_hijos'];
                $item->estado_civil = $row['estado_civil'];
                $item->fecha_nacimiento = $row['fecha_nacimiento'];
                $item->ocupacion = $row['ocupacion'];
                $item->estatus = $row['estatus'];
                $item->rolar = $row['rolar'];
                array_push($items, $item);         
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getBusquedaAll($c,$f,$h){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT v.*, p.escolaridad,p.numero_hijos,p.fecha_nacimiento,p.estado_civil,p.rolar
                                                FROM vistapersonalv as v
                                                INNER JOIN personal as p
                                                ON v.id_personal = p.id_personal
                                                -- LEFT JOIN observacion as ob
                                                -- ON ob.id_personal = v.id_personal
                                                WHERE (v.nombreCompleto like '%".$c."%' OR v.nombreCompletoR like '%".$c."%' OR p.escolaridad like '%".$c."%' OR p.estado_civil like '%".$c."%' OR v.id_personal ='$c' OR DATE_FORMAT(p.fecha_nacimiento,'%M') ='$c' OR v.turno like '%".$c."%' OR v.actividad like '%".$c."%') AND v.horario like '%".$h."%' AND v.estatus like '%".$f."%' ORDER BY v.nombreCompleto");

            while($row = $query->fetch()){
                $item = new PersonalBanco();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->apellido_paterno = $row['apellido_paterno'];
                $item->apellido_materno = $row['apellido_materno'];
                $item->actividad = $row['actividad'];
                $item->turno = $row['turno'];
                $item->horario = $row['horario'];
                $item->fecha_ingreso = $row['fecha_ingreso'];
                $item->escolaridad = $row['escolaridad'];
                $item->numero_hijos = $row['numero_hijos'];
                $item->estado_civil = $row['estado_civil'];
                $item->fecha_nacimiento = $row['fecha_nacimiento'];
                $item->estatus = $row['estatus'];
                $item->rolar = $row['rolar'];
                // $item->tipo = $row['tipo'];
                array_push($items, $item);         
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getById($id){
        $item = new PersonalBanco();
        $query = $this->db->connect()->prepare("SELECT * FROM personal WHERE id_personal = :id_personal");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->apellido_paterno = $row['apellido_paterno'];
                $item->estatus = $row['estatus'];
                $item->apellido_materno = $row['apellido_materno'];
                $item->calle = $row['calle'];
                $item->colonia = $row['colonia'];
                $item->numero_exterior = $row['numero_exterior'];
                $item->fecha_nacimiento = $row['fecha_nacimiento'];
                $item->estado_civil = $row['estado_civil'];
                $item->numero_hijos = $row['numero_hijos'];
                $item->seguro_medico = $row['seguro_medico'];
                $item->turno = $row['turno'];
                $item->horario = $row['horario'];
                $item->actividad = $row['actividad'];
                $item->escolaridad = $row['escolaridad'];
                $item->ocupacion = $row['ocupacion'];
                $item->fecha_ingreso = $row['fecha_ingreso'];
                $item->rolar = $row['rolar'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE personal SET nombre = :nombre, estatus = :estatus, 
        apellido_paterno = :apellido_paterno,apellido_materno = :apellido_materno, calle = :calle, colonia = :colonia,
        numero_exterior = :numero_exterior, fecha_nacimiento = :fecha_nacimiento, estado_civil = :estado_civil,
        numero_hijos = :numero_hijos,seguro_medico = :seguro_medico, escolaridad = :escolaridad, turno = :turno, horario = :horario, actividad = :actividad, fecha_ingreso = :fecha_ingreso, ocupacion = :ocupacion , rolar = :rolar WHERE id_personal = :id_personal");
        try{
            $query->execute([
                'id_personal'=> $item['id_personal'],
                'nombre'=> $item['nombre'],
                'estatus'=> $item['estatus'],
                'apellido_paterno'=> $item['apellido_paterno'],
                'apellido_materno'=> $item['apellido_materno'],
                'calle'=> $item['calle'],
                'colonia'=> $item['colonia'],
                'numero_exterior'=> $item['numero_exterior'],
                'fecha_nacimiento'=> $item['fecha_nacimiento'],
                'estado_civil'=> $item['estado_civil'],
                'numero_hijos'=> $item['numero_hijos'],
                'seguro_medico'=> $item['seguro_medico'],
                'escolaridad'=> $item['escolaridad'],
                'turno'=> $item['turno'],
                'horario'=> $item['horario'],
                'fecha_ingreso'=> $item['fecha_ingreso'],
                'ocupacion'=> $item['ocupacion'],
                'rolar'=> $item['rolar'],
                'actividad'=> $item['actividad']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id,$estatus){
        if ($estatus=="Activo") {
            $query = $this->db->connect()->prepare("UPDATE personal SET estatus = 'Baja' WHERE id_personal = :id_personal");
        }else {
            $query = $this->db->connect()->prepare("UPDATE personal SET estatus = 'Activo' WHERE id_personal = :id_personal");
        }
        try{
            $query->execute([
                'id_personal'=> $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function deleteBajaMotivo($id){
            $query = $this->db->connect()->prepare("DELETE FROM bajas WHERE id_personal = :id_personal");
        try{
            $query->execute([
                'id_personal'=> $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function insertBaja($datos){
        $query = $this->db->connect()->prepare('INSERT INTO bajas (ID_PERSONAL, FECHA, MOTIVO) VALUES(:id_personal, :fecha, :motivo)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $datos['fecha'],
                'motivo' => $datos['motivo']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function updateIngreso($datos){
        $query = $this->db->connect()->prepare("UPDATE personal SET fecha_ingreso = :fecha_ingreso WHERE id_personal = :id_personal");
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha_ingreso' => $datos['fecha_ingreso']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function pruebaModel(){
        echo "entro a pruebaModel";
    }
    public function insertQr($datos){
        // echo "entro a modelQR";
        // print_r($datos);
        $query = $this->db->connect()->prepare('INSERT INTO CODE (id_personal, identificador, fecha_modificacion) VALUES(:id_personal, :identificador, :fecha_modificacion)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'identificador' => $datos['identificador'],
                'fecha_modificacion' => $datos['fecha_modificacion']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function consultarIden($id){
        $iden="";
        $query = $this->db->connect()->prepare("SELECT * FROM code WHERE id_personal = :id_personal");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $iden=$row['identificador'];
            }
            return $iden;
        }catch(PDOException $e){
            return null;
        }
    }
    public function consultarId($id){
        $nomb="";
        $query = $this->db->connect()->prepare("SELECT nombreCompleto from vistapersonalv where id_personal=:id_personal");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $nomb=$row['nombreCompleto'];
            }
            return $nomb;
        }catch(PDOException $e){
            return null;
        }
    }

    public function deleteCandidato($id,$estatus){
        $query = $this->db->connect()->prepare("UPDATE candidato SET estatus = :estatus WHERE id_candidato = :id_candidato");
    try{
        $query->execute([
            'id_candidato'=> $id,
            'estatus'=> $estatus
        ]);
        return true;
    }catch(PDOException $e){
        return false;
    }
}
public function deleteVoluntariado($id){
    $query = $this->db->connect()->prepare("DELETE FROM personal WHERE id_personal = :id_personal");
    try{
        $query->execute([
            'id_personal'=> $id
        ]);
        return true;
    }catch(PDOException $e){
        return false;
    }
}
public function updateEstado(){
    $query=$this->db->connect()->prepare("UPDATE personal set estatus = 'Activo-Pendiente' WHERE id_personal IN ( SELECT v.id_personal from vistafaltasRango as v INNER JOIN personal as p ON v.id_personal = p.id_personal WHERE p.estatus='Activo')");
    try{
        $query->execute();
        return true;
    }catch(PDOException $e){
        return false;
    }
}
public function updateEstadoFalta(){
    $query=$this->db->connect()->prepare("UPDATE personal set estatus = 'Activo' WHERE id_personal IN ( SELECT v.id_personal from vistafaltaRango as v INNER JOIN personal as p ON v.id_personal = p.id_personal WHERE p.estatus='Activo-Pendiente')");
    try{
        $query->execute();
        return true;
    }catch(PDOException $e){
        return false;
    }
}
public function insertNota($datos){
    $query = $this->db->connect()->prepare('INSERT INTO observacion (ID_PERSONAL, TIPO, COMENTARIO) VALUES(:id_personal, :tipo, :comentario)');
    try{
        $query->execute([
            'id_personal' => $datos['id_personal'],
            'tipo' => $datos['tipo'],
            'comentario' => $datos['comentario']
        ]);
        return true;
    }catch(PDOException $e){
        return false;
    }    
}
public function deleteNote($id,$tipo){
    $query = $this->db->connect()->prepare("DELETE from observacion WHERE id_personal = :id AND tipo = :tipo");
try{
    $query->execute([
        'id' => $id,
        'tipo' => $tipo
    ]);
    return true;
}catch(PDOException $e){
    return false;
}
}
}

?>