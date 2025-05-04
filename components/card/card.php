<?php
require_once __DIR__ . '/../component.php';


class CardOptions implements IComponentOptions
{
    const OPT_KEY_TITLE = 'title';
    const OPT_KEY_TAGLINE = 'tagline';
    const OPT_KEY_DESCRIPTION = 'description';

    private string $title;
    private string $tagline = '';
    private string $description;

    public function __construct(string $title, string $description, string $tagline = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->tagline = $tagline;
    }

    public function getAllOptions(): array
    {
        return
            [
                self::OPT_KEY_TITLE => $this->title,
                self::OPT_KEY_TAGLINE => $this->tagline,
                self::OPT_KEY_DESCRIPTION => $this->description
            ];
    }
}

class CardComponent implements IComponent
{

    /**
     * @param CardOptions $options
     */
    function render(IComponentOptions $options): void
    {
        if (!($options instanceof CardOptions)) {
            throw new InvalidArgumentException(
                'CardComponent expects an instance of CardOptions.'
            );
        }

        $title = $options->getAllOptions()[CardOptions::OPT_KEY_TITLE];
        $tagline = $options->getAllOptions()[CardOptions::OPT_KEY_TAGLINE];
        $description = $options->getAllOptions()[CardOptions::OPT_KEY_DESCRIPTION];
?>

        <div class="card">
            <h3><?= $title ?></h3>
            <p class="tagline"><?= $tagline ?></p>
            <p><?= $description ?></p>
        </div>
<?php
    }
}
