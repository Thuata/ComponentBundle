<?php
/**
 * Created by Enjoy Your Business.
 * Date: 15/11/2016
 * Time: 11:34
 * Copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */

namespace Thuata\ComponentBundle\Registry;


/**
 * Interface ClassAwareInterface
 *
 * @package   Thuata\ComponentBundle\Registry
 *
 * @author    Emmanuel Derrien <emmanuel.derrien@enjoyyourbusiness.fr>
 * @author    Anthony Maudry <anthony.maudry@enjoyyourbusiness.fr>
 * @author    Loic Broc <loic.broc@enjoyyourbusiness.fr>
 * @author    Rémy Mantéi <remy.mantei@enjoyyourbusiness.fr>
 * @author    Lucien Bruneau <lucien.bruneau@enjoyyourbusiness.fr>
 * @author    Matthieu Prieur <matthieu.prieur@enjoyyourbusiness.fr>
 * @copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */
interface ClassAwareInterface
{
    /**
     * Sets the entity class
     *
     * @param string $entityClass
     */
    public function setEntityClass(string $entityClass);
}