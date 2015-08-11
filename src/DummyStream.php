<?php

namespace Smt\Streams;

/**
 * Does nothing you can redirect any stream to this for disabling
 * @package Smt\Streams
 * @author Kirill Saksin <kirill.saksin@yandex.ru>
 * @api
 */
class DummyStream extends AbstractStream
{
    /** @inheritdoc */
    protected function doWrite($data)
    {
        return $this;
    }
}
