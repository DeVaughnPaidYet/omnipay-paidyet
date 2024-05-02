<?php
/**
 * PaidYET REST Purchase Request
 */

namespace Omnipay\PaidYET\Message;

/**
 * PaidYET REST Purchase Request
 *
 *
 * <code>
 *   // Create a credit card object
 *   // DO NOT USE THESE CARD VALUES -- substitute your own
 *   // see the documentation in the class header.
 *   $card = new CreditCard(array(
 *               'firstName' => 'Example',
 *               'lastName' => 'User',
 *               'number' => '4111111111111111',
 *               'expiryMonth'           => '01',
 *               'expiryYear'            => '2020',
 *               'cvv'                   => '123',
 *               'billingAddress1'       => '1 Scrubby Creek Road',
 *               'billingCountry'        => 'AU',
 *               'billingCity'           => 'Scrubby Creek',
 *               'billingPostcode'       => '4999',
 *               'billingState'          => 'QLD',
 *   ));
 *
 *   // Do a purchase transaction on the gateway
 *   try {
 *       $transaction = $gateway->purchase(array(
 *           'amount'        => '10.00',
 *           'currency'      => 'AUD',
 *           'description'   => 'This is a test purchase transaction.',
 *           'card'          => $card,
 *       ));
 *       $response = $transaction->send();
 *       $data = $response->getData();
 *       echo "Gateway purchase response data == " . print_r($data, true) . "\n";
 *
 *       if ($response->isSuccessful()) {
 *           echo "Purchase transaction was successful!\n";
 *       }
 *   } catch (\Exception $e) {
 *       echo "Exception caught while attempting authorize.\n";
 *       echo "Exception type == " . get_class($e) . "\n";
 *       echo "Message == " . $e->getMessage() . "\n";
 *   }
 * </code>
 *
 * Direct credit card payment and related features are restricted in
 * some countries.
 * As of January 2015 these transactions are only supported in the UK
 * and in the USA.
 *
 * <code>
 *   $transaction = MyClass::saveTransaction($some_data);
 *   $txn_id = $transaction->getId();
 * </code>
 *
 * Step 2 is to send the purchase request.
 *
 * <code>
 *   // Do a purchase transaction on the gateway
 *   try {
 *       $transaction = $gateway->purchase(array(
 *           'amount'        => '10.00',
 *           'currency'      => 'AUD',
 *           'description'   => 'This is a test purchase transaction.',
 *           'returnUrl'     => 'http://mysite.com/paypal/return/?txn_id=' . $txn_id,
 *           'cancelUrl'     => 'http://mysite.com/paypal/return/?txn_id=' . $txn_id,
 *       ));
 *       $response = $transaction->send();
 *       $data = $response->getData();
 *       echo "Gateway purchase response data == " . print_r($data, true) . "\n";
 *
 *       if ($response->isSuccessful()) {
 *           echo "Step 2 was successful!\n";
 *       }
 *
 *   } catch (\Exception $e) {
 *       echo "Exception caught while attempting purchase.\n";
 *       echo "Exception type == " . get_class($e) . "\n";
 *       echo "Message == " . $e->getMessage() . "\n";
 *   }
 * </code>
 *
 * Step 3 is where your code needs to redirect the customer to the PayPal
 * gateway so that the customer can sign in to their PayPal account and
 * agree to authorize the payment.  The response will implement an interface
 * called RedirectResponseInterface from which the redirect URL can be obtained.
 *
 * How you do this redirect is up to your platform, code or framework at
 * this point.  For the below example I will assume that there is a
 * function called redirectTo() which can handle it for you.
 *
 * <code>
 *   if ($response->isRedirect()) {
 *       // Redirect the customer to PayPal so that they can sign in and
 *       // authorize the payment.
 *       echo "The transaction is a redirect";
 *       redirectTo($response->getRedirectUrl());
 *   }
 * </code>
 *
 * Step 4 is where the customer returns to your site.  This will happen on
 * either the returnUrl or the cancelUrl, that you provided in the purchase()
 * call.
 *
 * If the cancelUrl is called then you can assume that the customer has not
 * authorized the payment, therefore you can cancel the transaction.
 *
 * If the returnUrl is called, then you need to complete the transaction via
 * a further call to PayPal.
 *
 * Note this example assumes that the purchase has been successful.
 *
 * The payer ID and the payment ID returned from the callback after the purchase
 * will be passed to the return URL as GET parameters payerId and paymentId
 * respectively.
 *
 * <code>
 *   $paymentId = $_GET['paymentId'];
 *   $payerId = $_GET['payerId'];
 *
 *   // Once the transaction has been approved, we need to complete it.
 *   $transaction = $gateway->completePurchase(array(
 *       'payer_id'             => $payer_id,
 *       'transactionReference' => $sale_id,
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       // The customer has successfully paid.
 *       echo "Step 4 was successful!\n";
 *   } else {
 *       // There was an error returned by completePurchase().  You should
 *       // check the error code and message from PayPal, which may be something
 *       // like "card declined", etc.
 *   }
 * </code>
 * @link 
 * @see RestAuthorizeRequest
 */
class RestPurchaseRequest extends RestAuthorizeRequest
{
    public function getData()
    {
        $data = parent::getData();
        $data['intent'] = 'sale';
        return $data;
    }
}
