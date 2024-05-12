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

class JobOrderController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/joborderlist[/{JobOrderID}]", [PermissionMiddleware::class], "list.job_order")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobOrderList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/joborderadd[/{JobOrderID}]", [PermissionMiddleware::class], "add.job_order")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobOrderAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/joborderview[/{JobOrderID}]", [PermissionMiddleware::class], "view.job_order")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobOrderView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/joborderedit[/{JobOrderID}]", [PermissionMiddleware::class], "edit.job_order")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobOrderEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/joborderdelete[/{JobOrderID}]", [PermissionMiddleware::class], "delete.job_order")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JobOrderDelete");
    }
}
