<?php

namespace App\Traits;

use stdClass;

trait ResponseMessage
{
    /**
     * Core of response
     *
     * @param string        $message
     * @param array|object  $data
     * @param integer       $statusCode
     * @param boolean       $isSuccess
     */
    private $output;

    public function coreResponseMessage($message, $data = null, $isSuccess = true)
    {
        $this->output = new stdClass();
        // Check the param
        if (!$message) {
            $this->output->message = 'Message is required';
            return $this->output;
        }

        if ($isSuccess) {
            $this->output->message = $message;
            $this->output->error = false;
            $this->output->data = $data;
            return $this->output;
        } else {
            $this->output->message = $message;
            $this->output->error = true;
            return $this->output;
        }
    }

    /**
     * Send any success response
     *
     * @param string        $message
     * @param array|object  $data
     * @param interger      $statusCode
     */
    public function successMessage($message, $data)
    {
        return $this->coreResponseMessage($message, $data);
    }

    /**
     * Send any error response
     *
     * @param string        $message
     * @param integer       $statusCode
     */
    public function errorMessage($message)
    {
        return $this->coreResponseMessage($message, null, false);
    }
}
