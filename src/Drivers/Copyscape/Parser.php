<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers\Copyscape;


use VyalovAlexander\AntiplagiatTextChecker\Drivers\ResultParser;

class Parser extends ResultParser
{
    protected $copyscape_xml_data;
    protected $copyscape_xml_depth;
    protected $copyscape_xml_ref;
    protected $copyscape_xml_spec;

    public function parse(string $code, string $body)
    {
        if ($code == 200) {
            $this->copyscape_read_xml($body);
            if (!empty($this->copyscape_xml_data['error'])) {
                $this->setError('Возникла ошибка: ' . $this->copyscape_xml_data['error']);
            } else {
                $allpercentmatched = 0;
                $numOfResults = 0;
                if(isset($this->copyscape_xml_data['result']))
                {
                    foreach ($this->copyscape_xml_data['result'] as $el) {
                        $numOfResults++;
                        $allpercentmatched += $el['allpercentmatched'] ?? 0;
                    }
                }
                $this->setSuccess(true);
                $this->setResult($numOfResults > 0 ? $allpercentmatched / $numOfResults : 0);
            }
        } else {
            $this->setError('Ошибка ' . $code);
        }
    }

    protected function copyscape_read_xml($xml, $spec = null)
    {

        $copyscape_xml_data = array();
        $copyscape_xml_depth = 0;
        $copyscape_xml_ref = array();
        $copyscape_xml_spec = $spec;

        $parser = xml_parser_create();

        xml_set_element_handler($parser, array($this, 'copyscape_xml_start'), array($this, 'copyscape_xml_end'));
        xml_set_character_data_handler($parser, array($this, 'copyscape_xml_data'));

        if (!xml_parse($parser, $xml, true))
            return;

        xml_parser_free($parser);

    }

    protected function copyscape_xml_start($parser, $name, $attribs)
    {
        $this->copyscape_xml_depth++;

        $name = strtolower($name);

        if ($this->copyscape_xml_depth == 1)
            $this->copyscape_xml_ref[$this->copyscape_xml_depth] = &$this->copyscape_xml_data;

        else {
            if (!is_array($this->copyscape_xml_ref[$this->copyscape_xml_depth - 1]))
                $this->copyscape_xml_ref[$this->copyscape_xml_depth - 1] = array();

            if (@$this->copyscape_xml_spec[$this->copyscape_xml_depth][$name] == 'array') {
                if (!is_array(@$this->copyscape_xml_ref[$this->copyscape_xml_depth - 1][$name])) {
                    $this->copyscape_xml_ref[$this->copyscape_xml_depth - 1][$name] = array();
                    $key = 0;
                } else
                    $key = 1 + max(array_keys($this->copyscape_xml_ref[$this->copyscape_xml_depth - 1][$name]));

                $this->copyscape_xml_ref[$this->copyscape_xml_depth - 1][$name][$key] = '';
                $this->copyscape_xml_ref[$this->copyscape_xml_depth] =& $this->copyscape_xml_ref[$this->copyscape_xml_depth - 1][$name][$key];

            } else {
                $this->copyscape_xml_ref[$this->copyscape_xml_depth - 1][$name] = '';
                $this->copyscape_xml_ref[$this->copyscape_xml_depth] =& $this->copyscape_xml_ref[$this->copyscape_xml_depth - 1][$name];
            }
        }
    }

    protected function copyscape_xml_end($parser, $name)
    {
        $this->copyscape_xml_depth--;
    }

    protected function copyscape_xml_data($parser, $data)
    {

        if (is_string($this->copyscape_xml_ref[$this->copyscape_xml_depth]))
            $this->copyscape_xml_ref[$this->copyscape_xml_depth] .= $data;
    }


}