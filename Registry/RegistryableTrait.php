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
namespace Thuata\ComponentBundle\Registry;

/**
 * <b>RegistryableTrait</b><br>
 * Trait to defined the methods defined in RegistryInterface for factories.
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
trait RegistryableTrait
{
    /**
     * @var array
     */
    private $registry = [];

    /**
     * Loads an object instance from registry
     *
     * @param string $key
     *
     * @return mixed
     */
    protected function loadFromRegistry(string $key)
    {
        return array_key_exists($key, $this->registry) ? $this->registry[$key] : null;
    }

    /**
     * Adds an object instance to registry
     *
     * @param mixed       $data
     * @param string|null $key
     */
    protected function addToRegistry($data, string $key = null)
    {
        is_null($key) and $key = get_class($data);
        $this->registry[$key] = $data;
    }
}
