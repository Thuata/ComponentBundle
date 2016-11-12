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

use Symfony\Component\Config\FileLocator;
use Thuata\ComponentBundle\Singleton\SingletonableTrait;
use Thuata\ComponentBundle\Singleton\SingletonInterface;

/**
 * <b>ThuataASCII</b><br/>
 *
 * @package Thuata\ComponentBundle\Display
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 *
 * @static ThuataASCII getInstance()
 */
class ThuataASCII implements SingletonInterface
{
    use SingletonableTrait;

    /**
     * @var string
     */
    private $textASCII;

    /**
     * @var array
     */
    private $arrayASCII;

    protected function __construct()
    {
        $path = realpath(__DIR__ . '/../Resources/thuataASCII.txt');

        $this->textASCII = file_get_contents($path);
        $this->arrayASCII = explode(PHP_EOL, $this->textASCII);
    }

    /**
     * Gets TextASCII
     *
     * @return string
     */
    public function getTextASCII(): string
    {
        return $this->textASCII;
    }

    /**
     * Gets ArrayASCII
     *
     * @return array
     */
    public function getArrayASCII(): array
    {
        return $this->arrayASCII;
    }
}
