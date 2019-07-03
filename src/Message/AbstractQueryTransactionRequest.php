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
class AbstractQueryTransactionRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setParameter('vpc_Command', 'queryDR');

        return $this;
    }

    /**
     * Trả về mã đơn hàng cần truy vấn giao dịch.
     *
     * @return null|string
     */
    public function getVpcMerchTxnRef(): ?string
    {
        return $this->getParameter('vpc_MerchTxnRef');
    }

    /**
     * Thiết lập mã đơn hàng cần truy vấn giao dịch tại hệ thống của bạn.
     *
     * @param  null|string  $ref
     * @return $this
     */
    public function setVpcMerchTxnRef(?string $ref)
    {
        return $this->setParameter('vpc_MerchTxnRef', $ref);
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data): QueryTransactionResponse
    {
        $url = $this->getEndpoint().'?'.http_build_query($data);
        $response = $this->httpClient->request('GET', $url);
        $raw = $response->getBody()->getContents();
        parse_str($raw, $responseData);

        return $this->response = new QueryTransactionResponse($this, $responseData);
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'vpc_Command', 'vpc_Version', 'vpc_MerchTxnRef', 'vpc_Merchant', 'vpc_AccessCode', 'vpc_User',
            'vpc_Password',
        ];
    }
}
