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
 * tanpaunderscore controller
 */
class TanpaunderscoreController extends ControllerBase
{
    // custom
    #[Map(["GET", "POST", "OPTIONS"], "/tanpaunderscore[/{params:.*}]", [PermissionMiddleware::class], "custom.tanpaunderscore")]
    public function custom(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Tanpaunderscore");
    }
}
