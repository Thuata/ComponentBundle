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
 * Class Item
 *
 * @package Thuata\ComponentBundle\Display\Menu
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class Item
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var Action
     */
    private $action;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var \ArrayObject
     */
    private $children;

    /**
     * Gets the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     *
     * @return Item
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the item action
     *
     * @return \Thuata\ComponentBundle\Display\Menu\Action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Sets the item action
     *
     * @param \Thuata\ComponentBundle\Display\Menu\Action $action
     *
     * @return Item
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Gets the icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the icon
     *
     * @param string $icon
     *
     * @return Item
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Gets the children list
     *
     * @return \ArrayObject
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Sets the children list
     *
     * @param \ArrayObject $children
     *
     * @return Item
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Checks if is a submenu
     *
     * @return bool
     */
    public function isSubmenu()
    {
        return $this->getChildren()->count() > 0;
    }

    /**
     * Create a new Item instance
     *
     * @return \Thuata\ComponentBundle\Display\Menu\Item
     */
    public static function create()
    {
        return new self();
    }
}