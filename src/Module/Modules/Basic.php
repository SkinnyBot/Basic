<?php
namespace Basic\Module\Modules;

use DateTime;
use Skinny\Module\ModuleInterface;
use Skinny\Network\Wrapper;

class Basic implements ModuleInterface
{
    /**
     * {@inheritDoc}
     *
     * @param \Skinny\Network\Wrapper $wrapper The Wrapper instance.
     * @param array $message The message array.
     *
     * @return void
     */
    public function onCommandMessage(Wrapper $wrapper, $message)
    {
        //Handle the command.
        switch ($message['command']) {
            case 'say':
                $wrapper->Message->delete();
                $wrapper->Channel->send($message['parts'][1]);

                break;

            case 'info':
                $wrapper->Message->reply(
                    'I\'m open-source! You can find me on GitHub : https://github.com/SkinnyBot/Skinny .'
                );

                break;

            case 'time':
                $seconds = floor(microtime(true) - TIME_START);
                $start = new DateTime("@0");
                $end = new DateTime("@$seconds");
                $wrapper->Message->reply(
                    'I\'m running since ' . $start->diff($end)->format('%a days, %h hours, %i minutes and %s seconds.')
                );

                break;
        }
    }
}
