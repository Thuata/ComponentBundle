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
 * <b>RegistryInterface</b><br>
 *
 *
 * @package thuata\componentbundle\Registry
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
interface RegistryInterface
{
    /**
     * Finds an item by key
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function findByKey($key);

    /**
     * Finds a list of items by keys
     *
     * @param array $keys
     *
     * @return array
     */
    public function findByKeys(array $keys);

    /**
     * adds an item to the registry
     *
     *
     * @param mixed $key
     * @param mixed $data
     *
     * @return void
     */
    public function add($key, $data);

    /**
     * Removes an item
     *
     * @param mixed $key
     *
     * @return void
     */
    public function remove($key);

    /**
     *
     *
     * @param mixed $key
     * @param mixed $data
     *
     * @return void
     */
    public function update($key, $data);
}