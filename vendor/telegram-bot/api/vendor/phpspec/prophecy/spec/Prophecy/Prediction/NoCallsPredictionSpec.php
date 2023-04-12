<?php

namespace spec\Prophecy\Prediction;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument\ArgumentsWildcard;
use Prophecy\Call\Call;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;

class NoCallsPredictionSpec extends ObjectBehavior
{
    function it_is_prediction()
    {
        $this->shouldHaveType('Prophecy\Prediction\PredictionInterface');
    }

    /**
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     */
    function it_does_nothing_if_there_is_no_calls_made($object, $method)
    {
        $this->check(array(), $object, $method)->shouldReturn(null);
    }

    /**
     * @param ObjectProphecy    $object
     * @param MethodProphecy    $method
     * @param Call                  $call
     * @param ArgumentsWildcard $arguments
     */
    function it_throws_UnexpectedCallsException_if_calls_found($object, $method, $call, $arguments)
    {
        $method->getObjectProphecy()->willReturn($object);
        $method->getMethodName()->willReturn('getName');
        $method->getArgumentsWildcard()->willReturn($arguments);
        $arguments->__toString()->willReturn('123');

        $call->getMethodName()->willReturn('getName');
        $call->getArguments()->willReturn(array(5, 4, 'three'));
        $call->getCallPlace()->willReturn('unknown');

        $this->shouldThrow('Prophecy\Exception\Prediction\UnexpectedCallsException')
            ->duringCheck(array($call), $object, $method);
    }
}
