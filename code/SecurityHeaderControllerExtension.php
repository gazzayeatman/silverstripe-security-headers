<?php

namespace Guttmann\SilverStripe;

use SilverStripe\Core\Extension;
use SilverStripe\Core\Config\Config;

class SecurityHeaderControllerExtension extends Extension
{

    public function onAfterInit()
    {
        $response = $this->owner->getResponse();

        $headersToSend = (array) Config::inst()->get('Guttmann\SilverStripe\SecurityHeaderControllerExtension', 'headers');
        $xHeaderMap = (array) Config::inst()->get('Guttmann\SilverStripe\SecurityHeaderControllerExtension', 'x_headers_map');

        foreach ($headersToSend as $header => $value) {
            $response->addHeader($header, $value);

            if (isset($xHeaderMap[$header])) {
                foreach ($xHeaderMap[$header] as $xHeader) {
                    $response->addHeader($xHeader, $value);
                }
            }
        }
    }
}
