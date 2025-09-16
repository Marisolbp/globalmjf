<?php

/**
 * ANALIZADOR DE INTENCIONES KHALIBOT - VERSIÓN CORREGIDA
 */

class KhalibotAnalizador {
    
    private $diccionarioPalabras;
    private $stopWords;
    
    public function __construct() {
        $this->inicializarDiccionarios();
    }
    
    /**
     * Inicializa los diccionarios de palabras clave y stop words
     */
    private function inicializarDiccionarios() {
        $this->diccionarioPalabras = [
            'venta' => [
                'venta', 'vender', 'comprar', 'compra', 'adquirir', 'adquisicion', 
                'comprando', 'vendiendo', 'en venta', 'se vende', 'compro', 'vendo'
            ],
            'alquiler' => [
                'alquiler', 'alquilar', 'rentar', 'renta', 'arrendar', 'arriendo',
                'alquilo', 'rento', 'se alquila', 'se renta', 'para alquilar'
            ],
            'propiedades' => [
                'propiedad', 'propiedades', 'inmueble', 'inmuebles', 'casa', 'casas',
                'departamento', 'departamentos', 'terreno', 'terrenos', 'local',
                'locales', 'oficina', 'oficinas', 'vivienda', 'viviendas'
            ],
            'proyectos_arquitectura' => [
                'proyecto', 'proyectos', 'arquitectura', 'arquitecto', 'diseño',
                'construccion', 'construir', 'planos', 'render', 'renders',
                'modelado', '3d', 'diseñar', 'arquitectonico', 'construcciones'
            ],
            'declaratoria_fabrica' => [
                'declaratoria', 'fabrica', 'fábrica', 'declaracion', 'independizacion',
                'independizar', 'titulo', 'titulos', 'escritura', 'escrituras',
                'tramite', 'tramites', 'legal', 'documentos', 'papeles'
            ],
            'cita_asesor' => [
                'cita', 'reunion', 'reunión', 'agendar', 'programar', 'asesor',
                'asesoria', 'asesoría', 'consulta', 'entrevista', 'appointment',
                'meeting', 'hablar', 'conversar', 'encontrarnos'
            ],
            'recomendaciones' => [
                'recomendacion', 'recomendaciones', 'sugerir', 'sugerencia',
                'recomendar', 'que me recomiendas', 'opciones', 'alternativas',
                'personalizado', 'personalizada', 'perfil', 'gustos', 'intereses'
            ],
            'precios' => [
                'precio', 'precios', 'costo', 'costos', 'valor', 'valores',
                'cuanto', 'cuánto', 'tarifa', 'tarifas', 'presupuesto'
            ],
            'ubicacion' => [
                'donde', 'dónde', 'ubicacion', 'ubicación', 'direccion', 'dirección',
                'zona', 'distrito', 'lugar', 'sitio', 'localización'
            ]
        ];
        
        // Palabras que no afectan la intención (stop words)
        $this->stopWords = [
            'hola', 'hello', 'hi', 'buenos', 'dias', 'tardes', 'noches',
            'mucho', 'gusto', 'encantado', 'encantada', 'gracias', 'thank',
            'por', 'favor', 'please', 'disculpe', 'disculpa', 'perdón',
            'perdon', 'sorry', 'buenas', 'saludos', 'cordial', 'atentamente',
            'un', 'una', 'el', 'la', 'los', 'las', 'de', 'del', 'en', 'con',
            'para', 'por', 'sin', 'sobre', 'bajo', 'ante', 'tras', 'durante',
            'mediante', 'según', 'segun', 'entre', 'hacia', 'hasta', 'desde',
            'y', 'o', 'pero', 'sino', 'aunque', 'porque', 'pues', 'como',
            'si', 'cuando', 'donde', 'que', 'quien', 'cual', 'cuyo',
            'este', 'esta', 'estos', 'estas', 'ese', 'esa', 'esos', 'esas',
            'aquel', 'aquella', 'aquellos', 'aquellas', 'mi', 'tu', 'su',
            'nuestro', 'vuestro', 'mio', 'tuyo', 'suyo', 'me', 'te', 'se',
            'nos', 'os', 'le', 'les', 'lo', 'la', 'los', 'las'
        ];
    }
    
    /**
     * Limpia una frase removiendo stop words y caracteres especiales
     * @param string $frase
     * @return array Palabras limpias
     */
    private function limpiarFrase($frase) {
        // Convertir a minúsculas y remover caracteres especiales
        $frase = strtolower($frase);
        $frase = preg_replace('/[^\w\sáéíóúñü]/u', ' ', $frase);
        
        // Dividir en palabras
        $palabras = preg_split('/\s+/', $frase);
        
        // Filtrar stop words y palabras vacías
        $palabrasLimpias = array_filter($palabras, function($palabra) {
            return !empty(trim($palabra)) && !in_array(trim($palabra), $this->stopWords);
        });
        
        return array_values($palabrasLimpias);
    }
    
    /**
     * Obtiene solo los nombres de las intenciones detectadas
     * @param string $mensaje
     * @return array Solo nombres de intenciones
     */
    public function obtenerIntenciones($mensaje) {
        $palabrasLimpias = $this->limpiarFrase($mensaje);
        $intenciones = [];
        
        foreach ($this->diccionarioPalabras as $categoria => $palabrasClave) {
            foreach ($palabrasClave as $palabra) {
                foreach ($palabrasLimpias as $palabraLimpia) {
                    // Coincidencia exacta
                    if ($palabra === $palabraLimpia) {
                        $intenciones[] = $categoria;
                        break 2; // Salir de ambos foreach para esta categoría
                    }
                    // Coincidencia parcial para palabras largas
                    elseif (strlen($palabra) > 3 && strlen($palabraLimpia) > 3) {
                        if (strpos($palabraLimpia, $palabra) !== false || strpos($palabra, $palabraLimpia) !== false) {
                            $intenciones[] = $categoria;
                            break 2; // Salir de ambos foreach para esta categoría
                        }
                    }
                }
            }
        }
        
        return array_unique($intenciones);
    }
}

/**
 * GENERADOR DE RESPUESTAS BASADO EN INTENCIONES
 */
class KhalibotRespuestas {
    
    /**
     * Genera respuesta basada en las intenciones detectadas
     * @param array $intenciones
     * @param string $mensajeOriginal
     * @return string
     */
    public function generarRespuesta($intenciones, $mensajeOriginal = '') {
        
        if (empty($intenciones)) {
            return $this->respuestaPorDefecto();
        }
        
        // Respuestas combinadas para múltiples intenciones
        if (count($intenciones) > 1) {
            return $this->respuestaMultiple($intenciones);
        }
        
        // Respuestas específicas por intención
        $intencionPrincipal = $intenciones[0];
        
        switch ($intencionPrincipal) {
            case 'venta':
                return "¡Perfecto! Te ayudo con propiedades en venta. ¿Qué tipo de propiedad buscas: casa, departamento o terreno?";
                
            case 'alquiler':
                return "Excelente, tengo varias opciones en alquiler. ¿Prefieres casa, departamento o local comercial?";
                
            case 'propiedades':
                return "¿Te interesa comprar, alquilar o necesitas información general sobre nuestras propiedades?";
                
            case 'proyectos_arquitectura':
                return "¡Genial! Nuestro equipo de arquitectos puede ayudarte. ¿Es para diseño residencial, comercial o necesitas renders 3D?";
                
            case 'declaratoria_fabrica':
                return "Te puedo ayudar con el trámite de declaratoria de fábrica. Es un proceso importante para independizar tu propiedad. ¿Ya tienes la construcción terminada?";
                
            case 'cita_asesor':
                return "Por supuesto, puedo agendar una cita con nuestros asesores. ¿Prefieres reunión presencial o virtual? ¿Qué horario te conviene mejor?";
                
            case 'recomendaciones':
                return "¡Hola de nuevo! Basado en tus intereses anteriores, aquí tienes algunas propiedades y servicios que podrían gustarte. ¿Qué tipo de recomendación buscas específicamente?";
                
            case 'precios':
                return "Te puedo proporcionar información sobre precios. ¿Es sobre propiedades en venta, alquiler, o servicios de arquitectura?";
                
            case 'ubicacion':
                return "¿En qué zona o distrito estás buscando? Tenemos propiedades en diversas ubicaciones.";
                
            default:
                return $this->respuestaPorDefecto();
        }
    }
    
    /**
     * Maneja respuestas para múltiples intenciones
     * @param array $intenciones
     * @return string
     */
    private function respuestaMultiple($intenciones) {
        
        // Venta + Propiedades
        if (in_array('venta', $intenciones) && in_array('propiedades', $intenciones)) {
            return "¡Perfecto! Te ayudo con propiedades en venta. ¿Qué tipo de inmueble buscas y en qué zona?";
        }
        
        // Alquiler + Propiedades
        if (in_array('alquiler', $intenciones) && in_array('propiedades', $intenciones)) {
            return "Excelente, tengo varias opciones de propiedades en alquiler. ¿Buscas casa, departamento o local comercial?";
        }
        
        // Precios + cualquier servicio
        if (in_array('precios', $intenciones)) {
            return "Te ayudo con información sobre precios. ¿Qué específicamente te interesa conocer?";
        }
        
        // Cita + cualquier servicio
        if (in_array('cita_asesor', $intenciones)) {
            return "Perfecto, puedo agendar una cita para que nuestro especialista te asesore personalmente. ¿Qué día y hora te conviene?";
        }
        
        // Respuesta genérica para múltiples intenciones
        return "Veo que tienes varios intereses. Te puedo ayudar con todo eso. ¿Por dónde quieres empezar?";
    }
    
    /**
     * Respuesta por defecto cuando no se detectan intenciones
     * @return string
     */
    private function respuestaPorDefecto() {
        $respuestasDefecto = [
            "¡Hola! Soy Khalibot, tu asistente inmobiliario. Te puedo ayudar con propiedades en venta, alquileres, proyectos arquitectónicos, declaratorias de fábrica y mucho más. ¿En qué te puedo asistir?",
            "¡Bienvenido! ¿Te interesa alguna propiedad en particular, necesitas servicios de arquitectura o tienes alguna consulta específica?",
            "¡Hola! Estoy aquí para ayudarte con todo lo relacionado a bienes raíces y arquitectura. ¿Qué necesitas hoy?"
        ];
        
        return $respuestasDefecto[array_rand($respuestasDefecto)];
    }
}

/**
 * FUNCIÓN PRINCIPAL PARA USAR EN EL CONTROLADOR
 */
function procesarChatKhalibot($mensaje) {
    $analizador = new KhalibotAnalizador();
    $generadorRespuestas = new KhalibotRespuestas();
    
    // Obtener intenciones
    $intenciones = $analizador->obtenerIntenciones($mensaje);
    
    // Generar respuesta
    $respuesta = $generadorRespuestas->generarRespuesta($intenciones, $mensaje);
    
    return [
        'response' => $respuesta,
        'intenciones' => $intenciones
    ];
}

?>