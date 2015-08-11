smt/streams
===========

Another abstraction over output.

Key-features
------------

Redirecting to another stream.

Installation
------------

    composer require smt/streams

Usage
-----

    use Smt\Streams\SymfonyOutputStream;
    use Smt\Streams\FileStream;
    use Smt\Streams\DummyStream;

    $outStream = new SymfonyOutputStream($out);
    $outStream
        ->write('Hello')
        ->redirect(new FileStream('truth.txt'))
        ->write('Time')
        ->write(' to')
        ->write(' take')
        ->write(' over')
        ->write(' the')
        ->setRedirectMode(FileStream::WRITE_REDIRECT)
        ->writeln('world')
    ;
    // Symfony out - "Hello world"
    // truth.txt - "Time to take over the world"