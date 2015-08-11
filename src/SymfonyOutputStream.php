<?php

namespace Smt\Streams;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Wrapper for symfony's @link OutputInterface
 * @package Smt\Streams
 * @author Kirill Saksin <kirill.saksin@yandex.ru>
 * @api
 */

class SymfonyOutputStream extends AbstractStream
{
    /**
     * @var OutputInterface
     */
    private $out;

    /**
     * Constructor
     * @param OutputInterface $out Output
     */
    public function __construct(OutputInterface $out)
    {
        $this->out = $out;
    }

    /** @inheritdoc */
    protected function doWrite($data)
    {
        $this->out->write($data);
        return $this;
    }
}
