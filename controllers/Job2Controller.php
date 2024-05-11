<?php

namespace PHPMaker2024\prj_job_trucking;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\prj_job_trucking\Attributes\Delete;
use PHPMaker2024\prj_job_trucking\Attributes\Get;
use PHPMaker2024\prj_job_trucking\Attributes\Map;
use PHPMaker2024\prj_job_trucking\Attributes\Options;
use PHPMaker2024\prj_job_trucking\Attributes\Patch;
use PHPMaker2024\prj_job_trucking\Attributes\Post;
use PHPMaker2024\prj_job_trucking\Attributes\Put;

class Job2Controller extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/job2list[/{Job2ID}]", [PermissionMiddleware::class], "list.job2")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Job2List");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/job2add[/{Job2ID}]", [PermissionMiddleware::class], "add.job2")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Job2Add");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/job2view[/{Job2ID}]", [PermissionMiddleware::class], "view.job2")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Job2View");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/job2edit[/{Job2ID}]", [PermissionMiddleware::class], "edit.job2")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Job2Edit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/job2delete[/{Job2ID}]", [PermissionMiddleware::class], "delete.job2")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Job2Delete");
    }
}
