<?php

namespace PdfInvoice\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface IRoute
{
    /**
     * IRoute constructor.
     * @param array $path
     */
    public function __construct(array $path);

    /**
     * @param Request $request
     * @return Response
     */
    public function renderPage(Request $request): Response;
}
