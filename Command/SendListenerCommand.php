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
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * <b>ListenerCommand</b><br>
 *
 *
 * @package thuata\componentbundle\Command
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
abstract class SendListenerCommand extends ListenerCommand
{
    use ThuataCommandTrait;

    const COMMAND_DESCRIPTION = 'Sends a message to a running command.';
    const COMMAND_HELP = <<<EOT
You will send a message to a running listner command.
EOT;
    const OPTION_SEND = 'send';
    const OPTION_SHORTCUT_SEND = 's';
    const OPTION_DESC_SEND = 'Sends a message to the %s command.';
    const WELCOME_SEND = 'Will <fg=yellow>send</> message <fg=cyan>%s</> to <fg=red>%s</> command';
    const MESSAGE_STOP = 'Received <fg=red>STOP</> command.';
    const HOWTO_STOP = 'To stop the listening server send the message <fg=white;bg=blue>%s</>';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName($this->getCommandName())
            ->setDescription($this->getCommandDescription())
            ->addOption(self::OPTION_SEND, self::OPTION_SHORTCUT_SEND, InputOption::VALUE_REQUIRED, sprintf(self::OPTION_DESC_SEND, $this->getName()))
            ->setHelp(sprintf(self::COMMAND_HELP, get_class($this)));
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->writeThuataASCIILogo($output);

        $message = $input->getOption(self::OPTION_SEND);
        $output->writeln(sprintf(self::WELCOME_SEND, $message, $this->getName()));

        $port = file_get_contents($this->getFilePath());

        $pingSock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_sendto($pingSock, $message . PHP_EOL, strlen($message), 0, '127.0.0.1', $port);

        $this->writeGoodBy($output);

        return 0;
    }
}