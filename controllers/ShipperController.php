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

class ShipperController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/shipperlist[/{ShipperID}]", [PermissionMiddleware::class], "list.shipper")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ShipperList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/shipperadd[/{ShipperID}]", [PermissionMiddleware::class], "add.shipper")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ShipperAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/shipperview[/{ShipperID}]", [PermissionMiddleware::class], "view.shipper")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ShipperView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/shipperedit[/{ShipperID}]", [PermissionMiddleware::class], "edit.shipper")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ShipperEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/shipperdelete[/{ShipperID}]", [PermissionMiddleware::class], "delete.shipper")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ShipperDelete");
    }
}
