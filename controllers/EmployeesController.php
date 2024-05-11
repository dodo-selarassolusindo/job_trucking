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

class EmployeesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/EmployeesList[/{EmployeeID}]", [PermissionMiddleware::class], "list.employees")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EmployeesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/EmployeesAdd[/{EmployeeID}]", [PermissionMiddleware::class], "add.employees")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EmployeesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/EmployeesView[/{EmployeeID}]", [PermissionMiddleware::class], "view.employees")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EmployeesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/EmployeesEdit[/{EmployeeID}]", [PermissionMiddleware::class], "edit.employees")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EmployeesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/EmployeesDelete[/{EmployeeID}]", [PermissionMiddleware::class], "delete.employees")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EmployeesDelete");
    }
}
