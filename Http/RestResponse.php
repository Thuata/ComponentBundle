<?php
/**
 * Created by Enjoy Your Business.
 * Date: 10/11/2016
 * Time: 08:45
 * Copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */
namespace Thuata\ComponentBundle\Http;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;


/**
 * Class RestResponse
 *
 * @package   Thuata\ComponentBundle\Http
 *
 * @author    Emmanuel Derrien <emmanuel.derrien@enjoyyourbusiness.fr>
 * @author    Anthony Maudry <anthony.maudry@enjoyyourbusiness.fr>
 * @author    Loic Broc <loic.broc@enjoyyourbusiness.fr>
 * @author    Rémy Mantéi <remy.mantei@enjoyyourbusiness.fr>
 * @author    Lucien Bruneau <lucien.bruneau@enjoyyourbusiness.fr>
 * @author    Matthieu Prieur <matthieu.prieur@enjoyyourbusiness.fr>
 * @copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */
class RestResponse implements \JsonSerializable
{
    const UNKNOWN_ERROR_CODE = -1;
    const UNKNOWN_ERROR_MSG = 'Unknown error';
    /**
     * @var bool
     */
    private $success;

    /**
     * @var string
     */
    private $message;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var mixed
     */
    private $errorCode;

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @var array
     */
    private $groups;

    /**
     * RestResponse constructor.
     *
     * @param bool   $success
     * @param string $message
     * @param mixed  $data
     * @param mixed  $errorCode
     * @param string $errorMessage
     * @param array  $groups
     */
    public function __construct(bool $success, string $message = null, $data = null, $errorCode = null, string $errorMessage = null, $groups = ['Default'])
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Gets success
     *
     * @return boolean
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Gets message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Gets data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Gets the error
     *
     * @return array|null
     */
    public function getError()
    {
        if ($this->errorCode !== null || $this->success === false) {
            return [
                'code'    => $this->errorCode === null ? self::UNKNOWN_ERROR_CODE : $this->errorCode,
                'message' => $this->errorMessage === null ? self::UNKNOWN_ERROR_MSG : $this->errorMessage
            ];
        } else {
            return null;
        }
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'error'   => $this->getError(),
            'data'    => SerializerBuilder::create()->build()->serialize(
                $this->data,
                'json',
                SerializationContext::create()->setGroups($this->groups)
            ),
        ];
    }
}