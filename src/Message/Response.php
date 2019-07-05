<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * @method AbstractRequest getRequest()
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Response extends AbstractResponse
{
    use Concerns\ResponseProperties;

    /**
     * {@inheritdoc}
     */
    public function isSuccessful(): bool
    {
        return '0' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function isCancelled(): bool
    {
        return '99' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): ?string
    {
        return $this->data['vpc_Message'] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode(): ?string
    {
        return $this->data['vpc_TxnResponseCode'] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId(): ?string
    {
        return $this->data['vpc_MerchTxnRef'] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['vpc_TransactionNo'] ?? null;
    }
}
