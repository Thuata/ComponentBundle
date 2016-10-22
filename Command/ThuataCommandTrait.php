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

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thuata\ComponentBundle\Display\ThuataASCII;

/**
 * <b>ThuataCommandTrait</b><br>
 * Provides some methods for thuata commands
 *
 * @package thuata\componentbundle\Command
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
trait ThuataCommandTrait
{
    /**
     * Writes the Thuata ASCII logo
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function writeThuataASCIILogo(OutputInterface $output)
    {
        $output->writeln(ThuataASCII::getInstance()->getArrayASCII());
    }

    /**
     * Writes a good bye
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function writeGoodBy(OutputInterface $output)
    {
        $output->writeln('Done');
        $output->writeln('Goodbye :)');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->writeThuataASCIILogo($output);

        $res = $this->doExecute($input, $output);

        $this->writeGoodBy($output);

        return $res;
    }

    /**
     * Method to overload to execute the command
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return mixed
     */
    abstract protected function doExecute(InputInterface $input, OutputInterface $output): int;
}