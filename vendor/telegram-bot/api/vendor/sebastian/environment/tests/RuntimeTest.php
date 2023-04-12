<?php
/*
 * This file is part of the Environment package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\Environment;

use PHPUnit_Framework_TestCase;

class RuntimeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Runtime
     */
    private $env;

    protected function setUp()
    {
        $this->env = new Runtime;
    }

    /**
     * @covers Runtime::canCollectCodeCoverage
     * @uses   Runtime::hasXdebug
     * @uses   Runtime::isHHVM
     * @uses   Runtime::isPHP
     */
    public function testAbilityToCollectCodeCoverageCanBeAssessed()
    {
        $this->assertInternalType('boolean', $this->env->canCollectCodeCoverage());
    }

    /**
     * @covers Runtime::getBinary
     * @uses   Runtime::isHHVM
     */
    public function testBinaryCanBeRetrieved()
    {
        $this->assertInternalType('string', $this->env->getBinary());
    }

    /**
     * @covers Runtime::isHHVM
     */
    public function testCanBeDetected()
    {
        $this->assertInternalType('boolean', $this->env->isHHVM());
    }

    /**
     * @covers Runtime::isPHP
     * @uses   Runtime::isHHVM
     */
    public function testCanBeDetected2()
    {
        $this->assertInternalType('boolean', $this->env->isPHP());
    }

    /**
     * @covers Runtime::hasXdebug
     * @uses   Runtime::isHHVM
     * @uses   Runtime::isPHP
     */
    public function testXdebugCanBeDetected()
    {
        $this->assertInternalType('boolean', $this->env->hasXdebug());
    }

    /**
     * @covers Runtime::getNameWithVersion
     * @uses   Runtime::getName
     * @uses   Runtime::getVersion
     * @uses   Runtime::isHHVM
     * @uses   Runtime::isPHP
     */
    public function testNameAndVersionCanBeRetrieved()
    {
        $this->assertInternalType('string', $this->env->getNameWithVersion());
    }

    /**
     * @covers Runtime::getName
     * @uses   Runtime::isHHVM
     */
    public function testNameCanBeRetrieved()
    {
        $this->assertInternalType('string', $this->env->getName());
    }

    /**
     * @covers Runtime::getVersion
     * @uses   Runtime::isHHVM
     */
    public function testVersionCanBeRetrieved()
    {
        $this->assertInternalType('string', $this->env->getVersion());
    }

    /**
     * @covers Runtime::getVendorUrl
     * @uses   Runtime::isHHVM
     */
    public function testVendorUrlCanBeRetrieved()
    {
        $this->assertInternalType('string', $this->env->getVendorUrl());
    }
}
