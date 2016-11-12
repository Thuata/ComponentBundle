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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * <b>OutputCommand</b><br>
 *
 *
 * @package Thuata\ComponentBundle\Command
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class OutputCommand extends ContainerAwareCommand
{
    use ThuataCommandTrait;
    const COMMAND_NAME = 'thuata:output';
    const COMMAND_DESCRIPTION = 'Opens an output socket in with you can write with OutputCommand::write static method.';
    const COMMAND_HELP = <<<EOT
Without the --send option this command allows you to open an output socket in witch you will be able to write.
With the --send option, you will send a message to a previously launched command.
EOT;
    const OPTION_PORT = 'port';
    const OPTION_SHORTCUT_PORT = 'p';
    const OPTION_DESC_PORT = 'The port to listen. Not relevant if send option is specified.';
    const OPTION_SEND = 'send';
    const OPTION_SHORTCUT_SEND = 's';
    const OPTION_DESC_SEND = 'Sends a message to the %s command.';
    const OPTION_HOST = 'host';
    const OPTION_SHORTCUT_HOST = 'l';
    const OPTION_DESC_HOST = 'The host to listen.0.0.0.0 for all hosts. Relevant only if send option is not specified.';
    const WELCOME_LISTEN = 'Will <fg=yellow>listen</> for incoming message.';
    const START_LISTEN = 'Start listening on  <fg=cyan>%s</><fg=yellow>:</><fg=cyan>%s</>';
    const WELCOME_SEND = 'Will <fg=yellow>send</> message <fg=cyan>%s</> to <fg=red>%s</> command';
    const DEFAULT_PORT = 8080;
    const DEFAULT_HOST = '0.0.0.0';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::COMMAND_DESCRIPTION)
            ->addOption(self::OPTION_HOST, self::OPTION_SHORTCUT_HOST, InputOption::VALUE_OPTIONAL, self::OPTION_DESC_HOST, self::DEFAULT_HOST)
            ->addOption(self::OPTION_PORT, self::OPTION_SHORTCUT_PORT, InputOption::VALUE_OPTIONAL, self::OPTION_DESC_PORT, static::DEFAULT_PORT)
            ->addOption(self::OPTION_SEND, self::OPTION_SHORTCUT_SEND, InputOption::VALUE_REQUIRED, sprintf(self::OPTION_DESC_SEND, $this->getName()))
            ->setHelp(sprintf(self::COMMAND_HELP, get_class($this)));
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->writeThuataASCIILogo($output);

        if ($input->getOption(self::OPTION_SEND)) {
            $this->executeSend($input, $output);
        } else {
            $this->executeListen($input, $output);
        }

        $this->writeGoodBy($output);

        return 0;
    }

    /**
     * Gets the file path holding the port number
     *
     * @return string
     */
    private function getFilePath()
    {

        $tmpDir = realpath($this->getContainer()->get('kernel')->getRootDir() . '/../var/tmp/');
        $fileName = '/' . str_replace(':', '--', $this->getName()) . '.sock';

        if (!file_exists($tmpDir)) {
            mkdir($tmpDir);
        }

        return $tmpDir . $fileName;
    }

    /**
     * Execute send mode with send option
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function executeSend(InputInterface $input, OutputInterface $output)
    {
        $message = $input->getOption(self::OPTION_SEND);
        $output->writeln(sprintf(self::WELCOME_SEND, $message, $this->getName()));

        $port = file_get_contents($this->getFilePath());

        $pingSock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_sendto($pingSock, $message . PHP_EOL, strlen($message), 0, '127.0.0.1', $port);
    }

    /**
     * Execute listening mode (without send option)
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function executeListen(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(self::WELCOME_LISTEN);

        $port = (int)$input->getOption(self::OPTION_PORT);
        $host = $input->getOption(self::OPTION_HOST);

        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_bind($sock, $host, $port);
        $output->writeln(sprintf(self::START_LISTEN, $host, (string)$port));

        file_put_contents($this->getFilePath(), $port);
        while (true) {
            socket_recvfrom($sock, $message, 512, 0, $raddr, $rport);
            $this->treatMessage($message, $raddr, $rport, $output);
        }
        socket_close($sock);
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
        $output->writeln("Received message from $remoteAddress:$remotePort : " . $message);
    }
}