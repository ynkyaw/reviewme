<?php
namespace App\View\Helper;

use Cake\View\Helper;

class CsvHelper extends Helper
{
    var $delimiter = ',';
    var $enclosure = '"';
    var $filename = 'Export.csv';
    var $line = array();
    var $buffer;

    function CsvHelper()
    {
        $this->clear();
    }
    function clear() 
    {
        $this->line = array();
        $this->buffer = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');
    }

    function addField($value) 
    {
        $this->line[] = $value;
    }

    function endRow() 
    {
        $this->addRow($this->line);
        $this->line = array();
    }

    function addRow($row) 
    {
        // $fp = fopen("exampledw.csv", 'w');

        foreach ($row as $line) 
        {
            //echo " line is ".$line." bla bla ".$line[1];
            fputcsv($this->buffer, $line, $this->delimiter, $this->enclosure);
            //fputcsv($fp, explode(',',$line));
        }
        // fclose($fp);        
    }        

    function renderHeaders() 
    {
        header('Content-Type: text/csv');
        header("Content-type:application/vnd.ms-excel");
        header("Content-disposition:attachment;filename=".$this->filename);
    }

    function setFilename($filename) 
    {
        $this->filename = $filename;
        if (strtolower(substr($this->filename, -4)) != '.csv') 
        {
            $this->filename .= '.csv';
        }
    }

    function render($outputHeaders = true, $to_encoding = null, $from_encoding ="auto") 
    {
        if ($outputHeaders) 
        {
            if (is_string($outputHeaders)) 
            {
                $this->setFilename($outputHeaders);
            }
            $this->renderHeaders();
        }
        rewind($this->buffer);
        $output = stream_get_contents($this->buffer);

        if ($to_encoding) 
        {
            $output = mb_convert_encoding($output, $to_encoding, $from_encoding);
        }
        return $this->output($output);
    }
}

?>