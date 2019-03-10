<?php

class Collection implements Countable, IteratorAggregate
{
    /**
     * @var array
     */
    protected $items;

    /**
     * @param mixed $items
     */
    public function __construct($items = [])
    {
        $this->items = is_array($items) ? array_values($items) : $this->getArrayableItems($items);
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @inheritdoc
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

    /**
     * @return Collection
     */
    public function keys(): self
    {
        return new static(array_keys($this->items));
    }

    /**
     * @param callable $callback
     * @return Collection
     */
    public function each(callable $callback): self
    {
        foreach ($this->items as $key => $item) {
            $callback($item, $key);
        }

        return $this;
    }

    /**
     * @param callable|null $callback
     * @return Collection
     */
    public function filter(callable $callback = null): self
    {
        if ($callback) {
            return new static(array_filter($this->items, $callback));
        }

        return new static(array_filter($this->items));
    }

    /**
     * @param callable $callback
     * @return Collection
     */
    public function map(callable $callback): self
    {
        $keys = $this->keys()->all();
        $items = array_map($callback, $this->items, $keys);

        return new static(array_combine($keys, $items));
    }

    /**
     * @param mixed $items
     * @return Collection
     */
    public function merge($items): self
    {
        return new static(array_merge($this->items, $this->getArrayableItems($items)));
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->items) ?: '';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * @inheritdoc
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @param $items
     * @return array
     */
    protected function getArrayableItems($items): array
    {
        if ($items instanceof self) {
            return $items->all();
        }

        return [];
    }
}
