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

class Size22Controller extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/size22list[/{SizeID}]", [PermissionMiddleware::class], "list.size22")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size22List");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/size22add[/{SizeID}]", [PermissionMiddleware::class], "add.size22")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size22Add");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/size22view[/{SizeID}]", [PermissionMiddleware::class], "view.size22")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size22View");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/size22edit[/{SizeID}]", [PermissionMiddleware::class], "edit.size22")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size22Edit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/size22delete[/{SizeID}]", [PermissionMiddleware::class], "delete.size22")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size22Delete");
    }
}
