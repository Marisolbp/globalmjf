<?php
date_default_timezone_set('America/Bogota');
class Solicitud extends Conectar{
    public function get_solicitud(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            g_solicitud.id, 
            g_solicitud.nombre,
            g_solicitud.apellido,
            g_solicitud.dni,
            g_solicitud.telefono,
            g_solicitud.modalidad,
            CASE  g_solicitud.modalidad
                WHEN 'V' THEN 'Venta'
                ELSE 'Alquiler'
            END modalidad_nombre,
            g_solicitud.id_t_prop,
            m_tipo_propiedad.nombre tipo,
            g_solicitud.estado
            FROM 
            g_solicitud
            INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_solicitud.id_t_prop
            ORDER BY g_solicitud.fec_crea DESC";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function solicitud_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            g_solicitud.id,
            g_solicitud.nombre,
            g_solicitud.apellido,
            g_solicitud.dni,
            g_solicitud.telefono,
            g_solicitud.modalidad,
            CASE  g_solicitud.modalidad
                WHEN 'V' THEN 'Venta'
                ELSE 'Alquiler'
            END modalidad_nombre,
            g_solicitud.id_t_prop,
            m_tipo_propiedad.nombre tipo,
            g_solicitud.id_depart,
            m_departamento.nombre departamento,
            g_solicitud.id_provin,
            m_provincia.nombre provincia,
            g_solicitud.id_distri,
            m_distrito.nombre distrito,
            g_solicitud.detalle,
            g_solicitud.estado
            FROM
            g_solicitud
            INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_solicitud.id_t_prop
            INNER JOIN m_departamento ON g_solicitud.id_depart = m_departamento.id
            INNER JOIN m_provincia ON g_solicitud.id_provin = m_provincia.id
            INNER JOIN m_distrito ON g_solicitud.id_distri = m_distrito.id
            WHERE g_solicitud.id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function actualizar_estado($id, $tipo, $usuario){
        $conectar= parent::conexion();
        parent::set_names();

        $sql = "UPDATE g_solicitud SET estado = ?, fec_actu = now(), usu_actu = ? WHERE id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$tipo);
        $sql->bindValue(2,$usuario);
        $sql->bindValue(3,$id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}