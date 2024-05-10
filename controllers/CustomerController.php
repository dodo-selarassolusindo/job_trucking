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

class CustomerController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/customerlist[/{id}]", [PermissionMiddleware::class], "list.customer")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/customeradd[/{id}]", [PermissionMiddleware::class], "add.customer")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/customerview[/{id}]", [PermissionMiddleware::class], "view.customer")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/customeredit[/{id}]", [PermissionMiddleware::class], "edit.customer")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/customerdelete[/{id}]", [PermissionMiddleware::class], "delete.customer")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerDelete");
    }
}
