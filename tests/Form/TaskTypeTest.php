<?php

namespace App\Tests\Form;

use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Component\Form\Test\TypeTestCase;

class TaskTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        // TODO
        // Guide : https://symfony.com/doc/current/form/unit_testing.html
        static::assertTrue(true);
        /*
        $formData = [
            'title' => 'Test title',
            'content' => 'Test Content'
        ];

        $objectToCompare = new Task();
        $form = $this->factory->create(TaskType::class, $objectToCompare);
        $object = new Task();
        $form->submit($formData);

        static::assertTrue($form->isSynchronized());
        // check that $objectToCompare was modified as expected when the form was submitted
        static::assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            static::assertArrayHasKey($key, $children);
        }*
        */
    }
}
