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
 * joborder2 controller
 */
class Joborder2Controller extends ControllerBase
{
    // custom
    #[Map(["GET", "POST", "OPTIONS"], "/joborder2[/{params:.*}]", [PermissionMiddleware::class], "custom.joborder2")]
    public function custom(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Joborder2");
    }
}
