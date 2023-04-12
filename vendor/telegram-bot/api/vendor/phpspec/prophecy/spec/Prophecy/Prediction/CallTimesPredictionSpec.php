<?php

namespace spec\Prophecy\Prediction;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument\ArgumentsWildcard;
use Prophecy\Call\Call;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;

class CallTimesPredictionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(2);
    }

    function it_is_prediction()
    {
        $this->shouldHaveType('Prophecy\Prediction\PredictionInterface');
    }

    /**
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     * @param Call               $call1
     * @param Call               $call2
     */
    function it_does_nothing_if_there_were_exact_amount_of_calls_being_made(
        $object, $method, $call1, $call2
    )
    {
        $this->check(array($call1, $call2), $object, $method)->shouldReturn(null);
    }

    /**
     * @param ObjectProphecy    $object
     * @param MethodProphecy    $method
     * @param Call                  $call
     * @param ArgumentsWildcard $arguments
     */
    function it_throws_UnexpectedCallsCountException_if_calls_found(
        $object, $method, $call, $arguments
    )
    {
        $method->getObjectProphecy()->willReturn($object);
        $method->getMethodName()->willReturn('getName');
        $method->getArgumentsWildcard()->willReturn($arguments);
        $arguments->__toString()->willReturn('123');

        $call->getMethodName()->willReturn('getName');
        $call->getArguments()->willReturn(array(5, 4, 'three'));
        $call->getCallPlace()->willReturn('unknown');

        $this->shouldThrow('Prophecy\Exception\Prediction\UnexpectedCallsCountException')
            ->duringCheck(array($call), $object, $method);
    }
}
