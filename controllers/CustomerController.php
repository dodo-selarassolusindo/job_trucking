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
    #[Map(["GET","POST","OPTIONS"], "/CustomerList[/{CustomerID}]", [PermissionMiddleware::class], "list.customer")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/CustomerAdd[/{CustomerID}]", [PermissionMiddleware::class], "add.customer")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/CustomerView[/{CustomerID}]", [PermissionMiddleware::class], "view.customer")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/CustomerEdit[/{CustomerID}]", [PermissionMiddleware::class], "edit.customer")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/CustomerDelete[/{CustomerID}]", [PermissionMiddleware::class], "delete.customer")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CustomerDelete");
    }
}
