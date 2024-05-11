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

class DepoController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/depolist[/{DepoID}]", [PermissionMiddleware::class], "list.depo")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepoList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/depoadd[/{DepoID}]", [PermissionMiddleware::class], "add.depo")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepoAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/depoview[/{DepoID}]", [PermissionMiddleware::class], "view.depo")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepoView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/depoedit[/{DepoID}]", [PermissionMiddleware::class], "edit.depo")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepoEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/depodelete[/{DepoID}]", [PermissionMiddleware::class], "delete.depo")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepoDelete");
    }
}
