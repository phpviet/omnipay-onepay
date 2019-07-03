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
        $this->setVpcLocale(
            $this->getVpcLocale() ?? 'vn'
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
        unset($data['vpc_User'], $data['vpc_Password']);

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data): PurchaseResponse
    {
        $redirectUrl = $this->getEndpoint().'?'.http_build_query($data);

        return $this->response = new PurchaseResponse($this, $data, $redirectUrl);
    }

    /**
     * Trả giao diện ngôn ngữ khách dùng để thanh toán.
     *
     * @return null|string
     */
    public function getVpcLocale(): ?string
    {
        return $this->getParameter('vpc_Locale');
    }

    /**
     * Thiết lập giao diện ngôn ngữ khách dùng để thanh toán.
     *
     * @param  null|string  $locale
     * @return $this
     */
    public function setVpcLocale(?string $locale)
    {
        return $this->setParameter('vpc_Locale', $locale);
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
     * @param  null|string  $link
     * @return $this
     */
    public function setAgainLink(?string $link)
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
     * @param  null|string  $title
     * @return $this
     */
    public function setTitle(?string $title)
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
     * @param  null|string  $ticketNo
     * @return $this
     * @see setClientIp
     */
    public function setVpcTicketNo(?string $ticketNo)
    {
        return $this->setClientIp($ticketNo);
    }

    /**
     * {@inheritdoc}
     */
    public function getClientIp(): ?string
    {
        return $this->getParameter('vpc_TicketNo');
    }

    /**
     * {@inheritdoc}
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
     * @param  null|string  $amount
     * @return $this
     * @see setAmount
     */
    public function setVpcAmount(?string $amount)
    {
        return $this->setAmount($amount);
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount(): ?string
    {
        return $this->getParameter('vpc_Amount');
    }

    /**
     * {@inheritdoc}
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
     * @param  null|string  $info
     * @return $this
     */
    public function setVpcOrderInfo(?string $info)
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
     * @param  null|string  $ref
     * @return $this
     */
    public function setVpcMerchTxnRef(?string $ref)
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
     * @param  null|string  $currency
     * @return $this
     */
    public function setVpcCurrency(?string $currency)
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
     * Trả về số điện thoại khách hàng.
     *
     * @return null|string
     */
    public function getVpcCustomerPhone(): ?string
    {
        return $this->getParameter('vpc_Customer_Phone');
    }

    /**
     * Thiết lập số điện thoại khách hàng.
     *
     * @param  null|string  $phone
     * @return $this
     */
    public function setVpcCustomerPhone(?string $phone)
    {
        return $this->setParameter('vpc_Customer_Phone', $phone);
    }

    /**
     * Trả về id khách hàng.
     *
     * @return null|string
     */
    public function getVpcCustomerId(): ?string
    {
        return $this->getParameter('vpc_Customer_Id');
    }

    /**
     * Thiết lập id khách hàng.
     *
     * @param  null|string  $id
     * @return $this
     */
    public function setVpcCustomerId(?string $id)
    {
        return $this->setParameter('vpc_Customer_Id', $id);
    }

    /**
     * Phương thức ánh xạ của [[getReturnUrl()]].
     * Trả về đường dẫn tại hệ thống của bạn sẽ redirect khách về sau khi thanh toán.
     *
     * @return null|string
     * @see getReturnUrl
     */
    public function getVpcReturnURL(): ?string
    {
        return $this->getReturnUrl();
    }

    /**
     * Phương thức ánh xạ của [[setReturnUrl()]].
     *
     * @param  null|string  $url
     * @return $this
     * @see setReturnUrl
     */
    public function setVpcReturnURL(?string $url)
    {
        return $this->setReturnUrl($url);
    }

    /**
     * {@inheritdoc}
     */
    public function getReturnUrl(): ?string
    {
        return $this->getParameter('vpc_ReturnURL');
    }

    /**
     * {@inheritdoc}
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('vpc_ReturnURL', $value);
    }

    /**
     * Trả về email khách hàng.
     *
     * @return null|string
     */
    public function getVpcCustomerEmail(): ?string
    {
        return $this->getParameter('vpc_Customer_Email');
    }

    /**
     * Thiết lập email khách hàng.
     *
     * @param  null|string  $email
     * @return $this
     */
    public function setVpcCustomerEmail(?string $email)
    {
        return $this->setParameter('vpc_Customer_Email', $email);
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        $parameters = [
            'vpc_Version', 'vpc_Currency', 'vpc_Command', 'vpc_AccessCode', 'vpc_Merchant', 'vpc_Locale',
            'vpc_ReturnURL', 'vpc_MerchTxnRef', 'vpc_OrderInfo', 'vpc_Amount', 'vpc_TicketNo',
        ];

        if ($this->getVpcCustomerId()) {
            $parameters[] = 'vpc_Customer_Id';
        }

        if ($this->getVpcCustomerEmail()) {
            $parameters[] = 'vpc_Customer_Email';
        }

        if ($this->getVpcCustomerPhone()) {
            $parameters[] = 'vpc_Customer_Phone';
        }

        return $parameters;
    }
}
