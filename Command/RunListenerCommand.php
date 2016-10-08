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
abstract class RunListenerCommand extends ListenerCommand
{
    use ThuataCommandTrait;
    const COMMAND_HELP = <<<EOT
This command allows you to open an output socket in witch you will be able to send a message.
EOT;
    const OPTION_PORT = 'port';
    const OPTION_SHORTCUT_PORT = 'p';
    const OPTION_DESC_PORT = 'The port to listen. Not relevant if send option is specified.';
    const OPTION_HOST = 'host';
    const OPTION_SHORTCUT_HOST = 'l';
    const OPTION_DESC_HOST = 'The host to listen.0.0.0.0 for all hosts. Relevant only if send option is not specified.';
    const WELCOME_LISTEN = 'Will <fg=yellow>listen</> for incoming message.';
    const START_LISTEN = 'Start listening on  <fg=cyan>%s</><fg=yellow>:</><fg=cyan>%s</>';
    const WELCOME_SEND = 'Will <fg=yellow>send</> message <fg=cyan>%s</> to <fg=red>%s</> command';
    const DEFAULT_PORT = 8080;
    const DEFAULT_HOST = '0.0.0.0';
    const MESSAGE_STOP = 'Received <fg=red>STOP</> command.';
    const HOWTO_STOP = 'To stop listening send the message <fg=white;bg=blue>%s</>';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName($this->getCommandName())
            ->setDescription($this->getCommandDescription())
            ->addOption(self::OPTION_HOST, self::OPTION_SHORTCUT_HOST, InputOption::VALUE_OPTIONAL, self::OPTION_DESC_HOST, self::DEFAULT_HOST)
            ->addOption(self::OPTION_PORT, self::OPTION_SHORTCUT_PORT, InputOption::VALUE_OPTIONAL, self::OPTION_DESC_PORT, static::DEFAULT_PORT)
            ->setHelp(sprintf($this->getCommandHelp(), get_class($this)));
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->writeThuataASCIILogo($output);

        $this->executeListen($input, $output);

        $this->writeGoodBy($output);

        return 0;
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
        $output->writeln(sprintf(self::HOWTO_STOP, static::getStopCommandMessage()));

        file_put_contents($this->getFilePath(), $port);

        while (true) {
            socket_recvfrom($sock, $message, 512, 0, $raddr, $rport);
            if ($message === static::getStopCommandMessage()) {
                $output->writeln(self::MESSAGE_STOP);
                break;
            }
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
    abstract protected function treatMessage($message, string $remoteAddress, string $remotePort, OutputInterface $output);

    /**
     * Gets the message that launches the stop command
     *
     * @return string
     */
    abstract protected static function getStopCommandMessage() : string;
}