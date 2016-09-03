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

namespace Thuata\ComponentBundle\Bridge\Doctrine;

/**
 * <b>ShortcutNotationParser</b><br>
 * This class provides getters and setters for bundle and entity names from a shortcut notation.<br>
 * Code is gotten from GenerateDoctrineCommand::parseShortcutNotation($shortcut)
 *
 * @see \Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCommand::parseShortcutNotation($shortcut)
 *
 * @package thuata\componentbundle\Bridge\Doctrine
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class ShortcutNotationParser
{
    /**
     * @var string
     */
    private $shortcut;

    /**
     * @var string
     */
    private $bundleName;

    /**
     * @var string
     */
    private $entityName;

    /**
     * ShortcutNotationParser constructor.
     *
     * @param $shortcut
     */
    public function __construct($shortcut)
    {
        $this->shortcut = $shortcut;
        $this->parseNotation();
    }

    /**
     * Gets the initial shortcut
     *
     * @return string
     */
    public function getShortcut()
    {
        return $this->shortcut;
    }

    /**
     * Gets the bundle name from the shortcut
     *
     * @return string
     */
    public function getBundleName()
    {
        return $this->bundleName;
    }

    /**
     * Gets the entity name from the shortcut
     *
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * Parses the notation.<br>
     * Code is gotten from GenerateDoctrineCommand::parseShortcutNotation($shortcut)
     *
     * @see \Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCommand::parseShortcutNotation($shortcut)
     */
    private function parseNotation()
    {
        $entity = str_replace('/', '\\', $this->shortcut);

        if (false === $pos = strpos($entity, ':')) {
            throw new \InvalidArgumentException(sprintf('The entity name must contain a : ("%s" given, expecting something like AcmeBlogBundle:Blog/Post)', $entity));
        }

        $this->bundleName = substr($entity, 0, $pos);
        $this->entityName = substr($entity, $pos + 1);
    }
}