<?php

class Series
{

    private $valueOrder;

    private $sequenceLength;

    public function __construct($value)
    {
        $this->validateOrder($values);

        $this->valueOrder = $values;
        $this->sequenceLength = strlen($values);
    }

    public function largestProduct($span) : int
    {
        if (0 == $span) {
            return 1;
        }
        $this->validateSpan($span);

        return $this->largestSeriesProduct($span);
    }

    private function validateSpan($span) : void
    {
        if ($span < 0) {
            throw new InvalidArgumentException(sprintf(
                'Must be greater than 0',
                $span
            ));
        }

        if ($span > $this->sequenceLength) {
            throw new InvalidArgumentException(sprintf(
                'Span cannot be greater than the length itself',
                $span,
                $this->sequenceLength
            ));
        }
    }

    private function largestSeriesProduct($span) : int
    {
        $products = [];
        for ($start = 0; $start <= $this->sequenceLength - $span; $start++) {
            $products[] = $this->multiplyStringSection(substr($this->valueOrder, $start, $span));
        }
        return max($products);
    }

    private function multiplyStringSection($stringSection) : int
    {
        return array_product(str_split($stringSection));
    }

    private function validateOrder($values) : void
    {
        if (! empty($values) && ! is_numeric($values)) {
            throw new InvalidArgumentException(sprintf(
                "Required and numbers only",
                $values
            ));
        }
    }
}