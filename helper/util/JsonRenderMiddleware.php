<?php
class JsonRenderMiddleware extends \Slim\Middleware {
    function __construct(){
        $app = \Slim\Slim::getInstance();
        $app->config('debug', false);
        // Mirrors the API request
        $app->get('/return', function() use ($app) {
            $app->render(200,array(
                'method'    => $app->request()->getMethod(),
                'name'      => $app->request()->get('name'),
                'headers'   => $app->request()->headers(),
                'params'    => $app->request()->params(),
            ));
        });
        // Generic error handler
        $app->error(function (Exception $e) use ($app) {
            if ($e->getCode() && $e->getCode() >= 400) {
                $errorCode = $e->getCode();
            } else {
                $errorCode = 500;
            }
            // Log error with the same message
            $message = \JsonRenderMiddleware::_errorType($e->getCode()) .': '. $e->getMessage();
            $app->getLog()->error($message . ' in ' . $e->getFile() . ' at line ' . $e->getLine());
            $app->render($errorCode,array(
                'error'=>array(
                  'code' =>500,
                  'message' => $message . ' in ' . $e->getFile() . ' at line ' . $e->getLine()
                )
            ));
        });
        // Not found handler (invalid routes, invalid method types)
        $app->notFound(function() use ($app) {
            $app->render(404,array(
                'error' => array(
                  'code' => 404,
                  'message'=> 'invalid path'
                )
            ));
        });
        // Handle Empty response body
        $app->hook('slim.after.router', function () use ($app) {
            //Will allow download request to flow
            if($app->response()->header('Content-Type')==='application/octet-stream'){
                return;
            }
            if (strlen($app->response()->body()) == 0) {
                $app->render(204,array(
                    'error' => array(
                      'code' => 204,
                      'message'=> 'Empyty Response'
                    )
                ));
            }
        });
    }
    /**
     * Call next
     */
    function call(){
        return $this->next->call();
    }
    static function _errorType($type=1){
        switch($type)
        {
            default:
            case E_ERROR: // 1 //
                return 'ERROR';
            case E_WARNING: // 2 //
                return 'WARNING';
            case E_PARSE: // 4 //
                return 'PARSE';
            case E_NOTICE: // 8 //
                return 'NOTICE';
            case E_CORE_ERROR: // 16 //
                return 'CORE_ERROR';
            case E_CORE_WARNING: // 32 //
                return 'CORE_WARNING';
            case E_CORE_ERROR: // 64 //
                return 'COMPILE_ERROR';
            case E_CORE_WARNING: // 128 //
                return 'COMPILE_WARNING';
            case E_USER_ERROR: // 256 //
                return 'USER_ERROR';
            case E_USER_WARNING: // 512 //
                return 'USER_WARNING';
            case E_USER_NOTICE: // 1024 //
                return 'USER_NOTICE';
            case E_STRICT: // 2048 //
                return 'STRICT';
            case E_RECOVERABLE_ERROR: // 4096 //
                return 'RECOVERABLE_ERROR';
            case E_DEPRECATED: // 8192 //
                return 'DEPRECATED';
            case E_USER_DEPRECATED: // 16384 //
                return 'USER_DEPRECATED';
        }
    }
}
