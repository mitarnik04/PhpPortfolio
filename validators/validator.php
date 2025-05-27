<?php
abstract class ValidationRequest
{
    public array $data = [];
}

class ValidationError
{
    public function __construct(
        public readonly string $area,
        public readonly string $key
    ) {}
}



interface IValidator
{
    /** @return array<ValidationError> */
    function validate(ValidationRequest $request): array;
}
