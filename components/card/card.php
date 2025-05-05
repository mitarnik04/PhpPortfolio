<?php
require_once __DIR__ . '/../component.php';


class CardOptions implements IComponentOptions
{

    public function __construct(
        private string $title,
        private string $tagline = '',
        private string $description,
    ) {}

    public function getTitle()
    {
        return $this->title;
    }
    public function getTagline()
    {
        return $this->tagline;
    }
    public function getDescription()
    {
        return $this->description;
    }
}

class CardComponent implements IComponent
{

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
