<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="Organization Directory API",
 *     version="1.0.0",
 *     description="REST API для справочника организаций, зданий и деятельности",
 *     @OA\Contact(
 *         email="support@example.com"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="apiKey",
 *     type="apiKey",
 *     in="header",
 *     name="X-API-KEY",
 *     description="API Key для авторизации"
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Development Server"
 * )
 */
abstract class Controller
{
    //
}
