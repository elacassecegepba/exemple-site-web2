<?php

function highlight_array($array, $name = 'var')
{
  highlight_string("<?php\n\$$name =\n" . var_export($array, true) . ";\n?>");
}

function out($text)
{
  echo htmlspecialchars($text);
}

function removeDir(string $dir): void {
  if (!file_exists($dir)) {
    return;
  }
  $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
  $files = new RecursiveIteratorIterator($it,
               RecursiveIteratorIterator::CHILD_FIRST);
  foreach($files as $file) {
      if ($file->isDir()){
          rmdir($file->getPathname());
      } else {
          unlink($file->getPathname());
      }
  }
  rmdir($dir);
}