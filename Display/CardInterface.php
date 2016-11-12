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

namespace Thuata\ComponentBundle\Display;

use Thuata\ComponentBundle\Display\Menu\Menu;

/**
 * interface <b>CardDecoratorInterface</b><br>
 * Cards are an element that contain :<br>
 * <ul><li>an icon or picture</li>
 * <li>A title</li>
 * <li>Some textual content (ie : description)</li>
 * <li>A menu to administrate the decorated element</li>
 * <li>A link to navigate to a more descriptive page for the decorated object</li></ul>
 *
 * @package thuata\componentbundle\Display
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
interface CardInterface
{
    /**
     * Gets the path (relative to web root) to the card picture
     *
     * @return string
     */
    public function getPicture();

    /**
     * Gets the card title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Gets the card HTML content
     *
     * @return string
     */
    public function getContent();

    /**
     * Gets the administration menu
     *
     * @return Menu
     */
    public function getAdministrationMenu();

    /**
     * Returns the link to navigate to when clicking on the card
     *
     * @return string
     */
    public function getLink();
}