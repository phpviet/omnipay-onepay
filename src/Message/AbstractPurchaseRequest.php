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
    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        $this->setParameter('vpc_Command', 'pay');
        $this->setAgainLink(
            $this->getAgainLink() ?? $this->httpRequest->getUri()
        );
        $this->setVpcTicketNo(
            $this->getVpcTicketNo() ?? $this->httpRequest->getClientIp()
        );
        $this->setTitle(
            $this->getTitle() ?? ''
        );
        $this->setCurrency(
            $this->getCurrency() ?? 'VND'
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
        $data = parent::getData();
        $data['redirect_url'] = $this->getEndpoint().'?'.http_build_query($data);

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data): PurchaseResponse
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    /**
     * Trả về đường dẫn thanh toán tại hệ thống của bạn mà khách đã dùng để thanh toán.
     * Nếu không thiết lập hệ thống sẽ tự động lấy đường dẫn của khách truy vấn hệ thống hiện tại, đối với CLI mode sẽ là empty.
     *
     * @return null|string
     */
    public function getAgainLink(): ?string
    {
        return $this->getParameter('AgainLink');
    }

    /**
     * Thiết lập đường dẫn thanh toán tại hệ thống của bạn mà khách đã dùng để thanh toán.
     *
     * @param  string  $link
     * @return $this
     */
    public function setAgainLink(string $link)
    {
        return $this->setParameter('AgainLink', $link);
    }

    /**
     * Trả về tiêu đề hiển thị tại OnePay khi thanh toán.
     *
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->getParameter('Title');
    }

    /**
     * Thiết lập tiêu đề hiển thị tại OnePay khi thanh toán.
     *
     * @param  string  $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        return $this->setParameter('Title', $title);
    }

    /**
     * Phương thức ánh xạ của [[getClientIp()]].
     *
     * @return null|string
     * @see getClientIp
     */
    public function getVpcTicketNo(): ?string
    {
        return $this->getClientIp();
    }

    /**
     * Phương thức ánh xạ của [[setClientIp()]].
     *
     * @param  string  $ticketNo
     * @return $this
     * @see setClientIp
     */
    public function setVpcTicketNo(string $ticketNo)
    {
        return $this->setClientIp($ticketNo);
    }

    /**
     * Trả về IP của khách dùng để thanh toán. Nếu không thiết lập sẽ lấy theo IP client đang truy cập hệ thống, đối với CLI mode thì sẽ là empty.
     *
     * @return null|string
     */
    public function getClientIp(): ?string
    {
        return $this->getParameter('vpc_TicketNo');
    }

    /**
     * Thiết lập IP của khách dùng để thanh toán.
     *
     * @param  string  $value
     * @return $this
     */
    public function setClientIp($value)
    {
        return $this->setParameter('vpc_TicketNo', $value);
    }

    /**
     * Phương thức ánh xạ của [[getAmount()]].
     *
     * @return null|string
     * @see getAmount
     */
    public function getVpcAmount(): ?string
    {
        return $this->getAmount();
    }

    /**
     * Phương thức ánh xạ của [[setAmount()]].
     *
     * @param  string  $amount
     * @return $this
     * @see setAmount
     */
    public function setVpcAmount(string $amount)
    {
        return $this->setAmount($amount);
    }

    /**
     * Trả về số tiền của đơn hàng.
     *
     * @return null|string
     */
    public function getAmount(): ?string
    {
        return $this->getParameter('vpc_Amount');
    }

    /**
     * Thiết lập số tiền đơn hàng cần thanh toán.
     *
     * @param  string  $value
     * @return $this
     */
    public function setAmount($value)
    {
        return $this->setParameter('vpc_Amount', $value);
    }

    /**
     * Trả về thông tin đơn hàng.
     *
     * @return null|string
     */
    public function getVpcOrderInfo(): ?string
    {
        return $this->getParameter('vpc_OrderInfo');
    }

    /**
     * Thiết lập thông tin đơn hàng.
     *
     * @param  string  $info
     * @return $this
     */
    public function setVpcOrderInfo(string $info)
    {
        return $this->setParameter('vpc_OrderInfo', $info);
    }

    /**
     * Trả về mã đơn hàng cần thanh toán.
     *
     * @return null|string
     */
    public function getVpcMerchTxnRef(): ?string
    {
        return $this->getParameter('vpc_MerchTxnRef');
    }

    /**
     * Thiết lập mã đơn hàng cần thanh toán tại hệ thống của bạn.
     *
     * @param  string  $info
     * @return $this
     */
    public function setVpcMerchTxnRef(string $ref)
    {
        return $this->setParameter('vpc_MerchTxnRef', $ref);
    }

    /**
     * Trả về đơn vị tiền tệ sử dụng thanh toán của khách.
     *
     * @return null|string
     */
    public function getVpcCurrency(): ?string
    {
        return $this->getCurrency();
    }

    /**
     * Thiết lập đơn vị tiền tệ sử dụng thanh toán của khách.
     *
     * @param  string  $currency
     * @return $this
     */
    public function setVpcCurrency(string $currency)
    {
        return $this->setCurrency($currency);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrency(): ?string
    {
        return ($currency = $this->getParameter('vpc_Currency')) ? strtoupper($currency) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrency($value)
    {
        return $this->setParameter('vpc_Currency', $value);
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
