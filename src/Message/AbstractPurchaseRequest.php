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
        $this->setAgainLink(
            $this->getAgainLink() ?? $this->httpRequest->getUri()
        );
        $this->setVpcTicketNo(
            $this->getVpcTicketNo() ?? $this->httpRequest->getClientIp()
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('AgainLink', 'Title');

        return parent::getData();
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        $baseParameters = array_fill_keys([
            'vpc_Version', 'vpc_Currency', 'vpc_Command', 'vpc_AccessCode', 'vpc_Merchant', 'vpc_Locale',
            'vpc_ReturnURL', 'vpc_MerchTxnRef', 'vpc_OrderInfo', 'vpc_Amount', 'vpc_TicketNo',
        ], true);
        $parameters = array_merge($baseParameters, $this->getParameters());
        $parameters = array_filter(array_keys($parameters), function ($parameter) {
            return 0 === strpos($parameter, 'vpc_');
        });

        return $parameters;
    }
}
