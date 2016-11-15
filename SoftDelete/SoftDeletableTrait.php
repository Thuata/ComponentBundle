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

namespace Thuata\ComponentBundle\SoftDelete;

use Thuata\ComponentBundle\Exception\InvalidParameterTypeException;

/**
 * <b>SoftDeletableTrait</b><br>
 * Provides the method definition for the SoftDeleteInterface.
 *
 * @package Thuata\ComponentBundle\SoftDelete
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
trait SoftDeletableTrait
{
    /**
     * @var boolean
     */
    private $deleted;

    /**
     * Gets if instance is deleted
     *
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Sets Instance to deleted or not deleted
     *
     * @param boolean $deleted
     *
     * @return \Thuata\ComponentBundle\SoftDelete\SoftDeleteInterface
     *
     * @throws \Thuata\ComponentBundle\Exception\InvalidParameterTypeException
     */
    public function setDeleted(bool $deleted)
    {
        if(!is_bool($deleted)) {
            throw new InvalidParameterTypeException(get_class($this), __METHOD__, 1, 'boolean', gettype($deleted));
        }

        $this->deleted = $deleted;

        return $this;
    }
}