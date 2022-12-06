<?php

namespace larsemil\SwishCoder;

use Exception;
use GuzzleHttp\Client;


/**
 * SwishCoder
 */
class SwishCoder
{

    /**
     * endpoint
     *
     * @var string
     */
    protected $endpoint =  'https://api.swish.nu/qr/v2/prefilled';

    /**
     * payee
     *
     * @var string
     */
    protected $payee;

    /**
     * amount
     *
     * @var array
     */
    protected $amount;

    /**
     * message
     *
     * @var array
     */
    protected $message;

    /**
     * size
     *
     * @var int
     */
    protected $size;

    /**
     * border
     *
     * @var int
     */
    protected $border;

    /**
     * __construct
     *
     * @param  mixed $obj
     * @return void
     */
    public function __construct($obj = null)
    {
        if ($obj) {
            foreach ($obj as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    /**
     * payee
     *
     * @param  mixed $p
     * @return object
     */
    public function payee($p)
    {
        $this->payee = $p;
        return $this;
    }

    /**
     * amount
     *
     * @param  mixed $amount
     * @return object
     */
    public function amount($amount)
    {
        if (!array_key_exists('value', $amount)) {
            throw new Exception('Message needs to contain parameter value');
        }
        $this->amount = $amount;
        return $this;
    }

    /**
     * message
     *
     * @param  mixed $message
     * @return object
     */
    public function message($message)
    {
        if (!array_key_exists('value', $message)) {
            throw new Exception('Message needs to contain parameter value');
        }
        $this->message = $message;
        return $this;
    }

    /**
     * size
     *
     * @param  mixed $size
     * @return object
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * border
     *
     * @param  mixed $border
     * @return object
     */
    public function border($border)
    {
        $this->border = $border;
        return $this;
    }

    /**
     * get
     *
     * @return void
     */
    public function get()
    {
        $client = new Client();

        $props = [
            'payee',
            'amount',
            'message',
            'size',
            'border'
        ];
        $data = [];
        foreach ($props as $prop) {
            if ($this->$prop) {
                $data[$prop] = $this->$prop;
            }
        }

        if (!$data['payee']) {
            throw new Exception('Missing payee parameter');
        }


        $r = $client->request('POST', $this->endpoint, [
            'json' => $data
        ]);

        if ($r->getStatusCode() != 200) {
            var_dump($r->getBody());
        }

        return $r->getBody()->getContents();
    }
}