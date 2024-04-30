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

class LokasiController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/lokasilist[/{id}]", [PermissionMiddleware::class], "list.lokasi")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LokasiList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/lokasiadd[/{id}]", [PermissionMiddleware::class], "add.lokasi")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LokasiAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/lokasiview[/{id}]", [PermissionMiddleware::class], "view.lokasi")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LokasiView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/lokasiedit[/{id}]", [PermissionMiddleware::class], "edit.lokasi")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LokasiEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/lokasidelete[/{id}]", [PermissionMiddleware::class], "delete.lokasi")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LokasiDelete");
    }
}
