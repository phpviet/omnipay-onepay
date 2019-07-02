<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay;

use Omnipay\OnePay\Message\IncomingRequest;
use Omnipay\OnePay\Message\International\PurchaseRequest;
use Omnipay\OnePay\Message\International\QueryTransactionRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class InternationalGateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'OnePay International';
    }

    /**
     *{@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     *{@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|IncomingRequest
     */
    public function completePurchase(array $options = []): IncomingRequest
    {
        return $this->createRequest(IncomingRequest::class, $options);
    }

    /**
     *{@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|IncomingRequest
     */
    public function notification(array $options = []): IncomingRequest
    {
        return $this->createRequest(IncomingRequest::class, $options);
    }

    /**
     *{@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|QueryTransactionRequest
     */
    public function queryTransaction(array $options = []): QueryTransactionRequest
    {
        return $this->createRequest(QueryTransactionRequest::class, $options);
    }
}
