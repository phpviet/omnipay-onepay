<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractPurchaseRequest extends AbstractSignatureRequest
{
    use Concerns\PurchaseParameters;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setParameter('version', 2);
        $this->setAgainLink(
            $this->getAgainLink() ?? $this->httpRequest->getUri()
        );
        $this->setVpcTicketNo(
            $this->getVpcTicketNo() ?? $this->httpRequest->getClientIp()
        );

        return $this;
    }
}
