<?php
/**
 * PaidYET REST Capture Request
 */

namespace Omnipay\PaidYET\Message;

/**
 * PaidYET REST Capture Request
 *
 *
 * @see RestAuthorizeRequest
 * @link 
 */
class RestCaptureRequest extends AbstractRestRequest
{
    public function getData()
    {
        $data = parent::getData();
        $data['amount'] = $this->getAmount();
        return $data;
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/transaction' . '/' . $this->getTransactionId();
    }
}
