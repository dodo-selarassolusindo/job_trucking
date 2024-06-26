<?php

namespace PHPMaker2024\prj_job_trucking;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\prj_job_trucking\Attributes\Delete;
use PHPMaker2024\prj_job_trucking\Attributes\Get;
use PHPMaker2024\prj_job_trucking\Attributes\Map;
use PHPMaker2024\prj_job_trucking\Attributes\Options;
use PHPMaker2024\prj_job_trucking\Attributes\Patch;
use PHPMaker2024\prj_job_trucking\Attributes\Post;
use PHPMaker2024\prj_job_trucking\Attributes\Put;

/**
 * beranda controller
 */
class BerandaController extends ControllerBase
{
    // custom
    #[Map(["GET", "POST", "OPTIONS"], "/beranda[/{params:.*}]", [PermissionMiddleware::class], "custom.beranda")]
    public function custom(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Beranda");
    }
}
