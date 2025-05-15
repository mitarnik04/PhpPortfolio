<?php
require_once DIR_COMPONENTS . '/component.php';


class CardOptions implements IComponentOptions
{

    public function __construct(
        private string $title,
        private string $description,
        private string $tagline = '',
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }
}

class CardComponent implements IComponent
{

    /** @param CardOptions $options */
    function render(IComponentOptions $options): void
    {
        if (!($options instanceof CardOptions)) {
            throw new InvalidArgumentException(
                'CardComponent expects an instance of CardOptions.'
            );
        }

        $title = $options->getTitle();
        $tagline = $options->getTagline();
        $description = $options->getDescription();
?>

        <div class="card">
            <h3><?= $title ?></h3>
            <p class="tagline"><?= $tagline ?></p>
            <p><?= $description ?></p>
        </div>
<?php
    }
}
