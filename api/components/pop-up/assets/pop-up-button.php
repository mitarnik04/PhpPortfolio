<?php
class PopUpButton
{
    public function __construct(
        public readonly string $label,
        public readonly bool $closePopUpOnClick,
        public readonly string $type = 'button',
        public readonly ?string $class = null,
        public readonly string $onClick = ''
    ) {}
}
