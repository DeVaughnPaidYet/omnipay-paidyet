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
        $this->validate('transactionId');
        $amount = $this->getAmount();

        return $amount;
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/transaction' . '/' . $this->getTransactionId();
    }
}
