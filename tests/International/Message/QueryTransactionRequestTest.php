<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Tests\International\Message;

use Omnipay\OnePay\Message\International\QueryTransactionRequest;
use Omnipay\Tests\TestCase;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QueryTransactionRequestTest extends TestCase
{
    /**
     * @var QueryTransactionRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new QueryTransactionRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setVpcAccessCode(1);
        $this->request->setVpcMerchant(2);
        $this->request->setVpcPassword(3);
        $this->request->setVpcUser(4);
        $this->request->setVpcMerchTxnRef(5);
        $this->request->setVpcHashKey(6);
        $this->request->setVpcVersion(7);
        $this->request->setTestMode(true);
        $data = $this->request->getData();
        $this->assertEquals(8, count($data));
        $this->assertEquals(1, $data['vpc_AccessCode']);
        $this->assertEquals(2, $data['vpc_Merchant']);
        $this->assertEquals(3, $data['vpc_Password']);
        $this->assertEquals(4, $data['vpc_User']);
        $this->assertEquals(5, $data['vpc_MerchTxnRef']);
        $this->assertEquals(7, $data['vpc_Version']);
        $this->assertFalse(isset($data['vpc_HashKey']));
    }
}
