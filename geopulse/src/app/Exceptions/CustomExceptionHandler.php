<?php

namespace Pulse\Exceptions;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Throwable;

class CustomExceptionHandler implements ExceptionHandler
{
    public function report(Throwable $e)
    {
        // Here you can log the error or send notifications
        error_log($e->getMessage());
    }

    public function render($request, Throwable $e)
    {
        // In Laravel, this method would return an HTTP response.
        // In a non-Laravel project, you can just output the error message.
        echo $e->getMessage();
    }

    public function renderForConsole($output, Throwable $e)
    {
        // Display the error in the console
        $output->writeln($e->getMessage());
    }

    public function shouldReport(Throwable $e)
    {
        // You can filter which exceptions should be reported
        return true;
    }
}
