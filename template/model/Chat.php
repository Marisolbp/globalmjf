<?php
date_default_timezone_set('America/Bogota');
require_once("../config/conexion.php"); 
class Chat extends Conectar{

    public function buscarPropiedades(string $modalidad, array $criterios): array {

        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT id, nombre, direccion, precio, moneda 
                  FROM g_propi_venta 
                 WHERE modalidad = :modalidad 
                   AND estado = 'A' ";
        $params = [":modalidad" => $modalidad];

        if (!empty($criterios["departamento"])) {
            $sql .= " AND id_depart = :id_depart";
            $params[":id_depart"] = (int) $criterios["departamento"];
        }
        if (!empty($criterios["precio_max"])) {
            $sql .= " AND precio <= :precio_max";
            $params[":precio_max"] = (float) $criterios["precio_max"];
        }

        $stmt = $conectar->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Registrar solicitud (cita o interés)
     */
    public function registrarSolicitud(array $data): int {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO g_solicitud(
                    nombre, 
                    apellido, 
                    tip_doc, 
                    email, 
                    dni, 
                    telefono, 
                    modalidad,
                    id_t_prop, 
                    id_depart, 
                    id_provin, 
                    id_distri, 
                    detalle, 
                    estado, 
                    fec_crea, 
                    usu_crea
                ) VALUES (
                    :nombre, 
                    :apellido,
                    :tip_doc, 
                    :email, 
                    :dni, 
                    :telefono, 
                    :modalidad,
                    :id_t_prop,
                    :id_depart, 
                    :id_provin, 
                    :id_distri, 
                    :detalle,
                    'P',
                    NOW(), 
                    'chatbot'
                )";

        $stmt = $conectar->prepare($sql);
        $stmt->execute([
            ':nombre'    => $data['nombre']    ?? '',
            ':apellido'  => $data['apellido']  ?? '',
            ':tip_doc'   => $data['tip_doc']   ?? 'DNI',
            ':email'     => $data['email']     ?? null,
            ':dni'       => $data['dni']       ?? '',
            ':telefono'  => $data['telefono']  ?? '',
            ':modalidad' => $data['modalidad'] ?? 'V',
            ':id_t_prop' => $data['id_t_prop'] ?? 0,
            ':id_depart' => $data['id_depart'] ?? 0,
            ':id_provin' => $data['id_provin'] ?? 0,
            ':id_distri' => $data['id_distri'] ?? 0,
            ':detalle'   => $data['detalle']   ?? null,
        ]);

        return (int) $conexion->lastInsertId();
    }

    public function normalizarDireccion($departamento, $provincia, $distrito) {

        $resultado = [
            'id_departamento' => null,
            'id_provincia'    => null,
            'id_distrito'     => null,
        ];

        // Buscar departamento
        if (!empty($departamento)) {
            $stmt = $pdo->prepare("
                SELECT id 
                  FROM m_departamento 
                 WHERE LOWER(nombre) LIKE LOWER(:departamento)
            ");
            $stmt->execute(['departamento' => $departamento]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado['id_departamento'] = $row['id'];
            }
        }

        // Buscar provincia
        if (!empty($provincia) && !empty($resultado['id_departamento'])) {
            $stmt = $pdo->prepare("
                SELECT id 
                  FROM m_provincia 
                 WHERE LOWER(nombre) LIKE LOWER(:provincia) 
                   AND id_depart = :id_depart
            ");
            $stmt->execute([
                'provincia' => $provincia,
                'id_depart' => $resultado['id_departamento']
            ]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado['id_provincia'] = $row['id'];
            }
        }

        // Buscar distrito
        if (!empty($distrito) && !empty($resultado['id_provincia'])) {
            $stmt = $pdo->prepare("
                SELECT id 
                  FROM m_distrito 
                 WHERE LOWER(nombre) LIKE LOWER(:distrito) 
                   AND id_provin = :id_provin
            ");
            $stmt->execute([
                'distrito'  => $distrito,
                'id_provin' => $resultado['id_provincia']
            ]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado['id_distrito'] = $row['id'];
            }
        }

        return $resultado;
    }
}