<?php
/**
 * Also test multiple namespaces/classes per single file.
 */
namespace SimpleA {

    use Codeception\TestCase\Test;

    class SimpleTest extends Test
    {

        public function testFoo() {
            return true;
        }

        public function testBar() {
            return true;
        }

    }
}

namespace SimpleB {

    use Codeception\TestCase\Test;

    class SimpleTest extends Test
    {
        public function testBaz() {
            return true;
        }

    }
}

