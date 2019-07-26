<?php

namespace PdfInvoice\Route;

use PdfInvoice\Document;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class Worker implements IRoute
{
    const EMAIL_FROM = 'dealerportal@artexmfg.com';

    const EMAIL_ADMIN = 'sguetter@artexmfg.com';

    /**
     * @var array
     */
    private $path;

    /**
     * IRoute constructor.
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
        $document = new Document('worker.php', $request->request);
        $pdf = $document->getDocument(date('dmYHis'));
        $response = new BinaryFileResponse($pdf);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'invoice.pdf'
        );

        $email = $request->request->get('email');
        $email2 = $request->request->get('email2');

        if($email){
            $this->sendMail($email, $pdf, $request->request->all());
        }

        if($email2){
            $this->sendMail($email2, $pdf, $request->request->all());
        }

        return $response;
    }

    /**
     * @param string $email
     * @param string $filename
     * @param array $data
     */
    private function sendMail(string $email, string $filename, array $data = [])
    {

        $message = (new \Swift_Message())
            ->setFrom(self::EMAIL_FROM)
            ->setTo([$email, self::EMAIL_ADMIN])
            ->setSubject('Invoice')
            ->setBody(
                Document::view('email.php', $data),
                'text/html'
            )
            ->attach(\Swift_Attachment::fromPath($filename, 'application/pdf')->setFilename('invoice.pdf'));
        $mailer = new \Swift_Mailer(new \Swift_SendmailTransport());
        $mailer->send($message);
    }
}
