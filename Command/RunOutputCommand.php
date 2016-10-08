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

use Symfony\Component\Console\Output\OutputInterface;

/**
 * <b>OutputCommand</b><br>
 *
 *
 * @package Thuata\ComponentBundle\Command
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class RunOutputCommand extends RunListenerCommand
{
    const COMMAND_NAME = 'thuata:output:run';
    const COMMAND_DESCRIPTION = 'Opens an output socket. Messages sent to that socket will be written in the bash console.';
    const FORMAT_RECEIVED_MESSAGE = '<fg=green>Received</> message from <fg=cyan>%s</><fg=yellow>:</><fg=cyan>%d</> :';
    const FORMAT_MESSAGE = '<fg=white;bg=blue>%s</>';
    const CMD_STOP = 'T_CMD_STOP';

    /**
     * Gets the command name
     *
     * @return string
     */
    public function getCommandName() : string
    {
        return self::COMMAND_NAME;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();
    }

    /**
     * Treats message
     *
     * @param mixed                                             $message
     * @param string                                            $remoteAddress
     * @param string                                            $remotePort
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function treatMessage($message, string $remoteAddress, string $remotePort, OutputInterface $output)
    {
        $output->writeln(sprintf(static::FORMAT_RECEIVED_MESSAGE, $remoteAddress, $remotePort));
        $output->writeln(sprintf(static::FORMAT_MESSAGE, $message));
    }

    /**
     * Gets the message that launches the stop command
     *
     * @return string
     */
    protected static function getStopCommandMessage() : string
    {
        return self::CMD_STOP;
    }

    /**
     * Gets the command description
     *
     * @return string
     */
    public function getCommandDescription() : string
    {
        return self::COMMAND_DESCRIPTION;
    }

    /**
     * Gets the run listener command name
     *
     * @return string
     */
    protected function getRunListeningCommandName() : string
    {
        return self::COMMAND_NAME;
    }

    /**
     * Gets the help for the command
     *
     * @return string
     */
    protected function getCommandHelp() : string
    {
        return self::COMMAND_HELP;
    }
}