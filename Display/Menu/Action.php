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

namespace Thuata\ComponentBundle\Display\Menu;

use Symfony\Component\HttpFoundation\ParameterBag;
use Thuata\ComponentBundle\Exception\InvalidParameterTypeException;

/**
 * Class Action
 *
 * @package Thuata\ComponentBundle\Display\Menu
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class Action
{
    /**
     * @var ParameterBag
     */
    private $parameters;

    /**
     * Action constructor.
     */
    public function __construct()
    {
        $this->parameters = new ParameterBag();
    }

    /**
     * Adds a parameter
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     *
     * @throws \Thuata\ComponentBundle\Exception\InvalidParameterTypeException
     */
    public function addParameter($name, $value)
    {
        if (!is_string($name)) {
            throw new InvalidParameterTypeException(__CLASS__, __METHOD__, 1, 'string', gettype($name));
        }
        if (!is_scalar($value)) {
            throw new InvalidParameterTypeException(__CLASS__, __METHOD__, 1, 'scalar', gettype($value));
        }

        $this->parameters->set($name, $value);

        return $this;
    }

    /**
     * Gets the parameters
     *
     * @return ParameterBag
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Create a new Item instance
     *
     * @return Action
     */
    public static function create()
    {
        return new self();
    }
}