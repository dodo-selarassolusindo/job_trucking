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

class JobController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/JobList[/{JobID}]", [PermissionMiddleware::class], "list.job")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/JobAdd[/{JobID}]", [PermissionMiddleware::class], "add.job")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/JobView[/{JobID}]", [PermissionMiddleware::class], "view.job")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/JobEdit[/{JobID}]", [PermissionMiddleware::class], "edit.job")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/JobDelete[/{JobID}]", [PermissionMiddleware::class], "delete.job")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobDelete");
    }
}
