<?php

namespace Smt\Streams;

/**
 * Base stream class
 * @package Smt\Streams
 * @author Kirill Saksin <kirill.saksin@yandex.ru>
 */
abstract class AbstractStream implements Stream
{
    /**
     * @var Stream[] Stream for redirecting to
     */
    private $redirects = [];

    /**
     * @var int Redirect mode
     */
    private $redirectMode = self::REDIRECT;

    /** {@inheritdoc} */
    public function write($data)
    {
        foreach ($this->redirects as $redirect) {
            $redirect->write($data);
        }

        if (!empty($this->redirects) && $this->redirectMode === self::REDIRECT) {
            return $this;
        }
        if (is_array($data)) {
            $data = implode(PHP_EOL, $data);
        }
        $this->doWrite($data);
        return $this;
    }

    /** {@inheritdoc} */
    public function writeln($data)
    {
        $this->write($data);
        $this->write(PHP_EOL);
        return $this;
    }

    /** {@inheritdoc} */
    public function redirect(Stream $stream)
    {
        $this->redirects[] = $stream;
        return $this;
    }

    /** {@inheritdoc} */
    public function setRedirectMode($mode = self::REDIRECT)
    {
        $this->redirectMode = $mode;
    }

    /**
     * Template method, there should be implementation in child classes
     * @param string $data
     * @return Stream
     */
    abstract protected function doWrite($data);
}
