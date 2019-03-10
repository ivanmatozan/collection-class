<?php

class Collection
{
    /**
     * @var array
     */
    protected $items;

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = array_values($items);
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * @param mixed|null $default
     * @return mixed|null
     */
    public function first($default = null)
    {
        return $this->items[0] ?? $default;
    }

    /**
     * @param mixed|null $default
     * @return mixed|null
     */
    public function last($default = null)
    {
        $reversed = array_reverse($this->items);
        return $reversed[0] ?? $default;
    }
}
