<?php
/**
 * PaidYET REST Purchase Request
 */

namespace Omnipay\PaidYET\Message;

/**
 * PaidYET REST Purchase Request
 * @link 
 * @see RestAuthorizeRequest
 */
class RestPurchaseRequest extends RestAuthorizeRequest
{
    public function getData()
    {
        $data = array(
            'type' => 'sale',
        );
        return $data;
    }
}
