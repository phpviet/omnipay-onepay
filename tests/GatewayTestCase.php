<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Tests;

use Omnipay\Tests\GatewayTestCase as BaseGatewayTest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class GatewayTestCase extends BaseGatewayTest
{
    public function testDefaultParametersHaveMatchingMethods()
    {
        $settings = $this->gateway->getDefaultParameters();
        foreach ($settings as $key => $default) {
            $key = str_replace('_', '', $key);
            $getter = 'get'.$key;
            $setter = 'set'.$key;
            $value = uniqid();

            $this->assertTrue(method_exists($this->gateway, $getter), "Gateway must implement $getter()");
            $this->assertTrue(method_exists($this->gateway, $setter), "Gateway must implement $setter()");

            // setter must return instance
            $this->assertSame($this->gateway, $this->gateway->$setter($value));
            $this->assertSame($value, $this->gateway->$getter());
        }
    }

    public function testPurchaseParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $key = str_replace('_', '', $key);
            $getter = 'get'.$key;
            $setter = 'set'.$key;
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->purchase();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testCompletePurchaseParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $key = str_replace('_', '', $key);
            $getter = 'get'.$key;
            $setter = 'set'.$key;
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->completePurchase();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testQueryTransactionParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $key = str_replace('_', '', $key);
            $getter = 'get'.$key;
            $setter = 'set'.$key;
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->queryTransaction();
            $this->assertSame($value, $request->$getter());
        }
    }

    public function testNotificationParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            // set property on gateway
            $key = str_replace('_', '', $key);
            $getter = 'get'.$key;
            $setter = 'set'.$key;
            $value = uniqid();
            $this->gateway->$setter($value);

            // request should have matching property, with correct value
            $request = $this->gateway->notification();
            $this->assertSame($value, $request->$getter());
        }
    }
}
