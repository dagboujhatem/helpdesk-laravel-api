<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   schemes={"http","https"},
 *   @SWG\SecurityScheme(
 *      securityDefinition="Bearer",
 *      type="apiKey",
 *      name="Authorization",
 *      in="header"
 *   ),
 *   @SWG\Info(
 *     title="BNA Helpdesk REST API Docs",
 *     description="This documentation summarizes all the calls to our REST API.",
 *     version="1.0.0",
 *   )
 * )
 *
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
