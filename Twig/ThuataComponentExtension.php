<?php
/*
 * The MIT License
 *
 * Copyright 2015 Anthony Maudry <anthony.maudry@thuata.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Thuata\ComponentBundle\Twig;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Thuata\ComponentBundle\Display\CardDecoratedInterface;
use Thuata\ComponentBundle\Exception\InvalidCardDecoratorPropertyException;
use Thuata\ComponentBundle\Exception\InvalidParameterTypeException;

/**
 * <b>ThuataComponentExtension</b><br>
 * Provides twig extensions for the view components defined in the bundle
 *
 * @package Thuata\ComponentBundle\Twig
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class ThuataComponentExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('card_display', [$this, 'cardDisplayFilter'], ['is_sage' => ['html']])
        ];
    }

    /**
     * Filter to get card decorated property
     *
     * @param CardDecoratedInterface $object
     * @param string                 $property
     *
     * @return string
     *
     * @throws \Thuata\ComponentBundle\Exception\InvalidCardDecoratorPropertyException
     * @throws \Thuata\ComponentBundle\Exception\InvalidParameterTypeException
     */
    public function cardDisplayFilter(CardDecoratedInterface $object, string $property)
    {
        $decorator = $object->getCardDecorator();

        $accessor = PropertyAccess::createPropertyAccessor();

        if (!$accessor->isReadable($decorator, $property)) {
            throw new InvalidCardDecoratorPropertyException($decorator, $property);
        }

        return $accessor->getValue($decorator, $property);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'thuata.extenion.component';
    }
}