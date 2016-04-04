@extends('layout.wrapper')

@section('class', 'body--red')

@section('content')
    <h2>Internal Server Error</h2>

    <p>This should not have happened.</p>

    @if(isset($exception) && config('app.debug'))
        <hr>
        <h3>{{ get_class($exception) }}</h3>
        <p>{{ $exception->getMessage() }}</p>
        <i>in {{ $exception->getFile() }}:{{ $exception->getLine() }}</i>

        <?php
            // source: http://php.net/manual/en/exception.gettraceasstring.php#114980
            function jTraceEx($e, $seen=null) {
                $starter = $seen ? 'Caused by: ' : '';
                $result = array();
                if (!$seen) $seen = array();
                $trace  = $e->getTrace();
                $prev   = $e->getPrevious();
                $result[] = sprintf('%s%s: %s', $starter, get_class($e), $e->getMessage());
                $file = $e->getFile();
                $line = $e->getLine();
                while (true) {
//                    $current = "$file:$line";
//                    if (is_array($seen) && in_array($current, $seen)) {
//                        $result[] = sprintf(' ... %d more', count($trace)+1);
//                        break;
//                    }
                    $result[] = sprintf(' at %s%s%s(%s%s%s)',
                        count($trace) && array_key_exists('class', $trace[0]) ? $trace[0]['class'] : '',
                        count($trace) && array_key_exists('class', $trace[0]) && array_key_exists('function', $trace[0]) ? $trace[0]['type'] : '',
                        count($trace) && array_key_exists('function', $trace[0]) ? $trace[0]['function'] : '(main)',
                        $line === null ? $file : basename($file),
                        $line === null ? '' : ':',
                        $line === null ? '' : $line);
                    if (is_array($seen))
                        $seen[] = "$file:$line";
                    if (!count($trace))
                        break;
                    $file = array_key_exists('file', $trace[0]) ? $trace[0]['file'] : 'Unknown Source';
                    $line = array_key_exists('file', $trace[0]) && array_key_exists('line', $trace[0]) && $trace[0]['line'] ? $trace[0]['line'] : null;
                    array_shift($trace);
                }
                $result = join("\n", $result);
                if ($prev)
                    $result  .= "\n" . jTraceEx($prev, $seen);

                return $result;
            }
        ?>

        <pre style="background:#f8f8f8;border:1px solid #ddd;padding:8px">{{ jTraceEx($exception) }}</pre>
    @endif
@endsection
