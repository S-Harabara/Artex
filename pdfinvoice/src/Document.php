<?php

namespace PdfInvoice;

use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Symfony\Component\HttpFoundation\ParameterBag;

class Document
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ParameterBag
     */
    private $data;

    /**
     * Document constructor.
     * @param string $name
     * @param ParameterBag $data
     */
    public function __construct(string $name, ParameterBag $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * @param string $prefix
     * @return string
     * @throws \Mpdf\MpdfException
     */
    public function getDocument(string $prefix)
    {
        $config = [];
//        $config = $this->getConfig();

        $mpdf = new Mpdf($config);
        $mpdf->WriteHTML(self::view($this->name, ['postdata' => $this->data->all(), 'salesQuoteNumber' => crc32($prefix)]));
        $filename = dirname(__DIR__) . '/storage/invoice-' . $prefix . '.pdf';
        $mpdf->Output($filename, Destination::FILE);
        return $filename;
    }

    /**
     * @return array
     */
    private function getConfig()
    {
        $config = [];
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $config['fontDir'] = array_merge($fontDirs, [
            dirname(__DIR__) . '/assets/font/directory',
        ]);

        $config['fontdata'] = $fontData + [
                'frutiger' => [
                    'R' => 'Frutiger-Normal.ttf',
                    'I' => 'FrutigerObl-Normal.ttf',
                ]
            ];

        $config['frutiger'] = 'sans';
        $config['default_font_size'] = 10;
        return $config;
    }
    /**
     * @param string $name
     * @param array $data
     * @return string|null
     */
    public static function view(string $name, array $data = []): ?string
    {
        $filename = dirname(__DIR__) . '/views/' . $name;
        if (is_file($filename)) {
            ob_start();
            extract($data, EXTR_OVERWRITE);
            include $filename;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
        return null;
    }
}
