<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    private function getModels($path, $namespace)
    {
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $filename = $path . '/' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, $this->getModels($filename,
                    array_merge($namespace, array(basename($filename)))));
            } else {
                $fp = fopen($filename, 'r');
                $class = $buffer = '';
                $i = 0;
                while (!$class) {
                    if (feof($fp)) break;

                    $buffer .= fread($fp, 512);
                    $tokens = token_get_all($buffer);

                    if (strpos($buffer, '{') === false) continue;

                    for (; $i < count($tokens); $i++) {
                        if ($tokens[$i][0] === T_CLASS) {
                            for ($j = $i + 1; $j < count($tokens); $j++) {
                                if ($tokens[$j] === '{') {
                                    $class = $tokens[$i + 2][1];
                                }
                            }
                        }
                    }
                }
                $fullClassName = implode('\\', $namespace) . '\\' . $class;
                $out[(new $fullClassName)->getTable()] = $fullClassName::all()->toArray();
            }
        }
        return $out;
    }

    public
    function listModels()
    {
        $path = app_path() . '/Models';
        dd($this->getModels($path, array('App', 'Models')));
    }
}
