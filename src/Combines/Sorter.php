<?php

namespace Fector\Harvest\Combines;

/**
 * Class Sorter
 * @package Fector\Harvester\Combines
 */
class Sorter implements CombineInterface
{
    CONST METHOD_NAME = 'orderBy';

    /**
     * @param string $value
     * @return array
     */
    public function getActions(string $value): array
    {
        return [
            [
                'method' => self::METHOD_NAME,
                'args' => $this->parseArgs($value)
            ]
        ];
    }

    public function isValid(string $value): bool
    {
        return (bool)preg_match('/^\-?[a-z_]+$/', $value);
    }

    /**
     * @param string $value
     * @return array
     */
    protected function parseArgs(string $value): array
    {
        $column = $value;
        $direction = 'asc';
        if (substr($value, 0, 1) === '-') {
            $column = substr($value, 1);
            $direction = 'desc';
        }
        return  [$column, $direction];
    }

    /**
     * @return array
     */
    protected function getMethods(): array
    {
        return ['orderBy'];
    }
}