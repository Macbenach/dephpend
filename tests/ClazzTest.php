<?php

declare (strict_types = 1);

namespace Mihaeu\PhpDependencies;

/**
 * @covers Mihaeu\PhpDependencies\Clazz
 */
class ClazzTest extends \PHPUnit_Framework_TestCase
{
    public function testHasValue()
    {
        $this->assertEquals('Name', new Clazz('Name'));
        $this->assertEquals('Name', (new Clazz('Name'))->toString());
    }

    public function testEquals()
    {
        $this->assertTrue((new Clazz('A'))->equals(new Clazz('A')));
    }

    public function testDetectsIfClassHasNamespace()
    {
        $this->assertTrue((new Clazz('Class', new ClazzNamespace(['A'])))->hasNamespace());
    }

    public function testDetectsIfClassHasNoNamespace()
    {
        $this->assertFalse((new Clazz('Class'))->hasNamespace());
    }

    public function testDepthWithoutNamespaceIsOne()
    {
        $this->assertEquals(1, (new Clazz('A'))->depth());
    }

    public function testDepthWithNamespace()
    {
        $this->assertEquals(3, (new Clazz('A', new ClazzNamespace(['B', 'C'])))->depth());
    }

    public function testReduceDepth()
    {
        $this->assertEquals(
            new ClazzNamespace(['B', 'C']),
            (new Clazz('A', new ClazzNamespace(['B', 'C', 'D'])))->reduceToDepth(2)
        );
    }

    public function testReduceToDepthOfOne()
    {
        $this->assertEquals(
            new ClazzNamespace(['B']),
            (new Clazz('A', new ClazzNamespace(['B', 'C', 'D'])))->reduceToDepth(1)
        );
    }
}
