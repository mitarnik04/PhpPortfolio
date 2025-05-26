<?php
require_once __DIR__ . '/pop-up.php';

/**
 * Renders common preconfigured pop-ups (e.g. success, error).
 * Use for quick defaults. For full control, use PopUpComponent directly.
 */
class PopUpRenderer
{
    public static function renderSuccess(string $name, string $message, string $title, string $closeButtonLabel): PopUpComponent
    {
        $options = new PopUpOptions(
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
                    class: 'button-base',
                )
            ],
            show: true
        );

        $popUp = new PopUpComponent();
        $popUp->render($options);
        return $popUp;
    }

    public static function renderError(string $name, string $message, string $title, string $closeButtonLabel): PopUpComponent
    {
        $options = new PopUpOptions(
            name: $name,
            body: '<div class="flex f-dr-c f-c-c" style="text-align:center; padding:0.2em 1em;">
                    <span class="material-icons" style="font-size:3em; color:#e53935; margin-bottom:0.5em;">error</span>
                    <div style="color:#e53935; font-size:1.2em;">' . htmlspecialchars($message) . '</div>
                  </div>',
            type: PopUpType::Error,
            title: $title,
            buttons: [
                new PopUpButton(
                    label: $closeButtonLabel,
                    class: 'button-base',
                )
            ],
            show: true
        );

        $popUp = new PopUpComponent();
        $popUp->render($options);
        return $popUp;
    }
}
