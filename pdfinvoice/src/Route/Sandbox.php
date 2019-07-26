<?php

namespace PdfInvoice\Route;

use PdfInvoice\Document;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class Sandbox implements IRoute
{
    /**
     * @var array
     */
    private $path;

    /**
     * Sandbox constructor.
     * @param array $path
     */
    public function __construct(array $path)
    {
        $this->path = $path;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Mpdf\MpdfException
     */
    public function renderPage(Request $request): Response
    {
        $document = new Document('sandbox.php', $request->request);
        $pdf = $document->getDocument('sandbox');
        $response = new BinaryFileResponse($pdf);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            'invoice.pdf'
        );
        return $response;
    }
}
