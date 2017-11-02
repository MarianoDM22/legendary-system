<?php namespace Config;

    class Router {

        /**
         * Se encarga de direccionar a la pagina solicitada
         *
         * @param Request
         */
        
        public static function direccionar(Request $request) {

          
            $controlador = "Control" . $request->getControlador();
         
            $metodo = $request->getMetodo();

            $parametros = $request->getParametros();

            
            $mostrar = "Controladoras\\". $controlador;

            
            $controlador = new $mostrar;


            //var_dump($request);

           
            if(!isset($parametros))
             {
                call_user_func(array($controlador, $metodo));
             } 
             else 
             {
                call_user_func_array(array($controlador, $metodo), $parametros);
             }
        }
    }

?>