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
        

        return array(
            'amount' => array(
                'total' => $this->getAmount(),
            ),
            'is_final_capture' => true,
        );
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/transaction' . '/' . $this->getTransactionId();
    }
}
