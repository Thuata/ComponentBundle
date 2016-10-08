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

namespace Thuata\ComponentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * <b>ListenerCommand</b><br>
 *
 * @package Thuata\ComponentBundle\Command
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
abstract class ListenerCommand extends ContainerAwareCommand
{
    /**
     * Gets the file path holding the port number
     *
     * @return string
     */
    protected function getFilePath()
    {
        $tmpDir = realpath($this->getContainer()->get('kernel')->getRootDir() . '/../var/tmp/');
        $fileName = '/' . str_replace(':', '--', $this->getRunListeningCommandName()) . '.sock';

        if (!file_exists($tmpDir)) {
            mkdir($tmpDir);
        }

        return $tmpDir . $fileName;
    }

    /**
     * Gets the command name
     *
     * @return string
     */
    abstract public function getCommandName() : string;

    /**
     * Gets the command description
     *
     * @return string
     */
    abstract public function getCommandDescription() : string;

    /**
     * Gets the run listener command name
     *
     * @return string
     */
    abstract protected function getRunListeningCommandName() : string;

    /**
     * Gets the help for the command
     *
     * @return string
     */
    abstract protected function getCommandHelp() : string;
}