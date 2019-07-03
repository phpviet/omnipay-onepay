<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Tests\International;

use Omnipay\Omnipay;
use Omnipay\OnePay\Tests\GatewayTestCase;
use Omnipay\OnePay\Message\IncomingResponse;
use Omnipay\OnePay\Message\PurchaseResponse;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class InternationalGatewayTest extends GatewayTestCase
{
    /**
     * @var \Omnipay\OnePay\DomesticGateway
     */
    protected $gateway;

    protected function setUp()
    {
        $this->gateway = Omnipay::create('OnePay_International', $this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setVpcAccessCode('6BEB2546');
        $this->gateway->setVpcUser('op01');
        $this->gateway->setVpcPassword('op123456');
        $this->gateway->setVpcMerchant('TESTONEPAY');
        $this->gateway->setVpcHashKey('A3EFDFABA8653DF2342E8DAC29B51AF0');
        $this->gateway->setTestMode(true);
        parent::setUp();
    }

    public function testPurchaseSuccess()
    {
        $response = $this->gateway->purchase([
            'vpc_MerchTxnRef' => microtime(false),
            'vpc_ReturnURL' => 'https://github.com/phpviet',
            'againLink' => 'https://github.com/phpviet',
            'vpc_TicketNo' => '127.0.0.1',
            'vpc_Amount' => '200000',
            'vpc_OrderInfo' => 456,
            'vpc_Customer_Id' => 1,
            'vpc_Customer_Phone' => '0909113911',
            'vpc_Customer_Email' => 'contact@phpviet.org',
        ])->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertInstanceOf(PurchaseResponse::class, $response);
        $this->assertInstanceOf(RedirectResponseInterface::class, $response);
        $this->assertNotEmpty($response->getRedirectUrl());
    }

    public function testPurchaseFailure()
    {
        $this->expectException(InvalidRequestException::class);
        $this->gateway->purchase([
            'vpc_MerchTxnRef' => microtime(false),
            'vpc_ReturnURL' => 'https://github.com/phpviet',
            'againLink' => 'https://github.com/phpviet',
            'vpc_TicketNo' => '127.0.0.1',
        ])->send();
    }

    /**
     * @testWith    ["completePurchase"]
     *              ["notification"]
     */
    public function testIncomingSuccess(string $requestMethod)
    {
        $this->getHttpRequest()->query->replace([
            'vpc_AdditionData' => 970436,
            'vpc_Amount' => 100,
            'vpc_Command' => 'pay',
            'vpc_CurrencyCode' => 'VND',
            'vpc_Locale' => 'vn',
            'vpc_MerchTxnRef' => '201803210919102006754784',
            'vpc_Merchant' => 'ONEPAY',
            'vpc_OrderInfo' => 'JSECURETEST01',
            'vpc_TransactionNo' => '1625746',
            'vpc_TxnResponseCode' => 0,
            'vpc_Version' => 2,
            'vpc_SecureHash' => '0331F9D8E0CD9A6BC581B74721658DFD9A5A219145F92DED700C13E4843BB3B0',
        ]);

        $response = call_user_func([$this->gateway, $requestMethod])->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('1625746', $response->getTransactionReference());
        $this->assertSame('201803210919102006754784', $response->getTransactionId());
        $this->assertInstanceOf(IncomingResponse::class, $response);
    }

    /**
     * @testWith    ["completePurchase"]
     *              ["notification"]
     */
    public function testIncomingFailure(string $requestMethod)
    {
        $this->expectException(InvalidResponseException::class);
        $this->getHttpRequest()->query->replace([
            'vpc_AdditionData' => 970436,
            'vpc_Amount' => 100,
            'vpc_Command' => 'pay',
            'vpc_CurrencyCode' => 'VND',
            'vpc_Locale' => 'vn',
            'vpc_MerchTxnRef' => '201803210919102006754784',
            'vpc_Merchant' => 'ONEPAY',
            'vpc_OrderInfo' => 'JSECURETEST01',
            'vpc_TransactionNo' => '1625746',
            'vpc_TxnResponseCode' => 0,
            'vpc_Version' => 2,
            'vpc_SecureHash' => '123456',
        ]);
        call_user_func([$this->gateway, $requestMethod])->send();
    }

    public function testQueryTransactionSuccess()
    {
        $this->setMockHttpResponse('QueryTransactionSuccess.txt');
        $response = $this->gateway->queryTransaction([
            'vpc_MerchTxnRef' => '2413',
        ])->send();
        $this->assertSame('2413', $response->getTransactionId());
        $this->assertSame('1431785', $response->getTransactionReference());
        $this->assertTrue($response->isSuccessful());
    }

    public function testQueryTransactionFailure()
    {
        $this->setMockHttpResponse('QueryTransactionFailure.txt');
        $response = $this->gateway->queryTransaction([
            'vpc_MerchTxnRef' => '2413',
        ])->send();
        $this->assertSame('2013042215193440019', $response->getTransactionId());
        $this->assertSame('1432021', $response->getTransactionReference());
        $this->assertFalse($response->isSuccessful());
    }
}
