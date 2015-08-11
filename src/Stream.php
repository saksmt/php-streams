<?php

namespace Smt\Streams;

/**
 * Represents output stream
 * @package Smt\Streams
 * @author Kirill Saksin <kirill.saksin@yandex.ru>
 * @api
 */
interface Stream
{
    /**
     * @const int Write then redirect
     * @api
     */
    const WRITE_REDIRECT = 0;

    /**
     * @const int Redirect without writing
     * @api
     */
    const REDIRECT = 1;

    /**
     * Write some data to stream
     * @param array|string $data Data to be written
     * @return Stream This instance
     * @api
     */
    public function write($data);

    /**
     * Write some data to stream with ending new line
     * @param array|string $data Data to be written
     * @return Stream This instance
     * @api
     */
    public function writeln($data);

    /**
     * Redirect output from this stream to specified one
     * @param Stream $stream Stream to redirect to
     * @return Stream This instance
     * @api
     */
    public function redirect(Stream $stream);

    /**
     * Set redirect mode
     * @param int $mode Redirect mode
     * @return Stream This instance
     */
    public function setRedirectMode($mode = self::REDIRECT);
}
