<?php

namespace Smt\Streams;

use Smt\Streams\Exception\StreamNotWritableException;
use SplFileInfo;
use SplFileObject;

/**
 * Represents file stream
 * @package Smt\Streams
 * @author Kirill Saksin <kirill.saksin@yandex.ru>
 * @api
 */
class FileStream extends AbstractStream
{
    /**
     * @var SplFileObject File for writing
     */
    private $file;

    /**
     * Constructor
     * @param SplFileObject $file File
     */
    public function __construct(SplFileObject $file)
    {
        $this->file = $file;
    }

    /**
     * Create instance from filename
     * @param string $filename Filename
     * @return FileStream New instance
     * @throws StreamNotWritableException If file is not writable
     */
    public static function fromFilename($filename)
    {
        $file = new SplFileInfo($filename);
        return self::fromFileInfo($file);
    }

    /**
     * Create instance from @link SplFileInfo
     * @param SplFileInfo $file File
     * @return FileStream New instance
     * @throws StreamNotWritableException If file is not writable
     */
    public static function fromFileInfo(SplFileInfo $file)
    {
        if (self::canWrite($file)) {
            throw new StreamNotWritableException(sprintf('"%s" is not writable!', $file->getFilename()));
        }
        return new self($file->openFile('w'));
    }

    /** {@inheritdoc} */
    protected function doWrite($data)
    {
        $this->file->fwrite($data);
        return $this;
    }

    /**
     * Check if can write into file
     * @param SplFileInfo $file File to check
     * @return bool True if file is writable, false otherwise
     */
    private static function canWrite(SplFileInfo $file)
    {
        if (!$file->isFile() && (new SplFileInfo($file->getPath()))->isWritable()) {
            touch($file->getPathname());
            return true;
        }
        return false;
    }
}
