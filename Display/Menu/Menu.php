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

/**
 * <b>Menu</b><br>
 * A menu to be displayed in a page.<br>
 * A menu is composed of a single item witch is the menu root. This item is never displayed but contains all items that
 * are to be displayed.<br>
 * The name of the menu allows it to be retrieved
 *
 * @package Thuata\ComponentBundle\Display\Menu
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class Menu
{
    /**
     * @var Item
     */
    private $root;

    /**
     * @var string
     */
    private $name;

    /**
     * Menu constructor.
     */
    public function __construct()
    {
    }

    /**
     * Gets the root item
     *
     * @return \Thuata\ComponentBundle\Display\Menu\Item
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Sets the root item
     *
     * @param \Thuata\ComponentBundle\Display\Menu\Item $root
     *
     * @return Menu
     */
    public function setRoot(Item $root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     *
     * @return Menu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}