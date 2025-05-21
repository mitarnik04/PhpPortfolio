<?php
require_once __DIR__ . '/pop-up.php';

class PopUpOptionsFactory
{
    public static function success(string $name, string $message, string $title, string $closeButtonLabel): PopUpOptions
    {

        return new PopUpOptions(
            name: $name,
            body: '<div class="flex f-dr-c f-c-c" style="text-align:center; padding:0.2em 1em;">
                    <span class="material-icons" style="font-size:3em; color:#43a047; margin-bottom:0.5em;">check_circle</span>
                    <div style="color:#43a047; font-size:1.2em;">' . htmlspecialchars($message) . '</div>
                  </div>',
            type: PopUpType::Info,
            title: $title,
            buttons: [
                new PopUpButton(
                    label: $closeButtonLabel,
                    onClick: "PopUpUtils.hidePopUp('{$name}')",
                    class: 'button-base'
                )
            ]
        );
    }
}
