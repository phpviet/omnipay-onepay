<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Tests\International\Message;

use Omnipay\OnePay\Message\International\PurchaseRequest;
use Omnipay\Tests\TestCase;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new PurchaseRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setVpcLocale(1);
        $this->request->setVpcOrderInfo(2);
        $this->request->setVpcAccessCode(3);
        $this->request->setVpcMerchant(4);
        $this->request->setVpcPassword(5);
        $this->request->setVpcUser(6);
        $this->request->setCurrency(7);
        $this->request->setTitle(8);
        $this->request->setVpcMerchTxnRef(9);
        $this->request->setAgainLink(10);
        $this->request->setVpcReturnURL(11);
        $this->request->setVpcHashKey(12);
        $this->request->setVpcVersion(13);
        $this->request->setVpcAmount(14);
        $this->request->setVpcTicketNo(15);
        $this->request->setTestMode(true);
        $data = $this->request->getData();
        $this->assertEquals(14, count($data));
        $this->assertEquals(1, $data['vpc_Locale']);
        $this->assertEquals(2, $data['vpc_OrderInfo']);
        $this->assertEquals(3, $data['vpc_AccessCode']);
        $this->assertEquals(4, $data['vpc_Merchant']);
        $this->assertEquals(7, $data['vpc_Currency']);
        $this->assertEquals(8, $data['Title']);
        $this->assertEquals(9, $data['vpc_MerchTxnRef']);
        $this->assertEquals(10, $data['AgainLink']);
        $this->assertEquals(11, $data['vpc_ReturnURL']);
        $this->assertEquals(13, $data['vpc_Version']);
        $this->assertEquals(14, $data['vpc_Amount']);
        $this->assertEquals(15, $data['vpc_TicketNo']);
        $this->assertFalse(isset($data['vpc_HashKey']));
        $this->assertFalse(isset($data['vpc_User']));
        $this->assertFalse(isset($data['vpc_Password']));
    }
}
