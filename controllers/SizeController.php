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

class SizeController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/sizelist[/{SizeID}]", [PermissionMiddleware::class], "list.size")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/sizeadd[/{SizeID}]", [PermissionMiddleware::class], "add.size")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/sizeview[/{SizeID}]", [PermissionMiddleware::class], "view.size")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/sizeedit[/{SizeID}]", [PermissionMiddleware::class], "edit.size")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/sizedelete[/{SizeID}]", [PermissionMiddleware::class], "delete.size")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeDelete");
    }
}
