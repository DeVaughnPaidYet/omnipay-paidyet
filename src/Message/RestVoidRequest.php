<?php
/**
 * PaidYET REST Void an authorization
 */

namespace Omnipay\PaidYET\Message;

/**
 * PaidYET REST Void an authorization
 *
 * Use this call to void a previously authorized payment.
 * Note: A fully captured authorization cannot be voided.
 *
 * @link https://paidyet.readme.io/reference/patch_transaction-id
 * @see RestAuthorizeRequest
 */
class RestVoidRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionId');
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/transaction' . '/' . $this->getTransactionId();
    }
}
