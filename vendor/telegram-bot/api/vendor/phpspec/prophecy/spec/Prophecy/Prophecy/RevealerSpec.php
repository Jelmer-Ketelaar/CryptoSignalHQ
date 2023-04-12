<?php

namespace spec\Prophecy\Prophecy;

use PhpSpec\ObjectBehavior;
use Prophecy\Prophecy\ProphecyInterface;
use stdClass;

class RevealerSpec extends ObjectBehavior
{
    function it_is_revealer()
    {
        $this->shouldBeAnInstanceOf('Prophecy\Prophecy\RevealerInterface');
    }

    /**
     * @param ProphecyInterface $prophecy
     * @param stdClass                            $object
     */
    function it_reveals_single_instance_of_ProphecyInterface($prophecy, $object)
    {
        $prophecy->reveal()->willReturn($object);

        $this->reveal($prophecy)->shouldReturn($object);
    }

    /**
     * @param ProphecyInterface $prophecy1
     * @param ProphecyInterface $prophecy2
     * @param stdClass                            $object1
     * @param stdClass                            $object2
     */
    function it_reveals_instances_of_ProphecyInterface_inside_array(
        $prophecy1, $prophecy2, $object1, $object2
    )
    {
        $prophecy1->reveal()->willReturn($object1);
        $prophecy2->reveal()->willReturn($object2);

        $this->reveal(array(
            array('item' => $prophecy2),
            $prophecy1
        ))->shouldReturn(array(
            array('item' => $object2),
            $object1
        ));
    }

    function it_does_not_touch_non_prophecy_interface()
    {
        $this->reveal(42)->shouldReturn(42);
    }
}
